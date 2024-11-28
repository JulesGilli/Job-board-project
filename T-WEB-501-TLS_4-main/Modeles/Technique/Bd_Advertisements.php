<?php

# Inclusion de la classe métier Advertisements
include("Modeles/Metier/Advertisements.php");

# Déclaration de la classe Bd_Advertisements qui hérite de BdPdo
class Bd_Advertisements extends BdPdo {

    # Méthode pour récupérer toutes les annonces
    public function getAdvertisements() {
        # Création de la requête SQL pour sélectionner toutes les annonces
        $req = "Select * from Advertisement";

        # Exécution de la requête
        $resultat = $this->getConnexion()->query($req);

        # Récupération de toutes les lignes du résultat
        $lesLignes = $resultat->fetchAll();

        # Initialisation d'un tableau pour stocker les objets Advertisements
        $tabValeurs = [];

        # Boucle sur chaque ligne pour créer un objet Advertisements
        foreach ($lesLignes as $row) {
            # Création de l'objet Advertisements avec les données récupérées
            $advertisement = new Advertisements($row['idA'], $row['title'], $row['descr'], $row['salaire'],
            $row['typeA'], $row['dateA'], $row['workingH'], $row['idC']);
            # Ajout de l'objet au tableau
            $tabValeurs[] = $advertisement;
        }

        # Retourne le tableau contenant toutes les annonces sous forme d'objets Advertisements
        return $tabValeurs;
    }

    # Méthode pour récupérer une annonce spécifique par ID
    public function getAdvertisement($id) {
        # Création de la requête SQL pour sélectionner une annonce par ID
        $req = 'Select * from Advertisement where idA = '.$id.';';

        # Exécution de la requête
        $resultat = $this->getConnexion()->query($req);

        # Récupération de la première ligne du résultat
        $row = $resultat->fetch();

        # Création de l'objet Advertisements avec les données récupérées
        return $advertisement = new Advertisements($row['idA'], $row['title'], $row['descr'], $row['salaire'],
            $row['typeA'], $row['dateA'], $row['workingH'], $row['idC']);
    }

    # Méthode pour supprimer une annonce par ID
    public function deleteAdvertisement($id) {
        # Création de la requête SQL pour supprimer une annonce par ID
        $req = 'Delete from Advertisement where idA = '.$id.';';

        # Exécution de la requête
        $resultat = $this->getConnexion()->query($req);

        # Retourne le résultat de l'exécution (succès ou échec)
        return $resultat;
    }

    public function searchAdvertisement($title, $location = null) {
        if(!is_null($title)){
            $words = explode(" ", $title);

            $reqLike = "";

            for( $i = 0; $i < count($words); $i++ ) {
                if( $i == count($words) -1) {
                    $reqLike .= "title like '%".$words[ $i ]."%' ";
                }else{
                    $reqLike .= "title like '%".$words[ $i ]."%' and ";
                }
            }

            if($location != null){
                $req = "Select * from Advertisement join Companies on Advertisement.idC = Companies.idC where (".$reqLike.") and cityC = '".$location."';";
            }else{
                $req = "Select * from Advertisement join Companies on Advertisement.idC = Companies.idC where (".$reqLike.");";
            }

            $resultat = $this->getConnexion()->query($req);

            $lesLignes = $resultat->fetchAll();


            $tabValeurs = [];

            # Boucle sur chaque ligne pour créer un objet Advertisements
            foreach ($lesLignes as $row) {
                # Création de l'objet Advertisements avec les données récupérées
                $advertisement = new Advertisements($row['idA'], $row['title'], $row['descr'], $row['salaire'],
                $row['typeA'], $row['dateA'], $row['workingH'], $row['idC']);
                # Ajout de l'objet au tableau
                $tabValeurs[] = $advertisement;
            }

            return $tabValeurs;
        }
    }

    public function searchAdvertisementTag($title, $jobType, $tailleCompany, $contrat, $sector, $location = null) {
        if( $title != null) {
        
            $words = explode(" ", $title);

            $reqLike = "and (";

            for( $i = 0; $i < count($words); $i++ ) {
                if( $i == count($words) -1) {
                    $reqLike .= "title like '%".$words[ $i ]."%') ";
                }else{
                    $reqLike .= "title like '%".$words[ $i ]."%' and ";
                }
            }
        }else{
            $reqLike = "";
        }

        if($location != null){
            $req = "Select * from Advertisement join Companies on Advertisement.idC = Companies.idC where 1=1 ".$reqLike." and cityC = '".$location."'";
        }else{
            $req = "Select * from Advertisement join Companies on Advertisement.idC = Companies.idC where 1=1 ".$reqLike."";
        }

        if ($jobType) {
            $req .= " AND workingH = '".$jobType."'";
        }

        if ($tailleCompany) {
            if($tailleCompany == "TPE"){
                $req .= " AND taille between 0 and 19";
            }elseif($tailleCompany == "PME"){
                $req .= " AND taille between 20 and 249";
            }elseif($tailleCompany == "ETI"){
                $req .= " AND taille between 250 and 5000";
            }else{
                $req .= " AND taille > 5000";
            }
        }

        if ($contrat) {
            $req .= " AND typeA = '".$contrat."'";
        }

        if ($sector) {
            $req .= " AND secteur = '".$sector."'";
        }

        $req .= ";";

        $resultat = $this->getConnexion()->query($req);

        $lesLignes = $resultat->fetchAll();


        $tabValeurs = [];

        # Boucle sur chaque ligne pour créer un objet Advertisements
        foreach ($lesLignes as $row) {
            # Création de l'objet Advertisements avec les données récupérées
            $advertisement = new Advertisements($row['idA'], $row['title'], $row['descr'], $row['salaire'],
            $row['typeA'], $row['dateA'], $row['workingH'], $row['idC']);
            # Ajout de l'objet au tableau
            $tabValeurs[] = $advertisement;
        }

        return $tabValeurs;
    }
}
