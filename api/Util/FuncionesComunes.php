<?php
//Esto se convertirá en una clase en una futura versión XD
function personaConectada(){
    $c=new Conexion();
    $conectado=$c->bd->usuario()->select("persona.*")->where("api_key:api_key=?",$_REQUEST["api_key"])->fetch();
    return $conectado["id"];
}
