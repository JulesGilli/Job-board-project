<?php

include("./Modeles/Technique/Bd_Companies.php");
include("./Modeles/Technique/Bd_Advertisements.php");
include("./Modeles/Technique/Bd_People.php");
include("./Modeles/Technique/Bd_Cible.php");


if ( !isset( $_GET["action"] ) ){
    $action = "tabAdvertisements";
}else{
    $action = $_GET["action"];
}

switch($action){
    case "tabAdvertisements":
        $bdAdertisements = new Bd_Advertisements();
        $bdCompanies = new Bd_Companies();
        $tabAdvertisements = $bdAdertisements->getAdvertisements();

        include("Vues/adminAdvertisements.php");
        break;
    case "detailAdvertisement" :
        $id = $_POST['id'];

        $bdAdertisements = new Bd_Advertisements();
        $bdCompanies = new Bd_Companies();
        $advertisement = $bdAdertisements->getAdvertisement($id);

        include("Vues/adminDetailAd.php");
        break;
    case "deleteAdvertisement":
        $id = $_POST['id'];

        $bdAdertisements = new Bd_Advertisements();
        $advertisement = $bdAdertisements->getAdvertisement($id);

        if($bdAdertisements->deleteAdvertisement($id)){
            $logAdmin = fopen('Log/Admin/Log-Admin.txt', 'a');
            fwrite($logAdmin,'
---- DELETE on ADVERTISEMENT ----
');
            $date = new DateTime();
            fwrite($logAdmin, $date->format('d-m-Y H-i-s').' An admin has deleted an advertisement.
');
            fwrite($logAdmin,'Delete from Advertisement where idA = '.$id.';
');
            fwrite($logAdmin,'---- END OF ACTION ----
');
            fclose($logAdmin);
            $message = "The offer has been deleted.";
            $location = "index.php?controleur=admin&action=tabAdvertisements";
            include("Vues/validateMessage.php");
        }else{
            $message = "An error occurred during deletion.";
            $location = "index.php?controleur=admin&action=tabAdvertisements";
            include("./Vues/errorMessage.php");
        }

        break;
        case "tabUsers":
            $bdPoeple = new Bd_People();

            $tabUsers = $bdPoeple->getPeoples();

            $tabId = $bdPoeple->getIdAnonymes();

            include("Vues/adminUsers.php");
            break;
        case "detailP":
            $id = $_POST["id"];

            $bdPoeple = new Bd_People();

            $people = $bdPoeple->getUnPeople($id);

            include("Vues/adminDetailP.php");
            break;
        case "updateUser":
            $id = $_POST["id"];
            $name = $_POST['name'];
            $firstName = $_POST['firstName'];
            $mel = $_POST['email'];
            $tel = $_POST['phone'];
            $city = $_POST['city'];
            $cp = $_POST['cp'];
            $people = new People($firstName,$name,$mel,$tel,$city,$cp,null,null,$id);
            $bdPoeple = new Bd_People();
            if($bdPoeple->adminUpdatePeople($people)){
                $logAdmin = fopen('Log/Admin/Log-Admin.txt', 'a');
            fwrite($logAdmin,'
---- UPDATE on PEOPLE ----
');
            $date = new DateTime();
            fwrite($logAdmin, $date->format('d-m-Y H-i-s').' An admin has updated a user.
');
            fwrite($logAdmin,"update People set "
        ."nom = '".$people->getName()."', prenom = '".$people->getFirstName()."', mel = '".$people->getEmail()."', tel = '".$people->getPhone()."', cityP = '".$people->getCity()."', cp = '".$people->getCp()."', cv = '".$people->getCv()."' "
        ."where idP = ".$people->getId().";
");
            fwrite($logAdmin,'---- END OF ACTION ----
');
            fclose($logAdmin);
                $message = 'The change has been made.';
                $location = "index.php?controleur=admin&action=tabUsers";
                include('./Vues/validateMessage.php');
            }else{
                $message = 'An error occurred while editing.';
                $location = "index.php?controleur=admin&action=tabUsers";
                include('./Vues/errorMessage.php');
            }
            break;
        case 'deleteUser':
            $id = $_POST['id'];
            $bdPoeple = new Bd_People();
            $bdCible = new Bd_Cible();
            $people = $bdPoeple->getUnPeople($id);
            if(!empty($bdCible->getCible($id))){
                $bdCible->deleteCible($id);
            }
            if($bdPoeple->deletePeople($id)){
                $logAdmin = fopen('Log/Admin/Log-Admin.txt', 'a');
                fwrite($logAdmin,'
---- DELETE on PEOPLE ----
');
                $date = new DateTime();
                fwrite($logAdmin, $date->format('d-m-Y H-i-s').' An admin has deleted a user.
');
                fwrite($logAdmin,'Delete from People where idP = '.$id.';
');
                fwrite($logAdmin,'---- END OF ACTION ----
');
                $message = 'The user has been deleted.';
                $location = "index.php?controleur=admin&action=tabUsers";
                $cv = $people->getCv();
                !empty($cv) ? unlink($cv) : null;
                include('./Vues/validateMessage.php');
            }else{
                $message = 'An error occurred while deleting.';
                $location = "index.php?controleur=admin&action=tabUsers";
                include('./Vues/errorMessage.php');
            }
            break;
        case "formAddUser":
            include("Vues/formAdminAddUser.html");
            break;
        case "addUser":
            $name = $_POST['name'];
            $firstName = $_POST['firstName'];
            $mel = $_POST['email'];
            $tel = $_POST['phone'];
            $city = $_POST['city'];
            $cp = $_POST['cp'];
            $mdp = $_POST['password'];

            $bdPoeple = new Bd_People();

            $people = new People($firstName,$name,$mel,$tel,$city,$cp,null,$mdp);

            if($bdPoeple->insertPeople($people)){
                $logAdmin = fopen('Log/Admin/Log-Admin.txt', 'a');
            fwrite($logAdmin,'
---- ADD on PEOPLE ----
');
            $date = new DateTime();
            fwrite($logAdmin, $date->format('d-m-Y H-i-s').' An admin has add a user.
');
            fwrite($logAdmin,"Insert into People (nom, prenom, mel, tel, cityP, cp, pays, mdp, cv) values " 
        ."('".$people->getName()."','".$people->getFirstName()."','".$people->getEmail()."','".$people->getPhone()."','".$people->getCity()."','".$people->getCp()."','France','".md5($people->getPassword())."','".$people->getCv()."')
");
            fwrite($logAdmin,'---- END OF ACTION ----
');
                $message = 'The user has been created.';
                $location = "index.php?controleur=admin&action=tabUsers";
                include('./Vues/validateMessage.php');
            }else{
                $message = "An error occurred while creating the user.";
                $location = "index.php?controleur=admin&action=tabUsers";
                include("./Vues/errorMessage.php");
            }
            break;
        case "disconnect":
            $_SESSION['User']['number'] = null;
            $_SESSION['User']['name'] = null;
            header('Location: index.php');
            break;

}