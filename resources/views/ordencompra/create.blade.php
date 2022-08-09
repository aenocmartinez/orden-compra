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
  
  <main>

    <div class="container">
  
      <h3 class="mt-5 mb-5">Orden # {{ $orden->getId() }} </h3>

      <div id="s-items-pedido">
        <ul>          
        @foreach ($orden->listarItems() as $item)
          <li class="d-block h5">
            {{ $item->getNombre() }} 
            <small class="text-muted">
              ${{ number_format($item->getPrecio(), 2) }} COP
            </small>
          </li>  
        @endforeach
      </ul>
    
      <a href="{{route('ordenes')}}" class="btn btn-primary mt-4 mb-4">
        Guardar
      </a>
    
      </div>      

    <div class="row row-cols-1 row-cols-md-4 g-4">

        @foreach ($items as $item)            
        <div class="col">
            <div class="card h-100">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em"></text></svg>
                <div class="card-body">
                <h5 class="card-title">{{ $item->getNombre() }}</h5>
                <p class="card-text">${{ number_format($item->getPrecio(), 2) }} COP</p>
                </div>
                <div class="card-footer text-center">
                    <form action="{{route('orden.agregar-item')}}" method="POST">
                        @csrf
                        <input type="hidden" name="idOrdenCompra" value="{{ $orden->getId() }}">
                        <input type="hidden" name="idItem" value="{{ $item->getId() }}">
                        <button type="submit" class="btn btn-outline-primary">Agregar a la orden</button>
                    </form>                
                </div>
            </div>
        </div>
        @endforeach


      </div>   
      
    </div>
    
  </main>

  <footer>    
    <p>&copy; @php echo date('Y'); @endphp </p>
  </footer>

  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="./scripts.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>