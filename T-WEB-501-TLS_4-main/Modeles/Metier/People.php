<?php

class People{
    private $id, $firstName, $name, $email, $phone, $city, $cp, $country, $password, $cv;

    public function __construct($firstName, $name, $email, $phone, $city, $cp, $country, $password, $id = null, $cv = null){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->city = $city;
        $this->cp = $cp;
        $this->country = $country;
        $this->password = $password;
        if(isset($cv)){
            $this->cv = $cv;
        }
    }

    public function getId(){
        return $this->id;
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function getName(){
        return $this->name;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function getCity(){
        return $this->city;
    }

    public function getCp(){
        return $this->cp;
    }

    public function getCountry(){
        return $this->country;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getCv(){
        if(isset($this->cv)){
            return $this->cv;
        }else{
            return null;
        }
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setPhone($phone){
        $this->phone = $phone;
    }

    public function setCp($cp){
        $this->cp = $cp;
    }

    public function setCountry($country){
        $this->country = $country;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setCity($city){
        $this->city = $city;
    }

    public function setCv($cv){
        $this->cv = $cv;
    }
}