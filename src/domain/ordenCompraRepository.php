<?php
declare(strict_types=1);


namespace Src\domain;

interface OrdenCompraRepository {
    public function listarItems(): array;
    public function listarOrdenes(): array;
    public function crearOrdenDeCompra(): OrdenDeCompra;
    public function buscarOrdenDeCompraPorId(int $id): ?OrdenDeCompra;
    public function buscarItemPorId(int $id): ?Item;
    public function agrearItemAOrdenDeCompra(int $idOrdenCompra, int $idItem): bool;
    public function listarItemsDeUnaOrdenDeCompra(int $idOrdenCompra): array;
    public function pagarOrdenDeCompra(int $idOrdenCompra, string $medioDePago): void;
}