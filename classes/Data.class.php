<?php
session_start();

class Data
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
/*
    public function getAllThemen() {
        $themen = $this->db->prepare("
            SELECT * 
                FROM forumthema
                ORDER BY themaid DESC
                
            ");
        $themen->execute();
        $result = $themen->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            echo "<div class='themadiv'>" . "<h3>" . $row['themaname'] . "</h3>
                <form class='nachrichtform' method='POST'>
                   <input type='hidden' name='idmerker' value=' " . $row['themaid'] . " '>
                   <input type='text' name='nachricht' placeholder='Nachricht'>
                   <input type='submit' value='Posten'>
                   
                   </form>";
//  data-id=' " . $row['themaid'] . " '

            $nachrichten = $this->db->prepare("
            SELECT * 
                FROM forumnachricht
                WHERE themaid = ".$row['themaid']
            );
            $nachrichten->execute();
            $result2 = $nachrichten->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result2 as $rownachricht) {
                echo "<div class='nachrichtdiv'>" . "<p style='display: inline'>" . $rownachricht['benutzername'] . " - " .
                    $rownachricht['datum'] . " - " . $rownachricht['nachricht'] . " </p>";
                if($_SESSION['isadmin']) {
                    echo "<button style='display: inline' class='loeschen' data-id=' " . $rownachricht['nachrichtid'] . " '>X</button> ";
                    echo "<form class='nachrichtformedit' method='POST'>
                   <input type='hidden' name='idmerkeredit' value=' " . $rownachricht['nachrichtid'] . " '>
                   <input type='text' name='nachrichtedit' placeholder='Bearbeiten'>
                   <input type='submit' value='Edit'>
                   
                   </form><br>";
                }
                echo "</div>";
            }

            echo "</div>";
        }

    }
*/
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

    public function insertNachricht ($id, $text) {
        $stmt = $this->db->prepare("INSERT INTO sp_Meldung (BenutzerID, Text, Status) VALUES (:id, :text, :status)");
        $stmt->bindValue(":id",$id);
        $stmt->bindValue(":text",strip_tags($text, null));
        $stmt->bindValue(":status","offen");
        $stmt->execute();
        //print_r($stmt->errorInfo());
    }

    public function getProfileData($email) {
        foreach ($this->getAllUser() as $a) {
            if($email == $a['email']) {
                $besuch = $this->db->prepare("
                    SELECT p.PersonID, z.Code, z.Ablaufsdatum, b.Passwort, b.email, p.Vorname, p.Nachname, p.Geburtsdatum, p.Geschlecht, p.Telefonnummer, a.Land, a.Postleitzahl, a.Ort, a.Strasse, a.Hausnummer, a.Stiege, a.Tuer
                        FROM sp_Zugangscode as z inner join sp_Benutzer as b
                            on z.UserID = b.BenutzerID inner join sp_Personen as p
                                on b.PersonID = p.PersonID inner join sp_Adressen as a
                                    on p.AdressenID = a.AdressenID
                        Where p.PersonID = ".$a['PersonID']
                );
                $besuch->execute();
                $result = $besuch->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row) {
                    echo "<div class='datadiv'>"."
                <p>Vorname: " . $row['Vorname'] . "</p>
                <p>Nachname: " . $row['Nachname'] . "</p>
                <p>Geburtsdatum: " . $row['Geburtsdatum'] . "</p>
                <p>Geschlecht: " . $row['Geschlecht'] . "</p>
                <p>Telefonnummer: " . $row['Telefonnummer'] . "</p>
                <p>E-Mail: " . $row['email'] . "</p>
                <p>Land: " . $row['Land'] . "</p>
                <p>Postleitzahl: " . $row['Postleitzahl'] . "</p>
                <p>Ort: " . $row['Ort'] . "</p>
                <p>Straße: " . $row['Strasse'] . "</p>
                <p>Hausnummer: " . $row['Hausnummer'] . "</p>";
                    if ($row['Stiege'] != "") {
                        echo "<p>Steige: " . $row['Steige'] . "</p>";
                    }
                    if ($row['Tuer'] != "") {
                        echo "<p>Tür: " . $row['Tuer'] . "</p>";
                    }
                echo "<p>Code: " . $row['Code'] . "</p>
                      <p>Ablaufdatum Code: " . $row['Ablaufsdatum'] . "</p></div>";
                }    
            }
        }
    }

    public function getAllBesuche($email) {
        foreach ($this->getAllUser() as $a) {
            if($email == $a['email']) {
                $besuch = $this->db->prepare("
                    SELECT BesuchID, Eintritt, Austritt
                        FROM sp_Besuche
                        Where PersonID = ".$a['PersonID']
                );
                $besuch->execute();
                $result = $besuch->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        foreach ($result as $row) {
            echo "<div class='datadiv'>" . "<h3> Besuch " . $row['BesuchID'] . "</h3>
                <p>Eintritt: ". $row['Eintritt'] ."</p>
                <p>Austritt: ". $row['Austritt'] ."</p>
                ";


            $konsum = $this->db->prepare("
            SELECT p.Bezeichnung, pb.Menge, p.Verkaufspreis, pb.Menge * p.Verkaufspreis as Gesamtpreis
                FROM sp_ProduktBeiBesuch as pb inner join sp_Produkt as p on pb.ProduktID = p.ProduktID
                WHERE pb.BesuchID = ".$row['BesuchID']
            );
            $konsum->execute();
            $result2 = $konsum->fetchAll(PDO::FETCH_ASSOC);

            echo "<table> <tr><th>Bezeichnung</th><th>Menge</th><th>Preis/Stk</th><th>Gesamtpreis</th></tr>";
            foreach ($result2 as $rowkonsum) {
                 echo "<tr>
                            <td>". $rowkonsum['Bezeichnung'] . "</td>
                            <td>". $rowkonsum['Menge'] . "</td>
                            <td>". $rowkonsum['Verkaufspreis'] . " €</td>
                            <td>". $rowkonsum['Gesamtpreis'] . " €</td>
                      </tr>";

            }
            echo "</table></div>";

        }

    }

    public function getAllArbeitszeiten($id) {
        foreach ($this->getAllUser() as $a) {
            if($id == $a['PersonID']) {
                $besuch = $this->db->prepare("
                    SELECT az.ArbeitsbeginnSOLL, az.ArbeitsendeSOLL, b.Eintritt, b.Austritt, TIMESTAMPDIFF(MINUTE,b.Eintritt, b.Austritt) as Arbeitsminuten
                        FROM sp_Arbeitszeit as az left join sp_Arbeitsstunden as ast
                            on az.ArbeitszeitID = ast.ArbeitszeitID left join sp_Besuche as b 
                                on ast.BesuchID = b.BesuchID
                        Where az.MitarbeiterID = ".$a['PersonID']
                );
                $besuch->execute();
                $result = $besuch->fetchAll(PDO::FETCH_ASSOC);

                echo "<table> <tr><th>Beginn SOLL</th><th>Ende SOLL</th><th>Beginn IST</th><th>Ende IST</th><th>Stunden</th></tr>";
                foreach ($result as $row) {
                    echo "<tr>
                            <td>". $row['ArbeitsbeginnSOLL'] . "</td>
                            <td>". $row['ArbeitsendeSOLL'] . "</td>
                            <td>". $row['Eintritt'] . "</td>
                            <td>". $row['Austritt'] . "</td>
                            <td>". date('H:i',mktime(0,$row['Arbeitsminuten'])) . "</td>
                      </tr>";
                }
                echo "</table>";
            }
        }
    }

    public function getUerberstunden($id) {
        foreach ($this->getAllUser() as $a) {
            if($id == $a['PersonID']) {
                $besuch = $this->db->prepare("
                    SELECT az.MitarbeiterID, (SUM(TIMESTAMPDIFF(MINUTE,b.Eintritt, b.Austritt)) - SUM(TIMESTAMPDIFF(MINUTE,az.ArbeitsbeginnSOLL, az.ArbeitsendeSOLL))) as Ueberstunden
                        FROM sp_Arbeitszeit as az inner join sp_Arbeitsstunden as ast
                            on az.ArbeitszeitID = ast.ArbeitszeitID inner join sp_Besuche as b 
                                on ast.BesuchID = b.BesuchID
                        group by az.MitarbeiterID
                        Having az.MitarbeiterID = ".$a['PersonID']
                );
                $besuch->execute();
                $result = $besuch->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as $row) {
                    echo "<p> Überstundensaldo:". date('H:i',mktime(0,$row['Ueberstunden']));
                }

            }
        }
    }

    public function getAllNachrichten()
    {
        $themen = $this->db->prepare("
            SELECT MeldungID, Text, Datum, Status 
                FROM sp_Meldung
                ORDER BY MeldungID DESC
                
            ");
        $themen->execute();
        $result = $themen->fetchAll(PDO::FETCH_ASSOC);

        echo "<table> <tr><th>Nummer</th><th>Nachricht</th><th>Datum</th></tr>";
        foreach ($result as $row) {
            echo "<tr>
                            <td>". $row['MeldungID'] . "</td>
                            <td>". $row['Text'] . "</td>
                            <td>". date('d.m.Y',strtotime($row['Datum'])) . "</td>
                          
                      </tr>";
        }
        echo "</table>";

    }

    /*public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM forumnachricht WHERE nachrichtid=:id");
        $stmt->bindValue(":id",$id);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    } */

    public function edit($id, $change, $to) {
        if($change == "Passwort") {
           $to =  password_hash($to, PASSWORD_DEFAULT);
        }

        if ($change == "Vorname" || $change == "Nachname" || $change == "Geschlecht" || $change == "Telefonnummer") {
           $stmt = $this->db->prepare("UPDATE sp_Personen SET ". $change ."=:to WHERE PersonID=:id");
        } elseif ($change == "email" || $change == "Passwort") {
            $stmt = $this->db->prepare("UPDATE sp_Benutzer SET ". $change ."=:to WHERE PersonID=:id");
        } elseif ($change == "Land" || $change == "Postleitzahl" || $change == "Ort" || $change == "Strasse" || $change == "Hausnummer" || $change == "Stiege" || $change == "Tuer") {
            $stmt = $this->db->prepare("UPDATE sp_Adressen a
                                                INNER JOIN sp_Personen p on a.AdressenID = p.AdressenID
                                                SET ". $change ." = :to
                                                WHERE p.PersonID = :id");
        }

       $stmt->bindValue(":id",$id);
       // $stmt->bindValue(":change",$change);
        $stmt->bindValue(":to",strip_tags($to,null));
       // $stmt->bindValue(":tabelle",$tabelle);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}