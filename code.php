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
    <title>Zugangscode</title>


</head>
<body id="indexbody">
<div class="container">
<h1>Registrierung abgeschlossen!</h1>

<h2>Hier ist dein persönlicher Zugangscode:</h2>
<?php
echo $_SESSION['userCode'];
?>

    <form id="code" action="dashboard.php" method="POST">
        <input type="submit" name="dashboardKunde" value="zum Dashboard">
    </form>


</div>
</body>
</html>
