<?php

require('./conector.php');

  $con = new ConectorBD('localhost','santiago','1234wer');

  $response['conexion'] =$con->initConexion('enterwork');

  if ($response['conexion']=='OK') {
      $resultado_consulta = $con->consultar(['usuario'],
      ['username', 'password'], 'WHERE username="'.$_POST['username'].'"');

      if ($resultado_consulta->num_rows != 0) {
        $fila = $resultado_consulta->fetch_assoc();
        if ($_POST['password'] = $fila['password']) {
          $response['msg'] = 'OK';
          session_start();
          $_SESSION['username'] = $fila['username'];
        }else {
          $response['motivo'] = 'Contraseña incorrecta';
          $response['msg'] = 'rechazado';
        }
      }else{
        $response['motivo'] = 'User incorrecto';
        $response['msg'] = 'rechazado';
      }

}

echo json_encode($response);

 $con->cerrarConexion();

 ?>
