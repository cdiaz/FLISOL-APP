<?php
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