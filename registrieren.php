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
    <title>Registrierung</title>


</head>
<body id="indexbody">
<div class="container">
<h1>Neuer Benutzer</h1>

    <p class="hinweis">Bitte keine Umlaute!</p>

<form id="registrieren" action="action.php" method="POST">
    <table id="register">
        <tr>
            <td class="registertd">Vorname:</td>
            <td><input type="text" name="vorname" required></td>
        </tr>
        <tr>
            <td class="registertd">Nachname:</td>
            <td><input type="text" name="nachname" required> </td>
        </tr>
        <tr>
            <td class="registertd">Geburtstag:</td>
            <td><input type="date" name="geburtsdatum" placeholder="YYYY-MM-DD" required></td>
        </tr>
        <tr>
            <td class="registertd">Geschlecht:</td>
            <td><select name="geschlecht">
                    <option value="m">Männlich</option>
                    <option value="w">Weiblich</option>
                    <option value="">Keine Angabe</option>
                </select></td>
        </tr>
        <tr>
            <td class="registertd">E-Mail:</td>
            <td><input type="text" name="email" required></td>
        </tr>
        <tr>
            <td class="registertd">Telefonnummer:</td>
            <td><input type="text" name="telefonnummer" placeholder="keine Sonderzeichen" </td>
        </tr>
        <tr>
            <td class="registertd">Land:</td>
            <td><input type="text" name="land" required></td>
        </tr>
        <tr>
            <td class="registertd">Postleitzahl:</td>
            <td><input type="text" name="postleitzahl" required></td>
        </tr>
        <tr>
            <td class="registertd">Ort:</td>
            <td><input type="text" name="ort" required></td>
        </tr>
        <tr>
            <td class="registertd">Straße:</td>
            <td><input type="text" name="strasse" required></td>
        </tr>
        <tr>
            <td class="registertd">Hausnummer:</td>
            <td><input type="text" name="hausnummer" required></td>
        </tr>
        <tr>
            <td class="registertd">Stiege:</td>
            <td><input type="text" name="stiege"></td>
        </tr>
        <tr>
            <td class="registertd">Tür:</td>
            <td><input type="text" name="tuer"></td>
        </tr>
        <tr>
            <td class="registertd">Passwort:</td>
            <td><input type="text" name="passwort" required></td>
        </tr>


    </table>
    <input type="submit" name ="registrieren" value="Registrieren">
</form>

<?php
if(isset($_GET['register']) && $_GET['register'] == 0) {
    echo "Formular nicht richtig ausgefüllt";
}

if(isset($_GET['register']) && $_GET['register'] == 2) {
    echo "Dieser User existiert bereits";
}
?>
</div>
</body>
</html>
