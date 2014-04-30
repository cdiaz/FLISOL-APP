<?php
/** PHP API RESTFUL
* @author Sergio Andrés Ñustes, infinito84@gmail.com
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
//Esto se convertirá en una clase en una futura versión XD
function personaConectada(){
	$header = apache_request_headers();
    $c=new Conexion();
    $conectado=$c->bd->usuario()->select("persona.id")->where("api_key:api_key=?",$header['API_KEY'])->fetch();
    return $conectado["id"];
}

function Notificar($event,$args){
	$elephant = new ElephantIO('http://localhost:1123');
    $elephant->init();
    $elephant->emit($event,$args);
    $elephant->close();
}
