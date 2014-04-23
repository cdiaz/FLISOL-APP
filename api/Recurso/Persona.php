<?php
class Persona extends Conexion{

    function get() {
        $personas=array();
        foreach ($this->bd->persona() as $persona) {
            $p=new stdClass();
            $p->id=$persona["id"];
            $p->documento=$persona["documento"];
            $p->tipo_documento=$persona["tipo_documento"];
            $p->telefono=$persona["telefono"];
            $p->email=$persona["email"];
            $p->email=$persona["email"];
            $personas[]=$p;
        }
        $response=new stdClass();
        $response->success=true;
        $response->personas=$personas;
        echo json_encode($response);
        echo "<br><br>Hola ";
        $s=$this->bd->persona();
        echo json_encode(array_map('iterator_to_array', iterator_to_array($s)));
        echo "2";
    }
    
    function post(){
        $this->bd->persona()->insert(array(
            "documento" =>$_REQUEST['documento'],
            "tipo_documento" =>$_REQUEST['tipo_documento'],
            "nombre" =>$_REQUEST['nombre'],
            "telefono" =>$_REQUEST['telefono'],
            "email" =>$_REQUEST['email']           
        ));
    }

}
