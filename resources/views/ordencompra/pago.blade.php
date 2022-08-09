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
  

  <!-- Title -->
  <title>Orden de compra</title>
</head>
<body>

  <main>

    <div class="container">        

        <h3 class="mt-5">Orden # {{ $orden->getId() }} </h3>

        <div class="row">
            <div class="col-6">
                <table class="table table-striped">
                    <tbody>
                        @foreach ($orden->listarItems() as $item)
                        <tr>
                            <td>{{ $item->getNombre() }}</td>
                            <td>${{ number_format($item->getPrecio(), 2) }} COP</td>
                        </tr>
                      @endforeach
                      <tr>
                        <td>Total a pagar</td>
                        <td class="h5 text-success">
                            ${{ number_format($orden->calcularTotal(), 2) }} COP
                        </td>
                    </tr>              
                    </tbody>
                  </table>
            </div>

            <div class="col-6">

              <form method="POST" action="{{ route('orden.pagar') }}">
              @csrf
              <input type="hidden" name="idOrdenCompra" value="{{ $orden->getId() }}">

              <p class="mb-2">Forma de pago:</p>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="paypal" name="medio" value="paypal" class="custom-control-input">
                <label class="custom-control-label" for="paypal">PayPal</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="tarjeta-credito" name="medio" value="tarjeta-credito" class="custom-control-input">
                <label class="custom-control-label" for="tarjeta-credito">Tarjeta de crédito</label>
              </div>

              <div class="mt-3">
                <div id="s-paypal">

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-12">
                              <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-12">
                              <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
                            </div>
                        </div>                                          
                </div>

                <div id="s-tarjeta-credito">

                        <div class="form-group row">
                            <label for="nombre" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="numeroTarjeta" class="col-sm-12 col-form-label"></label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" id="numeroTarjeta" name="numeroTarjeta" placeholder="Número tarjeta">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="ccv" class="col-sm-12 col-form-label"></label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" id="ccv" name="ccv" placeholder="CCV">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label for="fechaExpiracion" class="col-sm-12 col-form-label"></label>
                            <div class="col-sm-12">
                              <input type="text" class="form-control" id="fechaExpiracion" name="fechaExpiracion" placeholder="Fecha expiración">
                            </div>
                          </div>                          
                        </div>

                </div>
                <button type="submit" id="btn-pagar" class="btn btn-success mt-3">Realizar pago</button>
              </div>       
              </form>
            </div>

        </div>   
    </div>
    
</main>


  <noscript>Your browser don't support JavaScript!</noscript>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <script>
    $("#s-paypal").hide();
    $("#s-tarjeta-credito").hide();
    $("#btn-pagar").hide();

    $("#paypal").click(function() {
        $("#s-paypal").show();
        $("#s-tarjeta-credito").hide();
        $("#btn-pagar").show();
    });

    $("#tarjeta-credito").click(function(){
        $("#s-tarjeta-credito").show();
        $("#s-paypal").hide();
        $("#btn-pagar").show();
    });    
  </script>
</body>
</html>