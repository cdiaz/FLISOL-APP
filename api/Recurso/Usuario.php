<?php
/** PHP API RESTFUL
* @author Sergio Andrés Ñustes, infinito84@gmail.com
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class Usuario extends Conexion{
    
    public $validarApiKey=true;
        
    function post(){
        $response=new stdClass();
        $response->success=true;
        //Un arreglo
        $persona=new stdClass();
        $persona->nombre="andres";
        $personas=array();
        $personas[]=$persona;
        $personas[]=$persona;
        $personas[]=$persona;
        $response->personas=$personas;
        echo json_encode($response);
    }
    
    function get(){
        $response=new stdClass();
        $response->success=true;
        //Un objeto
        $persona=new stdClass();
        $persona->nombre="SErgio";
        $response->persona=$persona;
        echo json_encode($response);
    }
    
    function delete(){
        echo "{success:false,description:'No se ha creado el indice'}";
    }
}