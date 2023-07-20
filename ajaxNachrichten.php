<?php
session_start();
require_once ("config.inc.php");

$data = new Data();

if(isset($_POST['text'])) {
    $data->insertNachricht($_SESSION['userID'], $_POST['text']);

}

if($_SESSION['ismitarbeiter']) {
$data->getAllNachrichten();
}

 ?>





