<?php
declare(strict_types=1);


namespace Src\domain;

interface MedioDePago {
    public function setRepository(OrdenCompraRepository $repository): void;
    public function pagar(float $monto, int $ordenCompra): bool;
}