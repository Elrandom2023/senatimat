<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login']){
  header('Location:views/index.php');
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./views/css/login.css">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <title>Luis VS</title>
</head>
<body class="bg-black">
<div class="container">
  <div class="row justify-content-center align-items-center">
    <div class="col-md-8 col-lg-5 borde">
      <h3 class="text-light m-5 text-center">Inicio de Sesión</h3>
      <form class="text-light">
        <div class="mb-3">
          <label for="usuario" class="form-label">Usuario</label>
          <input type="text" class="form-control" id="usuario" required>
        </div>
        <div class="mb-3">
          <label for="clave" class="form-label">Contraseña</label>
          <input type="password" class="form-control" id="clave" required>
        </div>
        <div class="d-flex justify-content-center align-items-center">
          <button type="button" class="btn btn-outline-light m-3" id="iniciar-sesion">Iniciar Sesión</button>
        </div>

      </form>
    </div>
  </div>
</div>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <script>
    $(document).ready(function (){

      function iniciarSesion(){
        const usuario = $("#usuario").val();
        const clave = $("#clave").val();

        if (usuario != "" && clave != ""){
          $.ajax({
            url: 'controllers/usuario.controller.php',
            type: 'POST',
            data: {
              operacion     : 'login',
              usuario : usuario,
              claveIngresada: clave
            },
            dataType: 'JSON',
            success: function (result){
              console.log(result);
              if (result["status"]){
                window.location.href = "views/index.php";
              }else{
                alert(result["mensaje"]);
              }
            }
          });
        }
      }

      $("#iniciar-sesion").click(iniciarSesion);

    })
  </script>

</body>
</html>