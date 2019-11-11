<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 15/09/2016
 * Time: 14:19
 */
class Data{
    private $DataTime;


    public function __construct(){
        $this->DataTime = new DateTime();
    }

    public function PTBRHojeMYSQL($data){
        $data = str_replace('/', '-', $data);
        $DataTime = new DateTime($data);
        return $DataTime->format("Y-m-d H:i");
    }

    public function MYSQLparaPTBR($data){
        $DataTime = new DateTime($data);
        return $DataTime->format("d/m/Y H:i");
    }



}