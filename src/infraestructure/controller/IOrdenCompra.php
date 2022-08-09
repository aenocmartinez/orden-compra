<?php
declare(strict_types=1);

namespace Src\infraestructure\controller;

use Src\domain\OrdenCompraDTO;
use Src\domain\OrdenDeCompra;

interface IOrdenCompra {    
    public function listarItems(): ?array;
    public function listarOrdenesDeCompra(): ?array;
    public function crearOrdenCompra(): ?OrdenDeCompra;
    public function agregarItemAOrdenCompra(int $idOrdenDeCompra, int $idItem): ?OrdenDeCompra;
    public function buscarOrdenDeCompraParaPago(int $idOrdenDeCompra): ?OrdenDeCompra;
    public function pagarOrdenDeCompra(OrdenCompraDTO $ordenCompraDTO);
}