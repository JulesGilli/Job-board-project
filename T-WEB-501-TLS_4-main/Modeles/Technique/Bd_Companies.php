<?php

# Inclusion de la classe métier Companies
include("Modeles/Metier/Companies.php");

# Déclaration de la classe Bd_Companies qui hérite de BdPdo
class Bd_Companies extends BdPdo {

    # Méthode pour récupérer une compagnie spécifique par ID
    public function getCompany($id) {
        # Création de la requête SQL pour sélectionner une compagnie par son ID
        $req = "Select * from Companies where idC = ".$id.";";

        # Exécution de la requête
        $resultat = $this->getConnexion()->query($req);

        # Récupération de la première ligne du résultat
        $laLigne = $resultat->fetch();

        # Création d'un objet Companies avec les données récupérées
        return $company = new Companies($laLigne['idC'], $laLigne['nomE'], $laLigne['secteur'], 
        $laLigne['headOffice'], $laLigne['taille'], $laLigne['cityC']);
    }

    public function getCompanies(){
        $requet = "Select * from Companies;";
        $resultat = $this->getConnexion()->query($requet);
        $lesLignes = $resultat->fetchAll();


        $tabCompany = [];
        foreach($lesLignes as $row){
            $company = new Companies($row["idC"], $row["nomE"], $row["secteur"], $row["headOffice"], $row["taille"], $row["cityC"]);
            $tabCompany[] = $company;
        }
        return $tabCompany;
    }

}


