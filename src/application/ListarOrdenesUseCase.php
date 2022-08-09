<?php
declare(strict_types=1);

namespace Src\application;

use Src\domain\OrdenCompraRepository;
use Src\domain\OrdenDeCompra;

class ListarOrdenesUseCase {
    
    private $repository;

    public function __construct(OrdenCompraRepository $repository){
        $this->repository = $repository;
    }

    public function ejecutar(): ?array {
        return OrdenDeCompra::listar($this->repository);
    }    
}