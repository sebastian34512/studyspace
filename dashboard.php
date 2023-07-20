<?php
session_start();
require_once("config.inc.php");

if(!isset($_SESSION['eingeloggt']) || $_SESSION['eingeloggt'] != true) {
    header("Location: index.php?error=1");
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>


</head>
<body id="indexbody">
<div class="container">
<h1>Willkommen
    <?php
    $auth = new Auth();
    echo $auth->getUserName($_SESSION['userID']);
    ?>
! </h1>
    <div class="buttondiv">
    <form id="abmelden" action="action.php" method="POST">
        <input type="submit" name="abmelden" value="Abmelden">
    </form>

    <form id="code" action="profil.php" method="POST">
        <input type="submit" name="profilBearbeiten" value="Profil bearbeiten">
    </form>

    <form id="code" action="besuche.php" method="POST">
        <input type="submit" name="besuche" value="Konsumationen und Besuche">
    </form>

    <form id='meldungen' action='nachrichten.php' method='POST'>
        <input type='submit' name='meldungen' value='Meldungen'>
    </form>

    <?php
    if($_SESSION['ismitarbeiter']) {
        echo "

    <form id='zeiten' action='arbeitszeiten.php' method='POST'>
        <input type='submit' name='zeiten' value='Arbeitszeiten'>
    </form>";
    }
    ?>
    </div>
</div>
</body>
</html>
