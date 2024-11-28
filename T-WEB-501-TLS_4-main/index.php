<?php

session_start();

require_once("Modeles/BdPdo.php");

if ( !isset( $_SESSION["User"]["number"] ) ) {

    # mettre le menu ici lorsque l'on est pas connecté

    
        include("Vues/menu.html");
    
    
    # initialisation du contrôleur si pas indiqué

    if ( !isset( $_GET["controleur"] ) ) {

        # initialisation du controleur sur la première page visible en entrant dans le site

        $controleur = "advertisement";

    }
    else {

        #initialisation du contrôleur à la valeur mis dans l'URL

        $controleur = $_GET["controleur"];

    }

    switch ( $controleur ) {
        case "advertisement":
            # mettre la page dans lequel il y a le contenu de la page "home"
            
            include("Controleurs/advertisement.php");
            
            break;
        case "user":

            # mise en place d'un test pour l'affichage à supprimer par la suite

            include("Controleurs/user.php");
            
            break;
    }
}elseif ( $_SESSION["User"]["number"] > 0) {
    # mettre le menu ici lorsque l'on est connecté

    include("Vues/menu.php");

    # initialisation du contrôleur si pas indiqué

    if ( !isset( $_GET["controleur"] ) ) {

        # initialisation du controleur sur la première page visible en entrant dans le site

        $controleur = "advertisement";

    }
    else {

        #initialisation du contrôleur à la valeur mis dans l'URL

        $controleur = $_GET["controleur"];

    }

    switch ( $controleur ) {
        case "advertisement":
            # mettre la page dans lequel il y a le contenu de la page "home"
            
            include("Controleurs/advertisement.php");
            
            break;
        case "user":

            # mise en place d'un test pour l'affichage à supprimer par la suite

            include("Controleurs/user.php");
            
            break;
    }

}else{
    # mettre le menu ici lorsque l'on est un admin

    include("Vues/menu.php");

    include("./Controleurs/admin.php");
}