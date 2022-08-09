<?php
declare(strict_types=1);

namespace Src\application;

use Src\domain\Item;
use Src\domain\OrdenCompraRepository;

class ListarItemsUseCase {

    private $repository;

    public function __construct(OrdenCompraRepository $repository){
        $this->repository = $repository;
    }

    public function ejecutar(): ?array {
        return Item::listar($this->repository);
    }
}