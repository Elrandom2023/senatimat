<?php

require_once '../models/Colaborador.php';
if (isset($_POST['operacion'])){

  $colaborador = new Colaborador();

  if ($_POST['operacion'] == 'registrar'){

    // PASO 1: Recolectar todos los valores enviados
    // por la vista y almacenarlos en un array asociativo
    $datosGuardar = [
      "idcargo"        => $_POST['idcargo'],
      "idsede"         => $_POST['idsede'],
      "apellidos"      => $_POST['apellidos'],
      "nombres"        => $_POST['nombres'],
      "telefono"       => $_POST['telefono'],
      "tipocontrato"   => $_POST['tipocontrato'],
      "cv"             => '',
      "direccion"      => $_POST['direccion']
    ];

    // Vamos a verificar si la vista nos envio una CV
    if (isset($_FILES['cv'])){

      $rutaDestino = '../views/document/pdf/';
      $fechaActual = date('c'); //C = Complete, AÑO MES DIA HORA MINUTO SEGUNDO
      $nombreArchivo = sha1($fechaActual).".pdf";
      $rutaDestino .= $nombreArchivo;

      // Guardamos la CV en el servidor
      if (move_uploaded_file($_FILES['cv']['tmp_name'], $rutaDestino)){
        $datosGuardar['cv'] = $nombreArchivo;
      }

    }

    // PASO 2: Enviar el array al metodo registrar
    $colaborador->registrarColaborador($datosGuardar);

  }

  if ($_POST['operacion'] == 'listar'){
    $data = $colaborador->listarColaboradores();

    if ($data){
      $numeroFila = 1;
      $datosColaborador = '';
      $botonCv = "  <a href='#' class='btn btn-sm btn-secondary' title='No tiene CV'><i class='bi bi-filetype-pdf'></i></a>";

      foreach($data as $registro){
        $datosColaborador = $registro['apellidos'] . ' ' . $registro['nombres'];

        // La primera parte a RENDERIZAR, es lo standar (siempre se muestra)
        echo"
          <tr>
            <td>{$numeroFila}</td>
            <td>{$registro['apellidos']}</td>
            <td>{$registro['nombres']}</td>
            <td>{$registro['cargo']}</td>
            <td>{$registro['sede']}</td>
            <td>{$registro['telefono']}</td>
            <td>{$registro['tipocontrato']}</td>
            <td>{$registro['direccion']}</td>
            <td>
              <a href='#' data-idcolaborador='{$registro['idcolaborador']}' class='btn btn-danger btn-sm eliminar'><i class='bi bi-trash3'></i></a>";
        // La segunda parte a RENDERIZAR, es el boton VER CV
        if ($registro['cv'] == ''){
          echo $botonCv;
        }else{
          echo "  <a href='../views/document/pdf/{$registro['cv']}' target='_blank' class='btn btn-warning btn-sm'><i class='bi bi-filetype-pdf'></i></a>";
        }

        // La tercera parte a RENDERIZAR, cierre 
        echo "
            </td>
          </td>
        ";

        $numeroFila++;
      }
    }
  } // FIN OPERACION = LISTAR

  if ($_POST['operacion'] == 'eliminar'){
    $colaborador->eliminarColaborador($_POST['idcolaborador']);
  }

  if ($_POST['operacion'] == 'actualizar'){
    // PASO 1: Recoger los datos que nos envia la vista (FORM, utilizando AJAX)
    $datosForm = [
      "idcolaborador"   => $_POST['idcolaborador'],
      "apellidos"       => $_POST['apellidos'],
      "nombres"         => $_POST['nombres'],
      "idcargo"         => $_POST['idcargo'],
      "idsede"          => $_POST['idsede'],
      "telefono"        => $_POST['telefono'],
      "tipocontrato"    => $_POST['tipocontrato'],
      "cv"              => $_POST['cv'],
      "direccion"       => $_POST['direccion']
    ];

    // PASO 2: Enviar el arreglo como parametro del metodo ACTUALIZAR
    $curso->actualizarColaborador($datosForm);

}

if ($_POST['operacion'] == 'eliminarcv'){
    $registro = $colaborador->eliminarCv($_POST['idcolaborador']);
      
    if($registro == null ){
      echo"No hay registros";
    }else{
      unlink("../views/document/pdf/{$registro['cv']}");
    }
    
    }
}