<?php
class Persona extends Conexion{
 
    //Crea un dueño de equipo
    function post(){
        $documento=$_REQUEST['documento'];
        $tipo_documento=$_REQUEST['tipo_documento'];
        $response=new stdClass();
        if($this->bd->persona()->where("documento=? and tipo_documento=$tipo_documento",$documento)->fetch()){
            http_response_code(409);
            $response->descripcion="Ya se ha registrado la persona";
            //OUTPUT: {"descripcion":"Ya se ha registrado la persona"}
        }
        else{
            $fila=$this->bd->persona()->insert(array(
                "documento" =>$documento,
                "tipo_documento" =>$tipo_documento,
                "nombre" =>$_REQUEST['nombre'],
                "telefono" =>$_REQUEST['telefono'],
                "email" =>$_REQUEST['email']           
            ));            
            http_response_code(201);
            $response->id=$fila["id"];
            $response->descripcion="Registro correcto";
            //OUTPUT: {"id":"9","descripcion":"Registro correcto"}
        }
        echo json_encode($response);
    }
    
    function get(){
        $response=new stdClass();
        //Consulta la persona con ID especificado
        if(!empty($_REQUEST["id"])){
            $id=$_REQUEST["id"];
            $fila=$this->bd->persona[$id];
            if($fila){
                $response->documento=$fila["documento"];
                $response->tipo_documento=$fila["tipo_documento"];
                $response->nombre=utf8_encode($fila["nombre"]);
                $response->telefono=$fila["telefono"];
                $response->email=$fila["email"];
                $response->imagen=$fila["imagen"];
                //OUTPUT: {"documento":"1117516483","tipo_documento":"CEDULA","nombre":"Sergio Andr\u00e9s \u00d1ustes","telefono":"3115561825","email":"infinito84@gmail.com","imagen":"img\/sergio.png"}
            }
            else{
                http_response_code(404);
                $response->description="No existe persona";
                //OUTPUT: {"description":"No existe persona"}
            }
        }
        //Consulta las personas segun su participacion, TRANSPORTADOR o INSTALADOR
        else if(!empty($_REQUEST["tipo"])){
            $tipo=$_REQUEST["tipo"];
            $participantes=$this->bd->participante()->where("rol=?",$tipo);
            $response->total=$participantes->count();
            $response->participantes=array();
            foreach($participantes as $p){
                $persona=new stdClass();
                $persona->id=$p->usuario->persona["id"];
                $persona->documento=$p->usuario->persona["documento"];
                $persona->tipo_documento=$p->usuario->persona["tipo_documento"];
                $persona->nombre=utf8_encode($p->usuario->persona["nombre"]);
                $persona->telefono=$p->usuario->persona["telefono"];
                $persona->email=$p->usuario->persona["email"];
                $persona->imagen=$p->usuario->persona["imagen"];
                $response->participantes[]=$persona;
            }
            //OUTPUT: {"total":1,"participantes":[{"documento":"1118021357","tipo_documento":"CEDULA","nombre":"Cristiam Diaz","telefono":"3144681029","email":"c.diaz@udla.edu.co","imagen":"img\/cristiam.png"}]}
        }
        //Consulta los dueños de equipo de un sistema registrados
        else{
            $sin_usuario=$this->bd->persona()->where("usuario:id is null")->group("persona.id");
            $response->total=$sin_usuario->count();
            $response->personas=array();
            foreach($sin_usuario as $p){
                $persona=new stdClass();
                $persona->id=$p["id"];
                $persona->documento=$p["documento"];
                //$persona->tipo_documento=$p["tipo_documento"];
                $persona->text=utf8_encode($p["nombre"]);
                //$persona->telefono=$p["telefono"];
                //$persona->email=$p["email"];
                //$persona->imagen=$p["imagen"];
                $response->personas[]=$persona;
            }
            //OUTPUT: {"total":1,"personas":[{"documento":"1117516482","tipo_documento":"CEDULA","nombre":"Sergio Andr\u00c3\u00a9s \u00c3\u0091ustes","telefono":"3115561825","email":"infinito84@gmail.com","imagen":null}]}
        }
        echo json_encode($response);
    }

}
