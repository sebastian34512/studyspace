<?php
session_start();
require_once("config.inc.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Studyspace</title>


</head>
<body id="indexbody">
<div class="container">
<h1>Willkommen bei Studyspace</h1>

<h2>Neuer Benutzer?</h2>
<form id="registrieren" action="registrieren.php" method="POST">
   <input type="submit" name ="registrieren" value="Registrieren">
</form>

<?php
if(isset($_GET['register']) && $_GET['register'] == 0) {
    echo "Füll das Formular gscheid aus du Wappler!";
}

if(isset($_GET['register']) && $_GET['register'] == 2) {
    echo "Dieser User existiert bereits";
}
?>

<h2>Schon Mitglied? Melde dich hier an:</h2>
<form id="anmelden" action="action.php" method="POST">
    E-Mail:   <input type="text" name="email"> <br>
    Passwort: <input type="text" name="passwort"> <br>
    <input type="submit" name= "anmelden" value="Anmelden">
</form>

<?php
if(isset($_GET['anmelden']) && $_GET['anmelden'] == 0) {
    echo "Anmelden hat nicht funktioniert.";
}

if(isset($_GET['error']) && $_GET['error']==1) {
    echo "Ich kenne dich nicht";
}
?>






</div>
</body>
</html>
