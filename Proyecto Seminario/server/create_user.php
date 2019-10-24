<?php

  include('conector.php');

    $dataPersona['nombre'] = "'".$_POST['nombrePersona']."'";
    $dataPersona['apellido'] = "'".$_POST['apellido']."'";
    $dataPersona['email'] = "'".$_POST['email']."'";
    $dataPersona['fechaNacimiento'] = "'".$_POST['fechaNacimiento']."'";

    $dataEmpresa['NIT'] = "'".$_POST['nit']."'";
    $dataEmpresa['nombre'] = "'".$_POST['nombreEmp']."'";
    $dataEmpresa['descripcion'] = "'".$_POST['descripcion']."'";

    $dataUser['username'] = "'".$_POST['username']."'";
    $dataUser['password'] = "'".$_POST['contrasena']."'";

  $con = new ConectorBD('localhost','santiago','1234wer');
  $response['conexion'] = $con->initConexion('enterwork');

  if ($response['conexion']=='OK') {
    if($con->insertData('persona', $dataPersona)){
      if($con->insertData('empresa', $dataEmpresa)){
        if($con->insertData('usuario', $dataUser)){
          $response['msg']="exito en la inserción";
        }else {
          $response['msg']= "Hubo un error y los datos de usuario no han sido cargados";
        }
      }else {
        $response['msg']= "Hubo un error y los datos de empresa no han sido cargados";
      }
    }else {
      $response['msg']= "Hubo un error y los datos de persona no han sido cargados";
    }
  }else {
    $response['msg']= $response['conexion'];
  }

  echo json_encode($response);


 ?>
