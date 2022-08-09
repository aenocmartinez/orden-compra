<?php
declare(strict_types=1);

namespace Src\infraestructure\repository;

use Exception;
use Src\domain\Item as DomainItem;
use Src\domain\OrdenCompraRepository;
use Src\domain\OrdenDeCompra as DomainOrdenCompra;
use Src\infraestructure\repository\eloquent\Item;
use Src\infraestructure\repository\eloquent\OrdenCompra;

class EloquentRepository implements OrdenCompraRepository {

    public function listarItems(): array {
        $items = array();
        $filas = Item::orderBy('id')->get();

        foreach ($filas as $fila) {
            $item = new DomainItem($fila['nombre'], $fila['precio']);
            $item->setId($fila->id);
            $item->setRepository(new self());
            array_push($items, $item);
        } 

        return $items;
    }

    public function crearOrdenDeCompra(): DomainOrdenCompra {
        $ordenCompra = new DomainOrdenCompra();
        try {
            $fila = OrdenCompra::create([
                'estado' => 'pendiente'
            ]);
            $ordenCompra->setId($fila->id);
            $ordenCompra->setCreatedAt($fila->created_at->format('Y-m-d h:m:s'));
        } catch(Exception $e) {
            throw $e;
        }

        return $ordenCompra;
    }

    public function buscarOrdenDeCompraPorId(int $id): ?DomainOrdenCompra {
        $ordenCompra = null;
        try {            
            $fila = OrdenCompra::find($id);
            if ($fila) {
                $ordenCompra = new DomainOrdenCompra();
                $ordenCompra->setId($fila->id);
                $ordenCompra->setEstado($fila->estado);
                $ordenCompra->setMedioPago($fila->medio_de_pago);
                $ordenCompra->setCreatedAt($fila->created_at->diffForHumans());
            }

        }catch (Exception $e) {
            throw $e;
        }

        return $ordenCompra;
    }

    public function agrearItemAOrdenDeCompra(int $idOrdenCompra, int $idItem): bool {
        $resultado = false;
        try {
            
            $filaOrdenCompra = OrdenCompra::find($idOrdenCompra);
            if(!$filaOrdenCompra) {
                return $resultado;
            }

            $filaItem = Item::find($idItem);

            if (!$filaItem) {
                return $resultado;
            }

            $filaOrdenCompra->agregarItem($filaItem);
            $resultado = true;

        } catch (Exception $e) {
            throw $e;
        }
        return $resultado;
    }

    public function listarItemsDeUnaOrdenDeCompra(int $idOrdenCompra): array {
        $items = array();
        try {
            $fila = OrdenCompra::find($idOrdenCompra);            
            if ($fila) {

                foreach($fila->items()->get() as $it) {
                    $item = new DomainItem($it->nombre, $it->precio);                    
                    $item->setId($it->id);
                    array_push($items, $item);
                }
            }
        } catch (Exception $e) {
            throw $e;
        }
        return $items;
    }

    public function listarOrdenes(): array {
        $ordenes = array();
        try {
            $filas = OrdenCompra::orderByDesc('id')->get();
            if ($filas) {
                foreach($filas as $fila) {
                    $ordenCompra = new DomainOrdenCompra();
                    $ordenCompra->setId($fila->id);
                    $ordenCompra->setEstado($fila->estado);     
                    $ordenCompra->setMedioPago($fila->medio_de_pago);               
                    $ordenCompra->setCreatedAt($fila->created_at->diffForHumans());
                    $ordenCompra->setRepository(new self());

                    $items = $this->listarItemsDeUnaOrdenDeCompra($ordenCompra->getId());

                    $ordenCompra->setItems($items);
                    
                    array_push($ordenes, $ordenCompra);
                }
            }
        } catch (Exception $e) {
            throw $e;
        }
        return $ordenes;
    }

    public function buscarItemPorId(int $id): ?DomainItem {
        $item = null;
        try {            
            $fila = Item::find($id);
            if ($fila) {
                $item = new DomainItem($fila->nombre, $fila->precio);
                $item->setId($fila->id);
            }

        }catch (Exception $e) {
            throw $e;
        }

        return $item;
    }

    public function pagarOrdenDeCompra(int $idOrdenCompra, string $medioDePago): void {
        $filaOrdenCompra = OrdenCompra::find($idOrdenCompra);
        if($filaOrdenCompra) {
            $filaOrdenCompra->estado = "pagada";
            $filaOrdenCompra->medio_de_pago = $medioDePago;
            $filaOrdenCompra->save();
        }       
    }
}