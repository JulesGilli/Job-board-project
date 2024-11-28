<?php

class Advertisements{
    private $id, $title, $descr, $salaire, $type, $date, $workingH, $idC;

    public function __construct($id, $title, $descr, $salaire, $type, $date, $workingH, $idC) {
        $this->id = $id;
        $this->title = $title;
        $this->descr = $descr;
        $this->salaire = $salaire;
        $this->type = $type;
        $this->date = $date;
        $this->workingH = $workingH;
        $this->idC = $idC;
    }

    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getDescr() { return $this->descr; }
    public function getSalaire() { return $this->salaire; }
    public function getType() { return $this->type; }
    public function getDate() { return $this->date; }
    public function getWorkingH() { return $this->workingH; }
    public function getIdC() { return $this->idC; }

    public function setId($id) {
        $this->id = $id;
    }
    public function setTitle($title) {
        $this->title = $title;
    }
    public function setDescr($descr) {
        $this->descr = $descr;
    }
    public function setSalaire($salaire) {
        $this->salaire = $salaire;
    }
    public function setType($type) {
        $this->type = $type;
    }
    public function setDate($date) {
        $this->date = $date;
    }
    public function setWorkingH($workingH) {
        $this->workingH = $workingH;
    }
    public function setIdC($idC) {
        $this->idC = $idC;
    }
}