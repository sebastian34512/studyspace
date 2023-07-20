<?php
session_start();
require_once("config.inc.php");

if(!isset($_SESSION['eingeloggt']) || $_SESSION['eingeloggt'] != true) {
    header("Location: index.php?error=1");
}

$data = new Data();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Arbeitszeiten</title>


</head>
<body id="indexbody">
<div class="container">
<h1>Übersicht deiner Arbeitszeiten</h1>

    <?php
    $data->getUerberstunden($_SESSION['userID']);
    $data->getAllArbeitszeiten($_SESSION['userID']);
    ?>

    <div class="buttondiv">
    <form id="dashboard" action="dashboard.php" method="POST">
        <input class="button" type="submit" name="dashboard" value="zurück zum Dashboard">
    </form>
    </div>



</div>
</body>
</html>
