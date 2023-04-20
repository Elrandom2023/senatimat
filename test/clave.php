<?php
$claveUsuario = "123456";
$claveHASH = password_hash($claveUsuario, PASSWORD_BCRYPT);

$claveAcceso = "123456";

if (password_verify($claveAcceso,$claveHASH)){
  echo "Acceso correcto";
  echo "{$claveHASH}";
}