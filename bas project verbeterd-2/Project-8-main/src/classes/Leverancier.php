<?php
// Auteur: Berkay Onal
// Functie: definitie van de Leverancier class
namespace Bas\classes;

use PDO;
use PDOException;

class Leverancier extends Database {
    private $table_name = "leverancier";

    public function crudLeverancier() : void {
        $lijst = $this->getLeveranciers();
        $this->showTable($lijst);
    }

    public function getLeveranciers() : array {
        try {
            $sql = "SELECT * FROM $this->table_name";
            $stmt = self::$conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Fout: " . $e->getMessage();
            return [];
        }
    }

    public function getLeverancierById($levId) {
        try {
            $sql = "SELECT * FROM $this->table_name WHERE levId = :levId";
            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(':levId', $levId);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Fout: " . $e->getMessage();
            return false;
        }
    }

    public function showTable(array $lijst) : void {
        if (empty($lijst)) {
            echo "<p>Geen gegevens beschikbaar.</p>";
            return;
        }

        echo "<table border='1'>";
        echo "<thead><tr>";
        echo "<th>levId</th>";
        echo "<th>levNaam</th>";
        echo "<th>levContact</th>";
        echo "<th>levEmail</th>";
        echo "<th>levAdres</th>";
        echo "<th>levPostcode</th>";
        echo "<th>levWoonplaats</th>";
        echo "<th></th><th></th>";
        echo "</tr></thead>";
        echo "<tbody>";
        foreach($lijst as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["levId"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["levNaam"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["levContact"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["levEmail"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["levAdres"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["levPostcode"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["levWoonplaats"]) . "</td>";
            echo "<td><form method='post' action='updateLeverancier.php?levId=" . htmlspecialchars($row["levId"]) . "'><button name='update'>Wijzig</button></form></td>";
            echo "<td><form method='post' action='deleteLeverancier.php?levId=" . htmlspecialchars($row["levId"]) . "'><button name='verwijderen'>Verwijderen</button></form></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
    }

    public function insertLeverancier($levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats) {
        try {
            $sql = "INSERT INTO $this->table_name (levNaam, levContact, levEmail, levAdres, levPostcode, levWoonplaats) 
                    VALUES (:levNaam, :levContact, :levEmail, :levAdres, :levPostcode, :levWoonplaats)";
            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(':levNaam', $levNaam);
            $stmt->bindParam(':levContact', $levContact);
            $stmt->bindParam(':levEmail', $levEmail);
            $stmt->bindParam(':levAdres', $levAdres);
            $stmt->bindParam(':levPostcode', $levPostcode);
            $stmt->bindParam(':levWoonplaats', $levWoonplaats);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Fout: " . $e->getMessage();
            return false;
        }
    }

    public function updateLeverancier($levId, $levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats) {
        try {
            $sql = "UPDATE $this->table_name 
                    SET levNaam = :levNaam, levContact = :levContact, levEmail = :levEmail, levAdres = :levAdres, levPostcode = :levPostcode, levWoonplaats = :levWoonplaats 
                    WHERE levId = :levId";
            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(':levId', $levId);
            $stmt->bindParam(':levNaam', $levNaam);
            $stmt->bindParam(':levContact', $levContact);
            $stmt->bindParam(':levEmail', $levEmail);
            $stmt->bindParam(':levAdres', $levAdres);
            $stmt->bindParam(':levPostcode', $levPostcode);
            $stmt->bindParam(':levWoonplaats', $levWoonplaats);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Fout: " . $e->getMessage();
            return false;
        }
    }

    public function deleteLeverancier($levId) {
        try {
            $sql = "DELETE FROM $this->table_name WHERE levId = :levId";
            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(':levId', $levId);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Fout: " . $e->getMessage();
            return false;
        }
    }
}
