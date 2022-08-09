<?php
declare(strict_types=1);

namespace Src\application;

use Src\domain\OrdenCompraRepository;
use Src\domain\OrdenDeCompra;

class BuscarOrdenCompraParaPagoUseCase {
    private $repository;

    public function __construct(OrdenCompraRepository $repository){
        $this->repository = $repository;
    }

    public function ejecutar(int $idOrdenDeCompra=0): ?OrdenDeCompra {

        $ordenDeCompra = OrdenDeCompra::buscarPorId($this->repository, $idOrdenDeCompra);

        if (!$ordenDeCompra?->existe()) {
            return null;
        }

        $ordenDeCompra->setRepository($this->repository);
        
        return $ordenDeCompra;
    }
}