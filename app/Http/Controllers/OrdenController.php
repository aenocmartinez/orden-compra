<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Src\application\AgregarItemAOrdenCompraUseCase;
use Src\domain\OrdenCompraDTO;
use Src\infraestructure\controller\OrdenCompraController;
use Src\infraestructure\repository\EloquentRepository;

class OrdenController extends Controller
{
    public function listarItems() {
        $eloquent = new EloquentRepository();
        $ctr = new OrdenCompraController($eloquent);
        $items = $ctr->listarItems();
        
        foreach($items as $item) {
            echo $item->getId() . " " . $item->getNombre() . " - " . $item->getPrecio() . "<br>";
        }
    }

    public function listarOrdenesDeCompra() {
        $eloquent = new EloquentRepository();   
        $ctr = new OrdenCompraController($eloquent);
        $ordenes = $ctr->listarOrdenesDeCompra();
        return view('ordencompra.index', [
            'ordenes' => $ordenes
        ]);
    }

    public function crearOrdenDeCompra() {
        $eloquent = new EloquentRepository();   
        $ctr = new OrdenCompraController($eloquent);
        $ordenCompra = $ctr->crearOrdenCompra();
        $ordenCompra->setRepository($eloquent);
        $items = $ctr->listarItems();
        
        return view('ordencompra.create', [
            'orden' => $ordenCompra,
            'items' => $items
        ]);
    }

    public function agregarItemAOrden(Request $req) {
        $eloquent = new EloquentRepository();   
        $ctr = new OrdenCompraController($eloquent);
        $ordenCompra = $ctr->agregarItemAOrdenCompra($req->idOrdenCompra, $req->idItem);       

        if (!$ordenCompra?->existe()){
            $ordenes = $ctr->listarOrdenesDeCompra();
            return view('ordencompra.index', [
                'ordenes' => $ordenes
            ]);
        }

        $items = $ctr->listarItems();
        return view('ordencompra.create', [
            'orden' => $ordenCompra,
            'items' => $items
        ]);        

    }

    public function buscarOrdenDeCompraParaPago(int $idOrdenCompra) {
        $eloquent = new EloquentRepository();   
        $ctr = new OrdenCompraController($eloquent);
        $ordenCompra = $ctr->buscarOrdenDeCompraParaPago($idOrdenCompra);

        if (!$ordenCompra?->existe()) {
            $ordenes = $ctr->listarOrdenesDeCompra();
            return view('ordencompra.index', [
                'ordenes' => $ordenes
            ]);
        }

        return view('ordencompra.pago', [
            'orden' => $ordenCompra
        ]);
    }

    public function pagarOrdenDeCompra(Request $req) {
        
        $ordenCompraDto = new OrdenCompraDTO();
        $ordenCompraDto->email = $req?->email;
        $ordenCompraDto->password = $req?->password;
        $ordenCompraDto->nombre = $req->nombre;
        $ordenCompraDto->numeroTarjeta = $req->numeroTarjeta;
        $ordenCompraDto->ccv = $req->ccv;
        $ordenCompraDto->fechaExpiracion = $req->fechaExpiracion;
        $ordenCompraDto->medio = $req->medio;
        $ordenCompraDto->idOrdenCompra = $req->idOrdenCompra;

        $eloquent = new EloquentRepository();   

        $ctr = new OrdenCompraController($eloquent);

        $ctr->pagarOrdenDeCompra($ordenCompraDto);

        $ordenes = $ctr->listarOrdenesDeCompra();
        return view('ordencompra.index', [
            'ordenes' => $ordenes
        ]);        
    }
}