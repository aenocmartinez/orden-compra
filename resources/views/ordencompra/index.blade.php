<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Google Fonts Pre Connect -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <!-- Meta Tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Fonts Links (Roboto 400, 500 and 700 included) -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- CSS Files Links -->
  <link rel="stylesheet" href="./styles.css">

  <!-- Title -->
  <title>Orden de compra</title>
</head>
<body>
  <header>
    {{-- <h1>Orden de compra</h1> --}}
  </header>

  <main>

    <div class="container">

      <h1>Ordenes de compra</h1>

      @if (sizeof($ordenes) == 0)
          No existen ordenes de compras
      @endif
  
      <div class="mb-5 mt-5">
          <ul>            
          @foreach ($ordenes as $orden)
              <li class="d-block mb-3">
                  <h3>Orden # {{ $orden->getId() }} <small class="text-muted h6">{{ $orden->getEstado() }}</small></h3>
                  <small class="text-muted d-block">Número productos: {{ count($orden->listarItems()) }}</small>
                  <small class="text-muted d-block">Total de la orden: ${{ number_format($orden->calcularTotal(), 2) }} COP</small>
                  <small class="text-muted d-block">{{ $orden->getCreatedAt() }}</small>
                  @if ($orden->estaPendiente())                    
                    <small class="text-muted d-block">
                      <a href="{{route('orden.buscar',['id'=>$orden->getId()])}}" class="btn btn-danger mt-1">Realizar pago</a>
                    </small>
                  @else 
                  <small class="text-muted d-block">
                    <small class="text-muted d-block">Medio de pago: {{ $orden->getMedioPago() }} </small>
                  </small>                
                  @endif                
              </li>
          @endforeach
          </ul>
      </div>
  
      <a href="{{ route('orden.crear') }}" class="btn btn-primary mt-4 mb-4">
          Nueva orden de compra
      </a>

    </div>
    
  </main>

  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="./scripts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>