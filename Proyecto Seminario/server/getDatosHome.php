<?php
require('./conector.php');

session_start();

if (isset($_SESSION['username'])) {
  $con = new ConectorBD('localhost', 'santiago', '1234wer');

  if ($con->initConexion('enterwork')=='OK') {
    $response['msg'] = 'OK';
  }else {
    $response['msg'] = 'Error en la comunicacion con la base de datos.';
  }
}else {
  $response['msg'] = 'No hay sesión abierta.';
}

echo json_encode($response);

//echo json_encode($eventArray);

$con->cerrarConexion();

 ?>
