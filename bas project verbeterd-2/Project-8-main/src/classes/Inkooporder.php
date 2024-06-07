<?php
// Auteur: Berkay Onal
// Functie: definitie van de Inkooporder class
namespace Bas\classes;

use PDO;
use PDOException;

include_once "functions.php";

class Inkooporder extends Database {
    public $inkOrdId;
    public $levId;
    public $artId;
    public $inkOrdDatum;
    public $inkOrdBestAantal;
    public $inkOrdStatus;
    private $table_name = "inkooporder"; // Ensure table name matches your database

    // Methoden
    
    /**
     * Haal alle inkooporders op en toon ze in een tabel
     * @return void
     */
    public function crudInkooporder() : void {
        // Haal alle inkooporders op uit de database mbv de method getInkooporders()
        $lijst = $this->getInkooporders();

        // Toon een HTML-tabel van de lijst   
        $this->showTable($lijst);
    }

    /**
     * Haal alle inkooporders op uit de database
     * @return array
     */
    public function getInkooporders() : array {
        try {
            // Voer een query uit om inkooporders op te halen, waarbij artikelnamen en leveranciersnamen worden opgehaald
            $sql = "SELECT i.*, a.artOmschrijving AS artNaam, l.levNaam 
                    FROM $this->table_name i 
                    INNER JOIN artikel a ON i.artId = a.artId 
                    INNER JOIN leverancier l ON i.levId = l.levId";
            $stmt = self::$conn->query($sql);
            $lijst = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $lijst;
        } catch (PDOException $e) {
            echo "Fout: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Toon de inkooporders in een HTML-tabel
     * @param array $lijst
     * @return void
     */
    public function showTable(array $lijst) : void {
        if (empty($lijst)) {
            echo "<p>Geen gegevens beschikbaar.</p>";
            return;
        }

        $txt = "<table border='1'>";

        // Voeg de kolomnamen boven de tabel
        $txt .= "<thead><tr>";
        $txt .= "<th>levNaam</th>";
        $txt .= "<th>artNaam</th>";
        $txt .= "<th>inkOrdDatum</th>";
        $txt .= "<th>inkOrdBestAantal</th>";
        $txt .= "<th>inkOrdStatus</th>";
        $txt .= "<th></th><th></th>";
        $txt .= "</tr></thead>";

        $txt .= "<tbody>";
        foreach($lijst as $row){
            $txt .= "<tr>";
            $txt .=  "<td>" . htmlspecialchars($row["levNaam"] ?? '') . "</td>";
            $txt .=  "<td>" . htmlspecialchars($row["artNaam"] ?? '') . "</td>"; // Weergeven van artikelnaam
            $txt .=  "<td>" . htmlspecialchars($row["inkOrdDatum"] ?? '') . "</td>";
            $txt .=  "<td>" . htmlspecialchars($row["inkOrdBestAantal"] ?? '') . "</td>";
            $txt .=  "<td>" . htmlspecialchars($row["inkOrdStatus"] ?? '') . "</td>";
            
            // Update
            // Wijzig knopje
            $txt .=  "<td>";
            $txt .= " 
            <form method='post' action='updateInkooporder.php?inkOrdId=" . htmlspecialchars($row["inkOrdId"] ?? '') . "' >       
                <button name='update'>Wijzig</button>    
            </form> </td>";

            // Verwijderen
            $txt .=  "<td>";
            $txt .= " 
            <form method='post' action='deleteInkooporder.php?inkOrdId=" . htmlspecialchars($row["inkOrdId"] ?? '') . "' >       
                <button name='verwijderen'>Verwijderen</button>    
            </form> </td>"; 
            $txt .= "</tr>";
        }
        $txt .= "</tbody>";
        $txt .= "</table>";
        echo $txt;
    }

    /**
     * Voeg een nieuwe inkooporder toe
     * @param int $levId
     * @param int $artId
     * @param string $inkOrdDatum
     * @param int $inkOrdBestAantal
     * @param string $inkOrdStatus
     * @return bool
     */
    public function insertInkooporder($levId, $artId, $inkOrdDatum, $inkOrdBestAantal, $inkOrdStatus) {
        try {
            $sql = "INSERT INTO $this->table_name (levId, artId, inkOrdDatum, inkOrdBestAantal, inkOrdStatus) 
                    VALUES (:levId, :artId, :inkOrdDatum, :inkOrdBestAantal, :inkOrdStatus)";
            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(':levId', $levId);
            $stmt->bindParam(':artId', $artId);
            $stmt->bindParam(':inkOrdDatum', $inkOrdDatum);
            $stmt->bindParam(':inkOrdBestAantal', $inkOrdBestAantal);
            $stmt->bindParam(':inkOrdStatus', $inkOrdStatus);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Fout: " . $e->getMessage();
            return false;
        }
    }
}
?>
