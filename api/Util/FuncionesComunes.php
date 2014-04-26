<?php
//Esto se convertirá en una clase en una futura versión XD
function personaConectada(){
	$header = apache_request_headers();
    $c=new Conexion();
    $conectado=$c->bd->usuario()->select("persona.id")->where("api_key:api_key=?",$header['API_KEY'])->fetch();
    return $conectado["id"];
}
