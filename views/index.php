<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] == false){
  header('Location:../');
}
?>

<!doctype html>
<html lang="es">

<head>
  <title>Colaboradores</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <!-- Iconos de Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
  
  <!-- LightBox CSS -->
  <link rel="stylesheet" href="../dist/lightbox2/src/css/lightbox.css">
    
</head>

<body>
  <div class="container">
    <!-- Modal trigger button -->
    <button type="button" class="btn btn-primary btn-lg m-5" data-bs-toggle="modal" data-bs-target="#modal-colaborador">
      Registrar
    </button>
    <table id="tabla-colaborador" class="table table-striped table-sm">
      <thead class="bg-primary text-light">
        <tr>
          <th>#</th>
          <th>Apellidos</th>
          <th>Nombres</th>
          <th>Cargo</th>
          <th>Sede</th>
          <th>Telefono</th>
          <th>Contrato</th>
          <th>Direccion</th>
          <th>Operaciones</th>
        </tr>
      </thead>
      <tbody>
      <!-- DATOS -->
      </tbody>
    </table>
  </div>
  <div class="card-footer text-start m-5">
    <a href="../views/estudiantes.php" style="text-decoration: none;" class="btn btn-success btn-sm"><i class="bi bi-arrow-bar-left"></i> Ir a la tabla de Estudiantes</a>
    <a href="../controllers/usuario.controller.php?operacion=finalizar" style="text-decoration: none;" class="btn btn-primary btn-sm"><i class="bi bi-box-arrow-left"></i> Cerrar Sesión</a>
  </div>
  
  
  <!-- Modal Body -->
  <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
  <div class="modal fade" id="modal-colaborador" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitleId">Registro de Colaborador</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" autocomplete="off" id="formulario-colaboradores" enctype="multipart/form-data">
            <!-- PARTE 1 -->
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control form-control-sm" id="apellidos">
              </div>
              <div class="mb-3 col-md-6">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control form-control-sm" id="nombres">
              </div>
            </div>
            <!-- PARTE 2 -->
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="cargo" class="form-label">Cargo:</label>
                <select name="cargo" id="cargo" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="sede" class="form-label">Sede:</label>
                <select name="sede" id="sede" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
            </div>
            <!-- PARTE 3 -->
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="telefono" class="form-label">Telefono:</label>
                <input type="text" class="form-control form-control-sm" id="telefono">
              </div>
              <div class="mb-3 col-md-6">
                <label for="tipocontrato" class="form-label">Tipo Contrato:</label>
                <select name="tipocontrato" id="tipocontrato" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                  <option value="P">Parcial</option>
                  <option value="C">Completo</option>
                </select>
              </div>
            </div>
            <!-- PARTE 4 -->
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="cv" class="form-label">Curriculum Vitae:</label>
                <input type="file" accept=".pdf" class="form-control form-control-sm" id="cv">
              </div>
              <div class="mb-3 col-md-6">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" class="form-control form-control-sm" id="direccion">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="guardar-colaborador">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  
  


  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- LightBox JS -->
  <script src="../dist/lightbox2/src/js/lightbox.js"></script>

  <script>

    $(document).ready(function (){
      
      function obtenerSedes(){
        $.ajax({
          url: '../controllers/sede.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function(result){
            $("#sede").html(result);
          }
        });
      }

      function obtenerCargos(){
        $.ajax({
          url: '../controllers/cargo.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function(result){
            $("#cargo").html(result);
          }
        });
      }

      function listarColaboradores(){
        $.ajax({
          url: '../controllers/colaborador.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function(result){
            $("#tabla-colaborador tbody").html(result);
          }
        });
      }

      function registrarColaborador(){

        // Enviaremos los datos dentro de un OBJETO
        var formData = new FormData();

        formData.append("operacion","registrar");
        formData.append("idcargo",$("#cargo").val());
        formData.append("idsede",$("#sede").val());
        formData.append("apellidos",$("#apellidos").val());
        formData.append("nombres",$("#nombres").val());
        formData.append("telefono",$("#telefono").val());
        formData.append("tipocontrato",$("#tipocontrato").val());
        formData.append("cv",$("#cv")[0].files[0]);
        formData.append("direccion",$("#direccion").val());

        $.ajax({
          url: '../controllers/colaborador.controller.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          cache: false,
          success: function(){
            $("#formulario-colaboradores")[0].reset();
            $("#modal-colaborador").modal("hide");
            alert("Guardado correctamente");
            listarColaboradores();
          }
        });
      }

      function preguntarRegistro(){
        Swal.fire({
          icon: 'question',
          title: 'Colaboradores',
          text: '¿Está seguro de registrar al colaborador?',
          footer: 'Desarrollado con PHP',
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#3498DB',
          showCancelButton: true,
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          //Identificando acción del usuario
          if (result.isConfirmed){
            registrarColaborador();
          }
        });
      }
      
      $("#guardar-colaborador").click(preguntarRegistro);
      $("#tabla-colaborador tbody").on("click", ".eliminar", function(){
        const cvEliminar = $(this).data("idcolaborador");
          $.ajax({
            url: '../controllers/colaborador.controller.php',
            type: 'POST',
            data: {
              operacion : 'eliminarcv',
              idcolaborador   : cvEliminar
            },
            success: function(result){
              if (result == ""){
                listarColaboradores();
              }
            }
          });
      });

      $("#tabla-colaborador tbody").on("click", ".eliminar", function(){
        const idcolaboradorEliminar = $(this).data("idcolaborador");
        if (confirm("¿Esta seguro de proceder, esto eliminara el registro del Colaborador?")){
          $.ajax({
            url: '../controllers/colaborador.controller.php',
            type: 'POST',
            data: {
              operacion : 'eliminar',
              idcolaborador   : idcolaboradorEliminar
            },
            success: function(result){
              if (result == ""){
                listarColaboradores();
              }
            }
          });
        }
      });


      listarColaboradores();
      obtenerSedes();
      obtenerCargos();

    });
  </script>








</body>

</html>