<?php
session_start();
require_once ('config.inc.php');

$auth = new Auth();

$auth->getUserCode($_POST['email']);


if(isset($_POST['registrieren'])) {
    if($_POST['email'] != "" || $_POST['passwort'] != "") {
        if($auth->alreadyRegistered($_POST['email'])){
            header("Location: index.php?register=2");
        } else {

            $auth->newAdress($_POST['postleitzahl'], $_POST['land'], $_POST['ort'], $_POST['strasse'], $_POST['hausnummer'], $_POST['stiege'], $_POST['tuer']);
            $auth->newPerson($_POST['vorname'], $_POST['nachname'], $_POST['geburtsdatum'], $_POST['geschlecht'], $_POST['telefonnummer']);
            $auth->newUser($_POST['passwort'], $_POST['email']);
            $auth->newUserCode($auth->createCode());




            $darfrein = $auth->login($_POST['email'], $_POST['passwort']);

            if($darfrein) {
                $_SESSION['userID']=$auth->getUserID($_POST['email']);
                $_SESSION['userCode']=$auth->getUserCode($_SESSION['userID']);
                $_SESSION['userName']=$auth->getUserName($_SESSION['userID']);
                $_SESSION['eingeloggt'] = true;
                header("Location: code.php");
                $_SESSION['eingeloggt_email'] = $_POST['email'];
                if($auth->userIsMitarbeiter($_POST['email'])) {
                    $_SESSION['ismitarbeiter'] = true;
                }
            } else {
                unset($_SESSION['userID']);
                unset( $_SESSION['eingeloggt']);
                unset( $_SESSION['ismitarbeiter']);
                unset( $_SESSION['eingeloggt_email']);
                unset( $_SESSION['userCode']);
                header("Location: index.php?error=1");
            }
        }
    } else {
        header("Location: index.php?register=0");
    }
}

if(isset($_POST['anmelden'])) {

    if($_POST['email'] != "" || $_POST['passwort'] != "") {

        $darfrein = $auth->login($_POST['email'], $_POST['passwort']);

        if($darfrein) {
            $_SESSION['userID']=$auth->getUserID($_POST['email']);
            $_SESSION['userCode']=$auth->getUserCode($_SESSION['userID']);
            $_SESSION['userName']=$auth->getUserName($_SESSION['userID']);
            $_SESSION['eingeloggt'] = true;

            $_SESSION['eingeloggt_email'] = $_POST['email'];
            if($auth->userIsMitarbeiter($_POST['email'])) {
                $_SESSION['ismitarbeiter'] = true;
            }
                header("Location: dashboard.php");

        } else {
            unset($_SESSION['userID']);
            unset( $_SESSION['eingeloggt']);
            unset( $_SESSION['ismitarbeiter']);
            unset( $_SESSION['eingeloggt_email']);
            unset( $_SESSION['userCode']);
            header("Location: index.php?error=1");
        }

    }
}


if(isset($_POST['abmelden'])) {
    unset( $_SESSION['eingeloggt']);
    unset( $_SESSION['eingeloggt_email']);
    unset( $_SESSION['userCode']);
    unset( $_SESSION['userName']);
    unset( $_SESSION['ismitarbeiter']);
    session_destroy();
    header("Location: index.php");
}


