<?php
class Equipo extends Conexion{
 
    //Crea un nuevo equipo en el sistema. 
    //Y le crea automaticamente el estado de registro. 
    //Solo los comentarios del registro se envian en un arreglo json.
    function post(){
        $equipo=$this->bd->equipo()->insert(array(
            'tipo'=>$_REQUEST['tipo'],
            'marca'=>$_REQUEST['marca'],
            'modelo'=>$_REQUEST['modelo'],
            'persona_id'=>$_REQUEST['persona'],
            'evento_id'=>1 //WARNING: Después toca actualizar para que tome el evento actual, futura versión XD
        ));
        $estado=$equipo->estado()->insert(array(
            'persona_id'=> personaConectada(),
            'tipo'=>"REGISTRO"
        ));
        $comentarios=json_decode($_REQUEST['comentarios']);//JSON=[{"comentario":"a"},{"comentario":"b"}]
        foreach($comentarios as $c){
            $estado->comentario()->insert(array(
                "descripcion"=>$c->comentario
            ));
        }
        $response=new stdClass();
        $response->equipo=$equipo["id"];
        $response->estado="REGISTRO";   
        //OUTPUT: {"equipo":"16","estado":"REGISTRO"}
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
                $persona->documento=$p["documento"];
                $persona->tipo_documento=$p["tipo_documento"];
                $persona->nombre=utf8_encode($p["nombre"]);
                $persona->telefono=$p["telefono"];
                $persona->email=$p["email"];
                $persona->imagen=$p["imagen"];
                $response->personas[]=$persona;
            }
            //OUTPUT: {"total":1,"personas":[{"documento":"1117516482","tipo_documento":"CEDULA","nombre":"Sergio Andr\u00c3\u00a9s \u00c3\u0091ustes","telefono":"3115561825","email":"infinito84@gmail.com","imagen":null}]}
        }
        echo json_encode($response);
    }

}
