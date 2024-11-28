<?php

class BdPdo
{   private $connexion;

    // constructeur de la classe BdPdo : en PHP le constructeur se nomme toujours __construct
    public function __construct() 
    {  
        try{
            $this->connexion=new PDO('mysql:host=mysql-bdjobboard.alwaysdata.net;dbname=bdjobboard_board','379270_jobboard','cMonPwdCQRizé');
            $this->connexion->query("SET CHARACTER SET utf8");
            //echo "<br/>connexion réussie.<br/>";
        }
        catch (PDOException $erreur){
            echo "Erreur de connexion à la base de données ".$erreur->getMessage();
        }
    }

    protected function getConnexion() {   
        return $this->connexion;
    }
}