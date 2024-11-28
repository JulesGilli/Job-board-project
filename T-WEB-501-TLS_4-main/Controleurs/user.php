<?php 

include("./Modeles/Technique/Bd_People.php");

if ( !isset( $_GET["action"] ) ){
    $action = "formConnection";
}else{
    $action = $_GET["action"];
}

switch ( $action ) {
    case "formConnection":
        include("./Vues/formConnect.html");
        break;
    case "connection":
        $mel = $_POST['email'];
        $mdp = $_POST['password'];

        $bdPoeple = new Bd_People();

        try {
            if($bdPoeple->isAllowConnect($mel, $mdp)){
                if ($bdPoeple->getPeopleConnected($mel, $mdp)->getId() != 4){
                    $_SESSION['User']['number'] = $bdPoeple->getPeopleConnected($mel, $mdp)->getId();
                    $_SESSION['User']['name'] = $bdPoeple->getUnPeople($_SESSION['User']['number'])->getFirstName()." ".$bdPoeple->getUnPeople($_SESSION['User']['number'])->getName();
                    $logUser = fopen('Log/Users/Log-Users.txt', 'a');
            fwrite($logUser,'
---- CONNECTION of USER ----
');
            $date = new DateTime();
            fwrite($logUser, $date->format('d-m-Y H-i-s').' '.$_SESSION['User']['name'].' is logged in.
');
            fwrite($logUser,'---- END OF ACTION ----
');
            fclose($logUser);
                }else{
                    $_SESSION['User']['number'] = 0;
                    $_SESSION['User']['name'] = $bdPoeple->getPeopleConnected($mel, $mdp)->getName();
                    $logAdmin = fopen('Log/Admin/Log-Admin.txt', 'a');
            fwrite($logAdmin,'
---- CONNECTION of ADMIN ----
');
            $date = new DateTime();
            fwrite($logAdmin, $date->format('d-m-Y H-i-s').' An admin is logged in.
');
            fwrite($logAdmin,'---- END OF ACTION ----
');
                }
                header('Location: index.php');
            }else{
                $message = "Please log in.";
                $location = "index.php?controleur=user&action=formConnection";
                include('Vues/errorMessage.php');
            }
        } catch (Exception $e) {
            $message = "Please log in.";
            $location = "index.php?controleur=user&action=formConnection";
            include('Vues/errorMessage.php');
        }
        break;
    case 'formRegister':
        include('./Vues/formRegister.html');
        break;
    case 'register':
        $name = $_POST['name'];
        $firstName = $_POST['firstName'];
        $mel = $_POST['email'];
        $tel = $_POST['phone'];
        $city = $_POST['city'];
        $cp = $_POST['cp'];
        $mdp = $_POST['password'];

        $bdPoeple = new Bd_People();

        $people = new People($firstName,$name,$mel,$tel,$city,$cp,$country,$mdp);

        if($bdPoeple->insertPeople($people)){
            $_SESSION['User']['number'] = $bdPoeple->getPeopleConnected($mel, $mdp)->getId();
            $_SESSION['User']['name'] = $bdPoeple->getUnPeople($_SESSION['User']['number'])->getFirstName()." ".$bdPoeple->getUnPeople($_SESSION['User']['number'])->getName();
            $logUser = fopen('Log/Users/Log-Users.txt', 'a');
            fwrite($logUser,'
---- ADD on PEOPLE ----
');
            $date = new DateTime();
            fwrite($logUser, $date->format('d-m-Y H-i-s').' '.$_SESSION['User']['name'].' has added himself.
');
            fwrite($logUser,"Insert into People (nom, prenom, mel, tel, cityP, cp, pays, mdp, cv) values " 
        ."('".$people->getName()."','".$people->getFirstName()."','".$people->getEmail()."','".$people->getPhone()."','".$people->getCity()."','".$people->getCp()."','France','".md5($people->getPassword())."','".$people->getCv()."');
");
            fwrite($logUser,'---- END OF ACTION ----
');
            fclose($logUser);
            header('Location: index.php');
        }else{
            $message = "An error occurred during registration.";
            $location = "index.php?controleur=user&action=formRegister";
            include("./Vues/errorMessage.php");
        }
        break;
    case "profil":
        $bdPoeple = new Bd_People();

        $people = $bdPoeple->getUnPeople($_SESSION["User"]["number"]);

        include("./Vues/profil.php");

        break;
    case "updateProfile":
            $bdPoeple = new Bd_People();
            $name = $_POST['name'];
            $firstName = $_POST['firstName'];
            $mel = $_POST['email'];
            $tel = $_POST['phone'];
            $city = $_POST['city'];
            $cp = $_POST['cp'];
            if(!empty( $_FILES['cvUpload']['name'] )){
                $people = $bdPoeple->getUnPeople($_SESSION['User']['number']);
                $cv = file_get_contents($_FILES['cvUpload']['tmp_name']);
                $data = base64_encode($cv);
                $name = md5(uniqid(rand(), true));
                $extension = explode('.', $_FILES['cvUpload']['name'])[1];
                $nameCv = "CV/".$name.".".$extension;
                if( $people->getCv() != null && $people->getCv() != ''){
                    unlink($people->getCv());
                }
                $people->setCv($nameCv);
                $bdPoeple->updatePeople($people);
                $cvBase64 = base64_decode($data);
                file_put_contents($nameCv, $cvBase64);
            }else{
                $people = new People($firstName,$name,$mel,$tel,$city,$cp,null,null,$_SESSION['User']['number']);
            }

        if($bdPoeple->updatePeople($people)){
            $logUser = fopen('Log/Users/Log-Users.txt', 'a');
            fwrite($logUser,'
---- UPDATE on PEOPLE ----
');
            $date = new DateTime();
            fwrite($logUser, $date->format('d-m-Y H-i-s').' '.$_SESSION['User']['name'].' has updated himself.
');
            fwrite($logUser,"update People set "
        ."nom = '".$people->getName()."', prenom = '".$people->getFirstName()."', mel = '".$people->getEmail()."', tel = '".$people->getPhone()."', cityP = '".$people->getCity()."', cp = '".$people->getCp()."', cv = '".$people->getCv()."' "
        ."where idP = ".$people->getId().";
");
            fwrite($logUser,'---- END OF ACTION ----
');
            fclose($logUser);
            $_SESSION['User']['name'] = $people->getFirstName().' '.$people->getName();
            $message = "Your profile has been modified.";
            $location = "index.php?controleur=user&action=profil";
            include("./Vues/validateMessage.php");
        }else{
            $message = "An error has occurred while editing your profile.";
            $location = "index.php?controleur=user&action=profil";
            include("./Vues/errorMessage.php");
        }

        break;
        case "disconnect":
            $_SESSION['User']['number'] = null;
            $_SESSION['User']['name'] = null;
            header('Location: index.php');
}