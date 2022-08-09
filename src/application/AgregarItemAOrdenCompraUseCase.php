<?php
declare(strict_types=1);

namespace Src\application;

use Src\domain\Item;
use Src\domain\OrdenCompraRepository;
use Src\domain\OrdenDeCompra;

class AgregarItemAOrdenCompraUseCase {

    private $repository;

    public function __construct(OrdenCompraRepository $repository){
        $this->repository = $repository;
    }

    public function ejecutar(int $idOrdenDeCompra=0, int $idItem=0): ?OrdenDeCompra {
        $ordenCompra = OrdenDeCompra::buscarPorId($this->repository, $idOrdenDeCompra);        
        if (!is_null($ordenCompra) && !$ordenCompra->existe()) {
            return null;
        }

        $ordenCompra?->setRepository($this->repository);

        $item = Item::buscarPorId($this->repository, $idItem);
        if (!is_null($item) && !$item->existe()) {
            return null;
        }
        $item->setRepository($this->repository);

        $ordenCompra?->setRepository($this->repository);
        $ordenCompra?->agregarItem($item);
        return $ordenCompra;
    }
}