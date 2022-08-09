<?php
declare(strict_types=1);

namespace Src\domain;

use Src\domain\MedioDePago;

class TarjetaCredito implements MedioDePago {
    private $nombre;
    private $numeroTarjeta;
    private $ccv;
    private $fechaExpiracion;
    private $repository;

    public function __construct(string $nombre, string $numeroTarjeta, string $ccv, string $fechaExpiracion) {
        $this->nombre = $nombre;
        $this->numeroTarjeta = $numeroTarjeta;
        $this->ccv = $ccv;
        $this->fechaExpiracion = $fechaExpiracion;
    }

    public function setRepository(OrdenCompraRepository $repository): void {
        $this->repository = $repository;
    }    

    public function pagar(float $monto, int $ordenCompra): bool {    
        $this->repository->pagarOrdenDeCompra($ordenCompra, "Tarjeta de crédito");    
        return false;
    }
}