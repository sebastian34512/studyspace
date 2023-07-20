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
    <title>Mitarbeiter Dashboard</title>


</head>
<body id="indexbody">
<div class="container">
<h1>Willkommen
    <?php
    $adressen = new Adressen();
    echo $adressen->getUserName($_SESSION['userID']);
    ?>
! </h1>

    <form id="abmelden" action="action.php" method="POST">
        <input type="submit" name="abmelden" value="Abmelden">
    </form>


</div>
</body>
</html>
