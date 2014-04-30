<?php
/** PHP API RESTFUL
* @author Sergio Andrés Ñustes, infinito84@gmail.com
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
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
        $equipo["estado_id"]=$estado["id"];
        $equipo->update();
        $response=new stdClass();
        $response->equipo=$equipo["id"];
        $response->estado="REGISTRO";   
        //OUTPUT: {"equipo":"16","estado":"REGISTRO"}
        echo json_encode($response);
    }
    
    function get(){
        $response=new stdClass();
        //Trae la informacion del equipo, su estado actual, y todos sus comentarios,
        if(!empty($_REQUEST["id"])){
            $id=$_REQUEST["id"];
            $e=$this->bd->equipo->where("equipo.id=?",$id)->fetch();
            if($e){
                $response->tipo=$e["tipo"];
                $response->marca=$e["marca"];
                $response->modelo=$e["modelo"];
                $response->estado_actual=$e->estado["tipo"];
                $response->tiempo=$e->estado["tiempo"];
                $response->comentarios=array();
                foreach($e->estado->comentario() as $c){
                    $comentario=new stdClass();
                    $comentario->comentario=$c["descripcion"];
                    $response->comentarios[]=$comentario;
                }
                //OUTPUT: {"tipo":"PORTATIL","marca":"TOSHIBA","modelo":"123487","estado_actual":"REGISTRO","tiempo":"2014-04-23 23:29:07"
                //,"comentarios":[{"comentario":"hola"},{"comentario":"hola2"}]}
            }
            else{
                http_response_code(404);
                $response->description="No existe equipo con id $id";
                //OUTPUT: {"description":"No existe equipo con tal id"}
            }
        }
        //Consulta las personas segun su participacion, TRANSPORTADOR o INSTALADOR
        else if(!empty($_REQUEST["tipo"])){
            $tipo=$_REQUEST["tipo"];
            $equipos=$this->bd->equipo->select("equipo.tipo as tipo_equipo,equipo.marca,equipo.modelo,estado.*")->where("estado.tipo=?",$tipo);
            $response->total=$equipos->count();
            $response->equipos=array();
            foreach($equipos as $e){
                $equipo=new stdClass();
                $equipo->id=$e["equipo_id"];
                $equipo->text= "No: ".$e["equipo_id"].' - '.$e["tipo_equipo"].' - '.$e["marca"].' - '.$e["modelo"];
                //$equipo->tipo=$e["tipo_equipo"];
                //$equipo->marca=$e["marca"];
                //$equipo->modelo=utf8_encode($e["modelo"]);
                //$equipo->estado_actual=$e["tipo"];
                //$equipo->tiempo=$e["tiempo"];
                //$equipo->participante=utf8_encode($e->persona["nombre"]);
                //$equipo->imagen=$e->persona["imagen"];
                $response->equipos[]=$equipo;
            }
            //OUTPUT: {"total":1,"equipos":[{"id":"16","tipo":"PORTATIL","marca":"TOSHIBA","modelo":"123487","estado_actual":"REGISTRO"
            //,"tiempo":"2014-04-23 23:29:07","participante":"Sergio Andr\u00e9s \u00d1ustes","imagen":"img\/sergio.png"}]}
        }
        else if(!empty($_REQUEST["documento"])){
            $documento=$_REQUEST["documento"];
            $tipo_documento=$_REQUEST["tipo_documento"];
            $equipos=$this->bd->equipo->select("equipo.tipo as tipo_equipo,equipo.marca,equipo.modelo,estado.*")->where("persona.documento=? and persona.tipo_documento=?",$documento,$tipo_documento)->group("equipo.id");
            $response->total=$equipos->count();
            $response->equipos=array();
            foreach($equipos as $e){
                $equipo=new stdClass();
                $equipo->id=$e["equipo_id"];
                $equipo->tipo=$e["tipo_equipo"];
                $equipo->marca=$e["marca"];
                $equipo->modelo=utf8_encode($e["modelo"]);
                $equipo->estado_actual=$e["tipo"];
                $equipo->tiempo=$e["tiempo"];
                $equipo->propietario=utf8_encode($e->persona["nombre"]);
                $response->equipos[]=$equipo;
            }
            //OUTPUT: {"total":1,"equipos":[{"id":"16","tipo":"PORTATIL","marca":"TOSHIBA","modelo":"123487"
            //,"estado_actual":"REGISTRO","tiempo":"2014-04-23 23:29:07","propietario":"Sergio Andr\u00e9s \u00d1ustes"}]}

        }
        //Consulta los dueños de equipo de un sistema registrados
        else{
            $equipos=$this->bd->equipo->select("equipo.tipo as tipo_equipo,equipo.marca,equipo.modelo,estado:*")->order("estado:tiempo DESC")->group("equipo.id");
            $response->total=$equipos->count();
            $response->equipos=array();
            foreach($equipos as $e){
                $equipo=new stdClass();
                $equipo->id=$e["equipo_id"];
                $equipo->tipo=$e["tipo_equipo"];
                $equipo->marca=$e["marca"];
                $equipo->modelo=utf8_encode($e["modelo"]);
                $equipo->estado_actual=$e["tipo"];
                $equipo->tiempo=$e["tiempo"];
                $equipo->propietario=utf8_encode($e->persona["nombre"]);
                $response->equipos[]=$equipo;
            }
            //OUTPUT: {"total":1,"equipos":[{"id":"16","tipo":"PORTATIL","marca":"TOSHIBA","modelo":"123487","estado_actual":"REGISTRO"
            //,"tiempo":"2014-04-23 23:29:07","propietario":"Sergio Andr\u00e9s \u00d1ustes"}]}
        }
        echo json_encode($response);
    }

}
