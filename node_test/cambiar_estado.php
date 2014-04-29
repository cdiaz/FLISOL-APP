<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
/*
se actualiza en la bd y después se notifica a socket.io
WARNING: requiere php5-curl
*/

require( __DIR__ . '/ElephantIO/Client.php');
use ElephantIO\Client as ElephantIOClient;
$elephant = new ElephantIOClient('http://localhost:1123');
$elephant->init();
$args = array(
    'quien'=>$_REQUEST['quien']
);
$elephant->emit('cambio_estado',$args);
$elephant->close();