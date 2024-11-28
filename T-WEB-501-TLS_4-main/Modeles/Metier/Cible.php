<?php

class Cible{
    private $idA, $idP, $mess;

    public function __construct($idA, $idP, $mess){
        $this->idA = $idA;
        $this->idP = $idP;
        $this->mess = $mess;
    }

    public function getIdA(){
        return $this->idA;
    }
    public function getIdP(){
        return $this->idP;
    }
    public function getMes(){
        return $this->mess;
    }

    public function setIdA($idA){
        $this->idA = $idA;
    }
    public function setIdP($idP){
        $this->idP = $idP;
    }
    public function setMes($mess){
        $this->mess = $mess;
    }
}