<?php

// Functie: definitie class Artikel
namespace Bas\classes;

use PDO;
use PDOException;
use Bas\classes\Database;

include_once "functions.php";

class Artikel extends Database {
    public $artId;
    public $artOmschrijving;
    public $artInkoop;
    public $artVerkoop;
    public $artVoorraad;
    public $artMinVoorraad;
    public $artMaxVoorraad;
    public $artLocatie;
    private $table_name = "Artikel";   

    // Methods
    
    /**
     * Summary of crudArtikel
     * @return void
     */
    public function crudArtikel() : void {
        // Haal alle artikelen op uit de database mbv de method getArtikelen()
        $lijst = $this->getArtikelen();

        // Print een HTML tabel van de lijst   
        $this->showTable($lijst);
    }

    /**
     * Summary of getArtikelen
     * @return array
     */
    public function getArtikelen() : array {
        try {
            // Doe een query: dit is een prepare en execute in 1 zonder placeholders
            $sql = "SELECT * FROM $this->table_name";
            $stmt = self::$conn->query($sql);
            $lijst = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $lijst;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Summary of getArtikel
     * @param int $artId
     * @return array
     */
    public function getArtikel(int $artId) : array {
        try {
            // Doe een fetch op $artId
            $sql = "SELECT * FROM $this->table_name WHERE artId = :artId";
            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(':artId', $artId, PDO::PARAM_INT);
            $stmt->execute();
            $lijst = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $lijst ?: [];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    
    public function dropDownArtikel($row_selected = -1){
        // Haal alle artikelen op uit de database mbv de method getArtikelen()
        $lijst = $this->getArtikelen();
        
        echo "<label for='Artikel'>Choose an artikel:</label>";
        echo "<select name='artId'>";
        foreach ($lijst as $row){
            if($row_selected == $row["artId"]){
                echo "<option value='$row[artId]' selected='selected'> $row[artOmschrijving] $row[artVerkoop]</option>\n";
            } else {
                echo "<option value='$row[artId]'> $row[artOmschrijving] $row[artVerkoop]</option>\n";
            }
        }
        echo "</select>";
    }

    /**
     * Summary of showTable
     * @param array $lijst
     * @return void
     */
    public function showTable(array $lijst) : void {
        $txt = "<table>";

        // Voeg de kolomnamen boven de tabel
        $txt .= getTableHeader($lijst[0]);

        foreach($lijst as $row){
            $txt .= "<tr>";
            $txt .=  "<td>" . $row["artId"] . "</td>";
            $txt .=  "<td>" . $row["artOmschrijving"] . "</td>";
            $txt .=  "<td>" . $row["artInkoop"] . "</td>";
            $txt .=  "<td>" . $row["artVerkoop"] . "</td>";
            $txt .=  "<td>" . $row["artVoorraad"] . "</td>";
            $txt .=  "<td>" . $row["artMinVoorraad"] . "</td>";
            $txt .=  "<td>" . $row["artMaxVoorraad"] . "</td>";
            $txt .=  "<td>" . $row["artLocatie"] . "</td>";
            
            // Update
            // Wijzig knopje
            $txt .=  "<td>";
            $txt .= " 
            <form method='post' action='updateArtikel.php?artId=$row[artId]' >       
                <button name='update'>Wzg</button>    
            </form> </td>";

            // Delete
            $txt .=  "<td>";
            $txt .= " 
            <form method='post' action='deleteArtikel.php?artId=$row[artId]' >       
                <button name='verwijderen'>Verwijderen</button>    
            </form> </td>"; 
            $txt .= "</tr>";
        }
        $txt .= "</table>";
        echo $txt;
    }

    // Delete artikel
    /**
     * Summary of deleteArtikel
     * @param int $artId
     * @return bool
     */
    public function deleteArtikel(int $artId) : bool {
        try {
            // Doe een delete-query op basis van $artId
            $sql = "DELETE FROM $this->table_name WHERE artId = :artId";
            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(':artId', $artId, PDO::PARAM_INT);
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function updateArtikel($row) : bool {
        // Voer de update van het artikel uit
        try {
            $sql = "UPDATE $this->table_name SET artOmschrijving = :artOmschrijving, artInkoop = :artInkoop, artVerkoop = :artVerkoop, artVoorraad = :artVoorraad, artMinVoorraad = :artMinVoorraad, artMaxVoorraad = :artMaxVoorraad, artLocatie = :artLocatie WHERE artId = :artId";
            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(':artId', $row['artId'], PDO::PARAM_INT);
            $stmt->bindParam(':artOmschrijving', $row['artOmschrijving'], PDO::PARAM_STR);
            $stmt->bindParam(':artInkoop', $row['artInkoop'], PDO::PARAM_STR);
            $stmt->bindParam(':artVerkoop', $row['artVerkoop'], PDO::PARAM_STR);
            $stmt->bindParam(':artVoorraad', $row['artVoorraad'], PDO::PARAM_INT);
            $stmt->bindParam(':artMinVoorraad', $row['artMinVoorraad'], PDO::PARAM_INT);
            $stmt->bindParam(':artMaxVoorraad', $row['artMaxVoorraad'], PDO::PARAM_INT);
            $stmt->bindParam(':artLocatie', $row['artLocatie'], PDO::PARAM_STR);
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Summary of BepMaxArtId
     * @return int
     */
    private function BepMaxArtId() : int {
        // Bepaal uniek nummer
        $sql="SELECT MAX(artId)+1 FROM $this->table_name";
        return (int) self::$conn->query($sql)->fetchColumn();
    }
    
    /**
     * Summary of insertArtikel
     * Voeg een nieuw artikel toe aan de database
     * @param mixed $row Array met artikelgegevens
     * @return bool True als het invoegen succesvol is, anders False
     */
    public function insertArtikel($row) : bool {
        try {
            // Begin een transactie
            self::$conn->beginTransaction();

            // Bepaal een unieke artId
            $artId = $this->BepMaxArtId();
            
            // SQL-query voor het invoegen van een nieuw artikel
            $sql = "INSERT INTO $this->table_name (artId, artOmschrijving, artInkoop, artVerkoop, artVoorraad, artMinVoorraad, artMaxVoorraad, artLocatie) 
                    VALUES (:artId, :artOmschrijving, :artInkoop, :artVerkoop, :artVoorraad, :artMinVoorraad, :artMaxVoorraad, :artLocatie)";
            
            // Bereid de query voor
            $stmt = self::$conn->prepare($sql);
            
            // Bind de parameters
            $stmt->bindParam(':artId', $artId, PDO::PARAM_INT);
            $stmt->bindParam(':artOmschrijving', $row['artOmschrijving'], PDO::PARAM_STR);
            $stmt->bindParam(':artInkoop', $row['artInkoop'], PDO::PARAM_STR);
            $stmt->bindParam(':artVerkoop', $row['artVerkoop'], PDO::PARAM_STR);
            $stmt->bindParam(':artVoorraad', $row['artVoorraad'], PDO::PARAM_INT);
            $stmt->bindParam(':artMinVoorraad', $row['artMinVoorraad'], PDO::PARAM_INT);
            $stmt->bindParam(':artMaxVoorraad', $row['artMaxVoorraad'], PDO::PARAM_INT);
            $stmt->bindParam(':artLocatie', $row['artLocatie'], PDO::PARAM_STR);
            
            // Voer de query uit
            $stmt->execute();

            // Commit de transactie
            self::$conn->commit();

            return true; // Succesvol ingevoegd
        } catch(PDOException $e) {
            // Rol de transactie terug bij een fout
            self::$conn->rollBack();
            echo "Error: " . $e->getMessage();
            return false; // Fout bij het invoegen
        }
    }
}
?>
