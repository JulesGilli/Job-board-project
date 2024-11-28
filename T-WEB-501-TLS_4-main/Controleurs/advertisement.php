<?php 

include("./Modeles/Technique/Bd_Advertisements.php");
include("./Modeles/Technique/Bd_Companies.php");
include("./Modeles/Technique/Bd_Cible.php");
include("./Modeles/Technique/Bd_People.php");

if ( !isset( $_GET["action"] ) ){
    $action = "home";
}else{
    $action = $_GET["action"];
}

switch ( $action ) {
    case "home":
        include("./Vues/home.html");
        break;
    case "search":
        $title = isset($_POST["jobTitle"]) ? $_POST["jobTitle"] : "";
        $location = isset($_POST["location"]) ? $_POST["location"] : "";
        $bdAdertisements = new Bd_Advertisements();
        
        $tabAdvertisements = $bdAdertisements->searchAdvertisement($title, $location);

        $bdCompanies = new Bd_Companies();

        $tabCompanies = $bdCompanies->getCompanies();

        include("./Vues/search.php");
        break;
    case "formApply":
        $idA = $_POST['id'];

        if (isset($_SESSION["User"]["number"])){
            $bdPoeple = new Bd_People();
            $people = $bdPoeple->getUnPeople($_SESSION["User"]["number"]);  
        } else {
            $people = null;
        }
        include("./Vues/formApply.php");
        break;
    case "apply":
        $idA = $_POST["id"];
        $bdPoeple = new Bd_People();
        if (isset($_SESSION["User"]["number"])){
            $idP = $_SESSION["User"]["number"];
            $mess = $_POST["message"];
            if(!empty( $_FILES['cvUpload']['name'] )){
                $people = $bdPoeple->getUnPeople($idP);
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
            }
        } else {
            $firstName = $_POST["firstName"];
            $name = $_POST["name"];
            $mel = $_POST["email"];
            $tel = $_POST["phone"];
            $mess = $name."\n".$mel."\n".$tel."\n".$_POST["message"];
            if(!empty( $_FILES['cvUpload']['name'] )){
                $cv = file_get_contents($_FILES['cvUpload']['tmp_name']);
                $data = base64_encode($cv);
                $name = md5(uniqid(rand(), true));
                $extension = explode('.', $_FILES['cvUpload']['name'])[1];
                $nameCv = "CV/".$name.".".$extension;
                $idP = $bdPoeple->addAnonymePeople($nameCv);
                $cvBase64 = base64_decode($data);
                file_put_contents($nameCv, $cvBase64);
            }
            $idP = $bdPoeple->addAnonymePeople(null);
            $_SESSION['User']['anonyme'] = $idP;
        }

        $bdCible = new Bd_Cible();

        $cible = new Cible($idA,$idP,$mess);

        try {
            $bdCible->insertCible($cible);
            $message = "You have applied to this job offer";
            $location = "index.php?controleur=advertisement&action=search";
            include("./Vues/validateMessage.php");
        } catch (Exception $e) {
            $message = "An error has occurred. You could not apply to this offer.";
            $location = "index.php?controleur=advertisement&action=search";
            include("./Vues/errorMessage.php");
        }
        break;
    case "searchWithTag":
        $title = isset($_POST["jobTitle"]) ? $_POST["jobTitle"] : null;
        $bdAdertisements = new Bd_Advertisements();
        $jobType = isset($_POST['jobType']) ? $_POST['jobType'] : null;
        $tailleCompany = isset($_POST['tailleCompany']) ? $_POST['tailleCompany'] : null;
        $contrat = isset($_POST['contrat']) ? $_POST['contrat'] : null;
        $sector = isset($_POST['sector']) ? $_POST['sector'] : null;
        if(isset($_POST["location"])){
            $location = $_POST["location"];
            $tabAdvertisements = $bdAdertisements->searchAdvertisementTag($title, $jobType, $tailleCompany, $contrat, $sector, $location);
        }else{
            $tabAdvertisements = $bdAdertisements->searchAdvertisementTag($title, $jobType, $tailleCompany, $contrat, $sector);
        }

        $bdCompanies = new Bd_Companies();

        $tabCompanies = $bdCompanies->getCompanies();

        include("Vues/search.php");

        break;
}