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
    <title>Nachrichten</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            refreshList();

            $("#nachrichtanlegen").submit(function (event){
                event.preventDefault();
                var request = $.ajax({
                    url: "ajaxNachrichten.php",
                    method: "POST",
                    data: {
                        text: $("input[name=text]").val()
                    }
                });
                request.done(function (){
                    refreshList();
                });
            });
        });
        function refreshList(){

            var request= $.ajax({
                url: "ajaxNachrichten.php",
                dataType: "html"
            });
            request.done(function(answer){
                $(".datadiv").html(answer);

            });
        }
    </script>

</head>
<body id="indexbody">

<div class="container">
    <h1>Nachrichten</h1>
    <form id="dashboard" action="dashboard.php" method="POST">
        <input type="submit" name="dashboard" value="zurück zum Dashboard">
    </form>


<div id="anlegen">


    <h2>Neue Nachricht</h2>
    <form id="nachrichtanlegen" action="action.php" method="POST">
            Nachricht:<input type="text" name="text"><br>
            <input class="button" type="submit" name="senden" value="Absenden">
    </form>

</div>
    <?php
    if($_SESSION['ismitarbeiter']) {
        echo "<div class='datadiv'>";
    }
    ?>



</body>
</html>
