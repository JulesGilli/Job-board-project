<?php

class Companies{
    private $id, $nom, $secteur, $headO, $taille, $city;

    public function __construct($id, $nom, $secteur, $headO, $taille, $city){
        $this->id = $id;
        $this->nom = $nom;
        $this->secteur = $secteur;
        $this->headO = $headO;
        $this->taille = $taille;
        $this->city = $city;
    }

    #accesseur
    public function getId(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getSecteur(){
        return $this->secteur;
    }
    public function getHeadO(){
        return $this->headO;
    }
    public function getTaille(){
        return $this->taille;
    }
    public function getCity(){
        return $this->city;
    }

    #mutateur
    public function setId($id){
        $this->id = $id;
    }
    public function setNom($nom){
        $this->nom = $nom;
    }
    public function setSecteur($secteur){
        $this->secteur = $secteur;
    }
    public function setHeadO($headO){
        $this->headO = $headO;
    }
    public function setTaille($taille){
        $this->taille = $taille;
    }
    public function setCity($city){
        $this->city = $city;
    }
}