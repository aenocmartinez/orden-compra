<?php
namespace Src\domain;

class PayPal implements MedioDePago {
    private $email;
    private $password;
    private $repository;

    public function __construct(?string $email, ?string $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function setRepository(OrdenCompraRepository $repository): void {
        $this->repository = $repository;
    }
    
    public function pagar(float $monto, int $ordenCompra): bool{
        $this->repository->pagarOrdenDeCompra($ordenCompra, "PayPal");
        return true;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

}