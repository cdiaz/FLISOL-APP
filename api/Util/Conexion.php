<?php
class Conexion{
    public $bd;
    public $validarApiKey=false;
    public $rolesPermitidos="*";
    
    function __construct() {
        $connection = new PDO("mysql:dbname=flisol","root","root");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $connection->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        $this->bd= new NotORM($connection);
        if($this->validarApiKey){
            //AQUI SE VALIDA EL API_KEY
        }
    }
}