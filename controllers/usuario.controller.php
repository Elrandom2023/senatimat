<?php
session_start();
require_once '../models/Usuario.php';

if (isset($_POST['operacion'])){
  $usuario = new Usuario();

  if ($_POST['operacion'] == 'login'){
    $registro = $usuario->iniciarSesion($_POST['usuario']);

    $_SESSION["login"] = false;
    $resultado = [
      "status"    => false,
      "mensaje"   => ""
    ];

    if ($registro){
      $claveEncriptada = $registro["claveacceso"];
      
      if (password_verify($_POST['claveIngresada'], $claveEncriptada)){
        $resultado["status"] = true;
        $resultado["mensaje"] = "Bienvenido al sistema";
        $_SESSION["login"] = true;
      }else{
        $resultado["mensaje"] = "Error en la contraseña";
      }

    }else{
      $resultado["mensaje"] = "No encontramos al usuario";
    }

    echo json_encode($resultado);

  }
}

if (isset($_GET['operacion'])){

  if ($_GET['operacion'] == 'finalizar'){
    session_destroy();
    session_unset();
    header('Location:../index.php');
  }
}
