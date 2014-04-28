<?php
/** PHP API RESTFUL
* @author Sergio Andrés Ñustes, infinito84@gmail.com
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
ini_set('display_errors',1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
require_once 'Util/FuncionesComunes.php';

function __autoload($clase) {
    if (file_exists("Recurso/$clase.php")) {
        require_once "Recurso/$clase.php";
    }
    if (file_exists("Util/$clase.php")) {
        require_once "Util/$clase.php";
    }
}

function init(){
    $url = $_SERVER["PATH_INFO"];
    $recurso = strtok($url, "/");
    $method = $_SERVER['REQUEST_METHOD'];
    //GET PARAMS
    $param = strtok("/");
    while ($param != false) {
        $_REQUEST[$param] = strtok("/");
        $param = strtok("/");
    }
    //PUT PARAMS
    $puts=array();
    parse_str(file_get_contents("php://input"),$puts);
    if($puts){
        foreach ($puts as $key => $value) {
            $_REQUEST[$key] =$value;
        }
    }
    if(file_exists("Recurso/$recurso.php")){
        $api=new $recurso();
        if(method_exists($api,$method)){
            $api->$method();
        }
        else{
            http_response_code(405);
            echo "{success:false,'Metodo no disponible'}";
        }    
    }
    else{
        http_response_code(404);
        echo "{success:false,'Recurso no disponible'}";
    }
}

init();