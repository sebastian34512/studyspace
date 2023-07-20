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
    <title>Profil</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            refreshList();

        });
        function refreshList(){

            var request= $.ajax({
                url: "ajax.php",
                dataType: "html"
            });
            request.done(function(answer){
                $("#profilliste").html(answer);


                $("#profilaendern").submit(function (event){
                    event.preventDefault();
                    var request2 = $.ajax({
                        url: "ajax.php",
                        method: "POST",
                        data: {
                            change: $(this).find("select[name=feldbearbeiten]").val(),
                            to: $(this).find("input[name=neu]").val()
                        }
                    });
                    request2.done(function (){
                        refreshList();
                    });
                });


            });
        }
    </script>

</head>
<body id="indexbody">

<div class="container">
    <h1>Profil</h1>
    <form id="dashboard" action="dashboard.php" method="POST">
        <input type="submit" name="dashboard" value="zurück zum Dashboard">
    </form>

<div id="profilliste">
</div>
    <h2>Feld bearbeiten</h2>
    <form id="profilaendern" action="action.php" method="POST">
        Wähle aus, welches Feld du bearbeiten möchtest: <select name="feldbearbeiten">
            <option value="Vorname">Vorname</option>
            <option value="Nachname">Nachname</option>
            <option value="Geschlecht">Geschlecht</option>
            <option value="Telefonnummer">Telefonnummer</option>
            <option value="email">E-Mai</option>
            <option value="Land">Land</option>
            <option value="Postleitzahl">Postleitzahl</option>
            <option value="Ort">Ort</option>
            <option value="Strasse">Straße</option>
            <option value="Hausnummer">Hausnummer</option>
            <option value="Stiege">Stiege</option>
            <option value="Tuer">Tür</option>
            <option value="Passwort">Passwort</option>

        </select>* <br>
        Ändern auf:<input type="text" name="neu"><br>
        <input type="submit" name="aendern" value="Ändern">
        <p class="hinweis">* Wenn du deine Email ändern willst, musst du dich dannach neu einloggen.</p>
    </form>
</div>
</body>
</html>
