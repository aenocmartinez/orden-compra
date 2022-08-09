<?php
declare(strict_types=1);

namespace Src\application;

use Src\domain\OrdenCompraRepository;
use Src\domain\OrdenDeCompra;

class CrearOrdenDeCompraUseCase {

    private $repository;

    public function __construct(OrdenCompraRepository $repository){
        $this->repository = $repository;
    }
        
    public function ejecutar(): ?OrdenDeCompra{
        $ordenCompra = new OrdenDeCompra();
        $ordenCompra->setRepository($this->repository);

        return $ordenCompra->crear();
    }
}