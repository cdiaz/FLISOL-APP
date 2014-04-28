<?php
/** PHP API RESTFUL
* @author Sergio Andrés Ñustes, infinito84@gmail.com
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
*/
class Login extends Conexion{
    
    function get() {
        $usuario=$_REQUEST['usuario'];
        $clave=$_REQUEST['clave'];
        $user = $this->bd->usuario("usuario = ?",$usuario)->fetch();
        $response=new stdClass();
        if($user){
            if($user["clave"]==$clave){
                $response->nombre=  utf8_encode($user->persona['nombre']);
                $response->imagen=  $user->persona['imagen'];
                $participante=$user->participante()->fetch();
                $response->rol=$participante["rol"];   
                $response->api_key=time()."_".md5(rand());
                $futureDate = time()+(60*15);
                $formatDate = date("Y-m-d H:i:s", $futureDate);
                $user->api_key()->delete();
                $user->api_key()->insert(array(
                    "api_key" =>$response->api_key,
                    "vencimiento" => $formatDate
                ));
                Notificar("login",array(
                    'quien'=>$response->nombre
                ));
            }
            else{
                http_response_code(401);
                $response->descripcion="Ha escrito una clave incorrecta";
            }
        }
        else{
            http_response_code(401);
            $response->descripcion="No existe usuario";
        }
        echo json_encode($response);
    }

}
