<?php

require_once 'Conexion.php';

class Colaborador extends Conexion{

  private $accesoBD;

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
  }

  // Datos[] es un array asociativo, que contiene la información
  // a guardar proveniente del controlador
  public function registrarColaborador($datos = []){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_registrar(?,?,?,?,?,?,?,?)");
      $consulta->execute(
        array(
          $datos['idcargo'],
          $datos['idsede'],
          $datos['apellidos'],
          $datos['nombres'],
          $datos['telefono'],
          $datos['tipocontrato'],
          $datos['cv'],
          $datos['direccion']
        )
      );
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function listarColaboradores(){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_listar()");
      $consulta->execute();
      
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function eliminarColaborador($idcolaborador = 0){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_eliminar(?)");
      $consulta->execute(array($idcolaborador));
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function actualizarColaborador($datos = []){
    try{
        // 1. Preparamos la consulta
        $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_actualizar(?,?,?,?,?,?,?,?,?)");
        // 2. Ejecutamos la consulta
        $consulta->execute(
          array(
            $datos["idcolaborador"],
            $datos["apellidos"],
            $datos["nombres"],
            $datos["idcargo"],
            $datos["idsede"],
            $datos["telefono"],
            $datos["tipocontrato"],
            $datos["cv"],
            $datos["direccion"]
          )
        );
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function eliminarCv($idcolaborador=0){
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_cv_eliminar(?)");
      $consulta->execute(array($idcolaborador));

      return $consulta->fetch(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
        die($e->getMessage());
    }
  }



}