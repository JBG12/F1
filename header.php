<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="f1.css">
    <link rel="icon" type="images/x-icon" href="images/F1_logo2.svg">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js.js"></script> 
    <title>Formule 1</title>
</head>
<div class="headerBox">
    <div class="header">
        <a class="test" href="F1.php">
        <img class="headerImg" src="images/F1_logo2.svg">
        <p> De Website voor Formule 1 Statestieken</p>
        </a>
        <?php 
        echo '<div class="nav">';
            if (!empty($_SESSION['UID'])) {
                
                echo '<a href="voorspellingen.php" class="navItem">Voorspellingen</a>';
            }
            echo '<a href="drivers.php" class="navItem">Racers</a>';
        echo '</div>';
        ?>
        <div class="login">
        <?php if (empty($_SESSION['UID'])) { ?>
        <form action="F1.php" method="POST">
            <input type="text" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Wachtwoord" required>
            <button class="buttonForm" type="submit" name="login">Inloggen</button>
        </form>
        <?php } else { ?>
            <form action="F1.php" method="POST">
            <button class="buttonLogout" type="submit" name="uitlog">Uitloggen</button>
            </form>
        <?php } ?>
        </div>
    </div>
</div>

<?php
error_reporting(0);
?>