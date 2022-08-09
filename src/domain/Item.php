<?php
declare(strict_types=1);

namespace Src\domain;

class Item {
    private $id;
    private $nombre;
    private $precio;
    private $createdAt;
    private $repository;

    public function __construct(string $nombre, float $precio) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->id = 0;
    }

    public function setRepository(OrdenCompraRepository $repository): void {
        $this->repository = $repository;
    }    

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setPrecio(float $precio): void {
        $this->precio = $precio;
    }

    public function getPrecio(): float {
        return $this->precio;
    }

    public function existe(): bool {
        return $this->id > 0;
    }

    public static function listar(OrdenCompraRepository $repository): array {
        return $repository->listarItems();
    }

    public static function buscarPorId(OrdenCompraRepository $repository, int $idItem): ?Item{
        return $repository->buscarItemPorId($idItem);
    } 
}