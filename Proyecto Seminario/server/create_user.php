<?php

  include('conector.php');

  if($_POST['nit'] == ''){
    $dataPersona['nombre'] = "'".$_POST['nombrePersona']."'";
    $dataPersona['apellido'] = "'".$_POST['apellido']."'";
    $dataPersona['email'] = "'".$_POST['email']."'";
    $dataPersona['fechaNacimiento'] = "'".$_POST['fechaNacimiento']."'";

    $dataUser['username'] = "'".$_POST['username']."'";
    $dataUser['password'] = "'".$_POST['nombre']."'";
  }else {
    $dataPersona['nombre'] = "'".$_POST['nombrePersona']."'";
    $dataPersona['apellido'] = "'".$_POST['apellido']."'";
    $dataPersona['email'] = "'".$_POST['email']."'";
    $dataPersona['fechaNacimiento'] = "'".$_POST['fechaNacimiento']."'";

    $dataEmpresa['NIT'] = "'".$_POST['nit']."'";
    $dataEmpresa['nombre'] = "'".$_POST['nombreEmp']."'";
    $dataEmpresa['descripcion'] = "'".$_POST['descripcion']."'";

    $dataUser['username'] = "'".$_POST['username']."'";
    $dataUser['password'] = "'".$_POST['nombre']."'";
  }

  $con = new ConectorBD('localhost','santiago','kgUe2EFh#+gG');
  $response['conexion'] = $con->initConexion('enterwork');

  if ($response['conexion']=='OK') {
    if($con->insertData('persona', $dataPersona)){
      $consulta_person = $con->consultar(['persona'], ['id'], "WHERE email ='" .$dataPersona['nombre']."'");
      $filaPerson = $consulta_user->fetch_assoc();

      $dataUser['fk_persona'] = $filaPerson['id'];
      if($_POST['nit'] == ''){
        if($con->insertData('usuario', $dataUser){
          $response['msg']="exito en la inserción";
        }else {
          $response['msg']= "Hubo un error y los datos de usuario no han sido cargados";
        }
      }else{
        if($con->insertData('empresa', $dataEmpresa){
          if($con->insertData('usuario', $dataUser){
            $response['msg']="exito en la inserción";
          }else {
            $response['msg']= "Hubo un error y los datos de usuario no han sido cargados";
          }
        }else {
          $response['msg']= "Hubo un error y los datos de empresa no han sido cargados";
        }
      }
    }else {
      $response['msg']= "Hubo un error y los datos de persona no han sido cargados";
    }
  }else {
    $response['msg']= "No se pudo conectar a la base de datos";
  }

  echo json_encode($response);


 ?>
