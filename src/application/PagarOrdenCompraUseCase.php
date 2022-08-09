<?php
declare(strict_types=1);

namespace Src\application;

use Src\domain\OrdenCompraDTO;
use Src\domain\OrdenCompraRepository;
use Src\domain\OrdenDeCompra;
use Src\domain\PayPal;
use Src\domain\TarjetaCredito;

class PagarOrdenCompraUseCase {
    
    private $repository;

    public function __construct(OrdenCompraRepository $repository){
        $this->repository = $repository;
    }

    public function ejecutar(OrdenCompraDTO $ordenCompraDTO) {

        $medioPago = new PayPal($ordenCompraDTO->email, $ordenCompraDTO->password);

        if ($ordenCompraDTO->medio == "tarjeta-credito") {
            $medioPago = new TarjetaCredito(
                $ordenCompraDTO->nombre,
                $ordenCompraDTO->numeroTarjeta,
                $ordenCompraDTO->ccv,
                $ordenCompraDTO->fechaExpiracion
            );
        }


        $ordenCompra = OrdenDeCompra::buscarPorId($this->repository, $ordenCompraDTO->idOrdenCompra);

        if (!$ordenCompra?->existe()) {            
            return ;
        }

        $ordenCompra->setRepository($this->repository);
        $ordenCompra->pagar($medioPago);
    }
}