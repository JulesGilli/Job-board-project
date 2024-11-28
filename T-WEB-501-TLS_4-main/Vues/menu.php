<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scripts/style.css">
    <link rel="icon" href="Images/Logo Ju 50-50.png">

    <title>TalentGate</title>
</head>
<body>
    <?php if($_SESSION['User']['number'] != 0){ ?>
        <header class="menu">
            <div class="logo-title">
                <a href="index.php">
                <img class="image-logo" src="Images/Logo-w-title.png"></img>
                </a>
            </div>
            <div class="sub-menu">
                <div class="dropdown">
                    <a href="#" class="dropbtn"><b><?php echo $_SESSION['User']['name']; ?></b></a>
                    <div class="dropdown-content">
                    <a href="index.php?controleur=user&action=profil"><?php echo "Profile"; ?></a>
                    <a href="index.php?controleur=user&action=disconnect">Disconnect</a>
                    </div>
                </div>
            </div>
        </header>

    <?php } else { 
        if(isset($_GET['action'])){
            if($_GET['action'] != "tabUsers"){ ?>

        <header class="menu">
            <div class="logo-title">
                <a href="index.php">
                <img class="image-logo" src="Images/Logo-w-title.png"></img>
                </a>
            </div>
            <div class="sub-menu">
                <div class="dropdown">
                    <a href="#" class="dropbtn"><b><?php echo $_SESSION['User']['name']; ?></b></a>
                    <div class="dropdown-content">
                        <a href="index.php?action=tabUsers"><?php echo "Gestion des users"; ?></a>
                        <a href="index.php?action=disconnect">Disconnect</a>
                    </div>
                </div>
            </div>
        </header>
    <?php }else{ ?>
        <header class="menu">
            <div class="logo-title">
                <a href="index.php">
                <img class="image-logo" src="Images/Logo-w-title.png"></img>
                </a>
            </div>
            <div class="sub-menu">
                <div class="dropdown">
                    <a href="#" class="dropbtn"><b><?php echo $_SESSION['User']['name']; ?></b></a>
                    <div class="dropdown-content">
                        <a href="index.php"><?php echo "Gestion des advertisements"; ?></a>
                        <a href="index.php?action=disconnect">Disconnect</a>
                    </div>
                </div>
            </div>
        </header>

    <?php }}else{ ?>
        <header class="menu">
            <div class="logo-title">
                <a href="index.php">
                <img class="image-logo" src="Images/Logo-w-title.png"></img>
                </a>
            </div>
            <div class="sub-menu">
                <div class="dropdown">
                    <a href="#" class="dropbtn"><b><?php echo $_SESSION['User']['name']; ?></b></a>
                    <div class="dropdown-content">
                        <a href="index.php?action=tabUsers"><?php echo "Gestion des users"; ?></a>
                        <a href="index.php?action=disconnect">Disconnect</a>
                    </div>
                </div>
            </div>
        </header>
    <?php }} ?>
    
