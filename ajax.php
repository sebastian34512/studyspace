<?php
session_start();
require_once ("config.inc.php");

$data = new Data();
echo $_POST['change'];
if(isset($_POST['to'])) {
    $data->edit($_SESSION['userID'], $_POST['change'], $_POST['to']);

}

$data->getProfileData($_SESSION['eingeloggt_email']);


 ?>





