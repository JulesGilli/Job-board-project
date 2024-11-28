<?php

# Inclusion de la classe métier Cible
include("Modeles/Metier/Cible.php");

# Déclaration de la classe Bd_Cible qui hérite de BdPdo
class Bd_Cible extends BdPdo {

    # Méthode pour insérer une nouvelle cible dans la base de données
    public function insertCible(Cible $cible) {
        # Création de la requête SQL pour insérer une nouvelle cible
        $req = "insert into Cible values "
        ."(".$cible->getIdA().",".$cible->getIdP().",'".$cible->getMes()."');";

        # Exécution de la requête
        $resultat = $this->getConnexion()->query($req);

        # Retourne le résultat de l'exécution (succès ou échec)
        return $resultat;
    }

    public function deleteCible($idP) {
        $req = "Delete from Cible where idP = ".$idP.";";

        $resultat = $this->getConnexion()->query($req);

        return $resultat;
    }

    public function getCible($idP) {
        $req = "Select * from Cible where idP = ".$idP.";";

        $resultat = $this->getConnexion()->query($req);

        $lesLignes = $resultat->fetchAll();

        $tabValeurs = [];

        foreach($lesLignes as $row) {
            $cible = new Cible($row['idA'], $row['idP'], $row['mess']);
            $tabValeurs[] = $cible;
        }

        return $tabValeurs;
    }

}
