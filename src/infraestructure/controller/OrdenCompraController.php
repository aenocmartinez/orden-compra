<?php
declare(strict_types=1);

namespace Src\infraestructure\controller;

use Src\application\AgregarItemAOrdenCompraUseCase;
use Src\application\BuscarOrdenCompraParaPagoUseCase;
use Src\application\CrearOrdenDeCompraUseCase;
use Src\infraestructure\controller\IOrdenCompra;
use Src\application\ListarItemsUseCase;
use Src\application\ListarOrdenesUseCase;
use Src\application\PagarOrdenCompraUseCase;
use Src\domain\OrdenCompraDTO;
use Src\domain\OrdenCompraRepository;
use Src\domain\OrdenDeCompra;

class OrdenCompraController implements IOrdenCompra {
    
    private $repository;

    public function __construct(OrdenCompraRepository $repository) {
        $this->repository = $repository;
    }

    public function listarItems(): ?array {
        $casoUso = new ListarItemsUseCase($this->repository);
        return $casoUso->ejecutar();
    }

    public function listarOrdenesDeCompra(): ?array {
        $casoUso = new ListarOrdenesUseCase($this->repository);
        return $casoUso->ejecutar();
    }

    public function crearOrdenCompra(): ?OrdenDeCompra {
        $casoUso = new CrearOrdenDeCompraUseCase($this->repository);
        return $casoUso->ejecutar();
    }

    public function agregarItemAOrdenCompra(int $idOrdenDeCompra, int $idItem): ?OrdenDeCompra {
        $casoUso = new AgregarItemAOrdenCompraUseCase($this->repository);
        return $casoUso->ejecutar($idOrdenDeCompra, $idItem);
    }

    public function buscarOrdenDeCompraParaPago(int $idOrdenDeCompra): ?OrdenDeCompra {
        $casoUso = new BuscarOrdenCompraParaPagoUseCase($this->repository);
        return $casoUso->ejecutar($idOrdenDeCompra);
    }

    function pagarOrdenDeCompra(OrdenCompraDTO $ordenCompraDTO) {
        $casoUso = new PagarOrdenCompraUseCase($this->repository);
        $casoUso->ejecutar($ordenCompraDTO);
    }
}