<?php
session_start();

class Auth
{
    private $db;

    function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PW);

        } catch (PDOException $e) {
            echo "Verbindung fehlgeschlagen";
            die();
        }
    }

    public function getAllUser() {
        $stmt = $this->db->prepare("
            SELECT BenutzerID, Passwort, PersonID, email
                FROM sp_Benutzer
                ");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        /*
        echo "<pre>";
        print_r($result);
        echo "</pre>";
        */

        return $result;
    }

    public function getAllMitarbeiter() {
        $stmt = $this->db->prepare("
            SELECT MitarbeiterID, Sozialversicherung, Funktion, Arbeitszeit
                FROM sp_Mitarbeiter
                ");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function alreadyRegistered($email) {
        foreach ($this->getAllUser() as $a) {
            if($email == $a['email']) {
                return true;
            }
        }
        return false;
    }

    public function userIsMitarbeiter($email) {
        foreach ($this->getAllUser() as $a) {
            foreach ($this->getAllMitarbeiter() as $b) {
                if($email == $a['email'] && $a['PersonID'] == $b['MitarbeiterID']) {
                    return true;
                }
            }
        }
        return false;
    }

    public function login($email, $password) {
        foreach ($this->getAllUser() as $a) {
            if($email == $a['email'] && password_verify($password, $a['Passwort'])) {
                //echo"engeloggt";
                return true;
            }
        }
        return false;
    }

    public function newAdress ($postleitzahl, $land, $ort, $strasse, $hausnummer, $stiege, $tuer) {
        $stmt = $this->db->prepare("INSERT INTO sp_Adressen (Postleitzahl, Land, Ort, Strasse, Hausnummer, Stiege, Tuer) VALUES (:postleitzahl, :land, :ort, :strasse, :hausnummer, :stiege, :tuer)");
        $stmt->bindValue(":postleitzahl",strip_tags($postleitzahl,null));
        $stmt->bindValue(":land",strip_tags($land, null));
        $stmt->bindValue(":ort",strip_tags($ort,null));
        $stmt->bindValue(":strasse",strip_tags($strasse, null));
        $stmt->bindValue(":hausnummer",strip_tags($hausnummer,null));
        $stmt->bindValue(":stiege",strip_tags($stiege, null));
        $stmt->bindValue(":tuer",strip_tags($tuer, null));
        $stmt->execute();
        //print_r($stmt->errorInfo());
    }

    public function newPerson ($vorname, $nachname, $geburtsdatum, $geschlecht, $telefonnummer) {
       //letzte gespeicherte Adresse
        $adressen = $this->db->prepare("
            SELECT AdressenID
                FROM sp_Adressen
                ORDER BY AdressenID DESC
                LIMIT 1
            ");
        $adressen->execute();
        $result = $adressen->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
         $adressenID = $row['AdressenID'];
        }

        echo $geburtsdatum;
        //Geburtstag
        $geburtstag = strtotime($geburtsdatum);
        $geburtstag = date('Y-m-d', $geburtstag);

        echo $geburtstag;
        //Insert
        $stmt = $this->db->prepare("INSERT INTO sp_Personen (Vorname, Nachname, Geburtsdatum, AdressenID, Geschlecht, Telefonnummer) VALUES (:vorname, :nachname, :geburtsdatum, :adressenID, :geschlecht, :telefonnummer)");
        $stmt->bindValue(":vorname",strip_tags($vorname, null));
        $stmt->bindValue(":nachname",strip_tags($nachname, null));
        $stmt->bindValue(":geburtsdatum",strip_tags($geburtstag,null));
        $stmt->bindValue(":adressenID",$adressenID);
        $stmt->bindValue(":geschlecht",strip_tags($geschlecht, null));
        $stmt->bindValue(":telefonnummer",strip_tags($telefonnummer, null));
        $stmt->execute();
        print_r($stmt->errorInfo());
    }

    public function newUser ($passwort, $email) {
        $passwort = password_hash($passwort, PASSWORD_DEFAULT);

        $person = $this->db->prepare("
            SELECT PersonID
                FROM sp_Personen
                ORDER BY PersonID DESC
                LIMIT 1
            ");
        $person->execute();
        $result = $person->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $personID = $row['PersonID'];
        }

        $stmt = $this->db->prepare("INSERT INTO sp_Benutzer (Passwort, PersonID, email) VALUES (:passwort, :personID, :email)");
        $stmt->bindValue(":passwort",strip_tags($passwort, null));
        $stmt->bindValue(":personID",$personID);
        $stmt->bindValue(":email",strip_tags($email, null));
        $stmt->execute();
        print_r($stmt->errorInfo());
    }

    public function createCode () {
        $code = rand(100000,999999);
        $zugang = $this->db->prepare("
            SELECT Code
                FROM sp_Zugangscode
                ORDER BY Code DESC
            ");
        $zugang->execute();
        $result = $zugang->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            if ($code == $row['Code']) {
                $this->createCode();
            }
        }
        return $code;

    }

    public function newUserCode ($code) {


        //benutzerID
        $person = $this->db->prepare("
            SELECT BenutzerID, DatumRegistrierung
                FROM sp_Benutzer
                ORDER BY BenutzerID DESC
                LIMIT 1
            ");
        $person->execute();
        $result = $person->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $benutzerID = $row['BenutzerID'];
            $ablaufdatum = $row['DatumRegistrierung'];
        }

        //Ablaufdatum
        $ablaufdatum = strtotime($ablaufdatum. '+ 30 days');
        $ablaufdatum = date('Y-m-d H-i-s', $ablaufdatum);

        $stmt = $this->db->prepare("INSERT INTO sp_Zugangscode (Code, Ablaufsdatum, UserID) VALUES (:code, :ablaufdatum, :benutzerID)");
        $stmt->bindValue(":code",$code);
        $stmt->bindValue(":ablaufdatum",$ablaufdatum);
        $stmt->bindValue(":benutzerID",$benutzerID);
        $stmt->execute();
        print_r($stmt->errorInfo());
    }

    public function getUserCode($id) {
        foreach ($this->getAllUser() as $a) {
            if($id == $a['PersonID']) {
                $person = $this->db->prepare("
                    SELECT Code
                        FROM sp_Zugangscode
                        Where UserID = ".$a['BenutzerID']
                    );
                $person->execute();
                $result = $person->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        foreach ($result as $row) {
            $result = $row['Code'];
        }
        return $result;
    }

    public function getUserID($email) {
        foreach ($this->getAllUser() as $a) {
            if($email == $a['email']) {
                $person = $this->db->prepare("
                    SELECT PersonID
                        FROM sp_Personen
                        Where PersonID = ".$a['PersonID']
                );
                $person->execute();
                $result = $person->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        foreach ($result as $row) {
            $result = $row['PersonID'];
        }
        return $result;
    }

    public function getUserName($id) {
        foreach ($this->getAllUser() as $a) {
            if($id == $a['PersonID']) {
                $person = $this->db->prepare("
                    SELECT Vorname
                        FROM sp_Personen
                        Where PersonID = ".$a['PersonID']
                );
                $person->execute();
                $result = $person->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        foreach ($result as $row) {
            $result = $row['Vorname'];
        }
        return $result;
    }

}