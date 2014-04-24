<?php
class Estado extends Conexion{

    //Agrega el estado al equipo especificado junto con sus comentarios, estos comentarios es un parametro que se envia en formato json
    function post() {
        $id=$_REQUEST['equipo'];
        $estado=$_REQUEST['estado'];
        $equipo = $this->bd->equipo[$id];
        $response=new stdClass();
        if($equipo){
            $estado=$equipo->estado()->insert(array(
                'persona_id'=> $_REQUEST["persona"],
                'tipo'=>$estado
            ));
            $comentarios=json_decode($_REQUEST['comentarios']);//JSON=[{"comentario":"a"},{"comentario":"b"}]
            foreach($comentarios as $c){
                $estado->comentario()->insert(array(
                    "descripcion"=>$c->comentario
                ));
            }
            http_response_code(201);
            $response->descripcion="Se ha registrado el nuevo estado";
        }
        else{
            http_response_code(401);
            $response->descripcion="No existe equipo con id=$id";
        }
        echo json_encode($response);
    }

}
