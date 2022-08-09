<?php
declare(strict_types=1);

namespace Src\domain;

class OrdenDeCompra {

    private $id;
    private $items;
    private $total;    
    private $estado;
    private $medioPago;
    private $createdAt;
    private $repository;

    public function __construct(){
        $this->items = array();
        $this->total = 0;
        $this->id = 0;
        $this->estado = 'pendiente';
    }

    public function setRepository(OrdenCompraRepository $repository): void {
        $this->repository = $repository;
    }

    public function agregarItem(Item $item): bool{
        return $this->repository->agrearItemAOrdenDeCompra($this->id, $item->getId());
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setEstado(string $estado = 'pendiente'): void {
        $this->estado = $estado;
    }

    public function getEstado(): string {
        return $this->estado;
    }

    public function setCreatedAt(string $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function setMedioPago(string $medioPago): void {
        $this->medioPago = $medioPago;
    }

    public function getMedioPago(): string {
        return $this->medioPago;
    }

    public function setItems(array $items): void {
        $this->items = $items;
    }

    public function calcularTotal(): float {        
        foreach($this->listarItems() as $item ) {
            $this->total += $item->getPrecio();
        }
        return $this->total;
    }

    public function crear(): self {
        return $this->repository->crearOrdenDeCompra();
    }

    public function listarItems(): ?array {
        return $this->repository->listarItemsDeUnaOrdenDeCompra($this->id);
    }

    public function pagar(MedioDePago $medioDePago): void {
        $this->calcularTotal();
        $medioDePago->setRepository($this->repository);
        $medioDePago->pagar($this->total, $this->id);        
    }

    public function totalItems(): int {
        return sizeof($this->items);
    }

    public function existe(): bool {
        return $this->id > 0;
    }

    public function estaPendiente(): bool {
        return $this->estado == "pendiente";
    }

    public static function listar(OrdenCompraRepository $repository): ?array{
        return $repository->listarOrdenes();
    }

    public static function buscarPorId(OrdenCompraRepository $repository, int $idOrdenCompra): ?OrdenDeCompra{
        return $repository->buscarOrdenDeCompraPorId($idOrdenCompra);
    } 
}