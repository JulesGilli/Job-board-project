<?php 

# Inclusion de la classe métier People
include("Modeles/Metier/People.php");

# Déclaration de la classe Bd_People qui hérite de BdPdo
class Bd_People extends BdPdo {

    # Méthode pour récupérer un People spécifique par ID
    public function getUnPeople($id): People {
        # Création de la requête SQL pour sélectionner un enregistrement par ID
        $req = "Select * from People where idP = ".$id.";";

        # Exécution de la requête
        $resultat = $this->getConnexion()->query($req);

        # Récupération de la première ligne du résultat
        $laLigne = $resultat->fetch();

        # Vérification de l'existence d'un CV (champ facultatif)
        if( isset( $laLigne["cv"] ) ) {
            # Création de l'objet People avec le CV
            return $people = new People( $laLigne['prenom'], $laLigne['nom'], $laLigne['mel'], 
            $laLigne['tel'], $laLigne['cityP'], $laLigne['cp'], $laLigne['pays'], $laLigne['mdp'], $laLigne['idP'], $laLigne['cv']);
        } else {
            # Création de l'objet People sans le CV
            return $people = new People( $laLigne['prenom'], $laLigne['nom'], $laLigne['mel'], 
            $laLigne['tel'], $laLigne['cityP'], $laLigne['cp'], $laLigne['pays'], $laLigne['mdp'], $laLigne['idP']);
        }
    }

    # Méthode pour récupérer tous les People
    public function getPeoples(){
        # Requête SQL pour sélectionner tous les enregistrements
        $req = 'Select * from People';

        # Exécution de la requête
        $resultat = $this->getConnexion()->query($req);

        # Récupération de toutes les lignes du résultat
        $lesLignes = $resultat->fetchAll();

        # Initialisation d'un tableau pour stocker les objets People
        $tabPeople = [];

        # Boucle sur chaque ligne pour créer un objet People
        foreach($lesLignes as $laLigne){
            # Vérification de la présence du CV
            if( isset( $laLigne["cv"] ) ) {
                # Création de l'objet People avec le CV
                $people = new People( $laLigne['prenom'], $laLigne['nom'], $laLigne['mel'], 
                $laLigne['tel'], $laLigne['cityP'], $laLigne['cp'], $laLigne['pays'], $laLigne['mdp'], $laLigne['idP'], $laLigne['cv']);
            } else {
                # Création de l'objet People sans le CV
                $people = new People( $laLigne['prenom'], $laLigne['nom'], $laLigne['mel'], 
                $laLigne['tel'], $laLigne['cityP'], $laLigne['cp'], $laLigne['pays'], $laLigne['mdp'], $laLigne['idP']);
            }
            # Ajout de l'objet People dans le tableau
            $tabPeople[] = $people;
        }

        # Retourne le tableau d'objets People
        return $tabPeople;
    }

    # Méthode pour insérer un nouvel enregistrement People dans la base de données
    public function insertPeople($people){
        # Création de la requête SQL pour insérer un nouvel enregistrement
        $req = "Insert into People (nom, prenom, mel, tel, cityP, cp, pays, mdp, cv) values " 
        ."('".$people->getName()."','".$people->getFirstName()."','".$people->getEmail()."','".$people->getPhone()."','".$people->getCity()."','".$people->getCp()."','France','".md5($people->getPassword())."','".$people->getCv()."')";

        # Exécution de la requête
        $resultat = $this->getConnexion()->query($req);

        # Retourne le résultat de l'exécution (succès ou échec)
        return $resultat;
    }

    # Méthode pour mettre à jour un enregistrement People existant
    public function updatePeople(People $people){
        # Création de la requête SQL pour mettre à jour un enregistrement
        $req = "update People set "
        ."nom = '".$people->getName()."', prenom = '".$people->getFirstName()."', mel = '".$people->getEmail()."', tel = '".$people->getPhone()."', cityP = '".$people->getCity()."', cp = '".$people->getCp()."', cv = '".$people->getCv()."' "
        ."where idP = ".$people->getId().";";

        # Exécution de la requête
        $resultat = $this->getConnexion()->query($req);

        # Retourne le résultat de l'exécution (succès ou échec)
        return $resultat;
    }

    # Méthode pour supprimer un enregistrement People par ID
    public function deletePeople($id){
        # Création de la requête SQL pour supprimer un enregistrement
        $req = "Delete from People where idP = ".$id.";";

        # Exécution de la requête
        $resultat = $this->getConnexion()->query($req);

        # Retourne le résultat de l'exécution (succès ou échec)
        return $resultat;
    }

    public function getPeopleConnected($mel, $mdp){
        $req = "Select * from People where mel = '".$mel."' and mdp = '".md5($mdp)."';";

        $resultat = $this->getConnexion()->query($req);

        $laLigne = $resultat->fetch();

        if( isset( $laLigne["cv"] ) ) {
            # Création de l'objet People avec le CV
            return $people = new People( $laLigne['prenom'], $laLigne['nom'], $laLigne['mel'], 
            $laLigne['tel'], $laLigne['cityP'], $laLigne['cp'], $laLigne['pays'], $laLigne['mdp'], $laLigne['idP'], $laLigne['cv']);
        } else {
            # Création de l'objet People sans le CV
            return $people = new People( $laLigne['prenom'], $laLigne['nom'], $laLigne['mel'], 
            $laLigne['tel'], $laLigne['cityP'], $laLigne['cp'], $laLigne['pays'], $laLigne['mdp'], $laLigne['idP']);
        }
    }

    public function isAllowConnect($mel, $mdp){
        $req = "Select * from People where mel = '".$mel."' and mdp = '".md5($mdp)."';";

        $resultat = $this->getConnexion()->query($req);

        $laLigne = $resultat->fetch();

        if( $laLigne != null) {
            if(count($laLigne) == 0){
                return false;
            }else{
                return true;
            }
        } else {
            return false;
        }
    }

    public function isEmailUnique($mel){
        $req = "Select * from People where mel = '".$mel."';";

        $resultat = $this->getConnexion()->query($req);

        $laLigne = $resultat->fetch();

        if(count($laLigne) == 0){
            return true;
        }else{
            return false;
        }
    }

    private function maxId(){
        $req = "Select MAX(idP) as id from People;";

        $resultat = $this->getConnexion()->query($req);

        $laLigne = $resultat->fetch();

        return $laLigne["id"];
    }

    public function addAnonymePeople($pathCv){
        $id = $this->maxId()+1;

        $pathCv = isset($pathCv) ? $pathCv : null;

        $req = "Insert into People values (".$id.", 'anonyme', 'anonyme', 'anonyme@anonyme.com', '0000000000', '', '', 'France', '".md5(rand())."', '".$pathCv."')";

        $resultat = $this->getConnexion()->query($req);

        if($resultat){
            return $id;
        }
    }

    public function adminUpdatePeople(People $people){
        # Création de la requête SQL pour mettre à jour un enregistrement
        $req = "update People set "
        ."nom = '".$people->getName()."', prenom = '".$people->getFirstName()."', mel = '".$people->getEmail()."', tel = '".$people->getPhone()."', cityP = '".$people->getCity()."', cp = '".$people->getCp()."', cv = '".$people->getCv()."' "
        ."where idP = ".$people->getId().";";

        # Exécution de la requête
        $resultat = $this->getConnexion()->query($req);

        # Retourne le résultat de l'exécution (succès ou échec)
        return $resultat;
    }

    public function getIdAnonymes(){
        $req = "Select idP as id from People where nom = 'anonyme' and prenom = 'anonyme' and mel = 'anonyme@anonyme.com' and tel = '0000000000';";

        $resultat = $this->getConnexion()->query($req);

        $lesLignes = $resultat->fetchAll();

        $tabId = [];

        foreach ($lesLignes as $row) {
            $tabId[] = $row["id"];
        }

        return $tabId;
    }
}
