<?php
// Auteur: Berkay Onal
// Functie: Update een verkooporder
namespace Bas;

use Bas\classes\Verkooporder;
use Bas\classes\Database;

require 'vendor/autoload.php'; // Zorg ervoor dat Composer autoload hier wordt geladen
require 'config.php'; // Je database configuratiebestand

// Initialiseer de databaseverbinding
Database::initialize($dbConfig);

// Controleer of er een orderId is opgegeven in de URL
if (isset($_GET['orderId'])) {
    $orderId = intval($_GET['orderId']);
    
    // Maak een nieuw Verkooporder object
    $verkooporder = new Verkooporder();

    // Controleer of het formulier is ingediend
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Haal de gegevens op uit het formulier
        $data = [
            'klantId' => intval($_POST['klantId']),
            'artId' => intval($_POST['artId']),
            'verkOrdDatum' => $_POST['verkOrdDatum'],
            'verkOrdBestAantal' => intval($_POST['verkOrdBestAantal']),
            'verkOrdStatus' => $_POST['verkOrdStatus']
        ];

        // Werk de verkooporder bij
        if ($verkooporder->updateVerkooporder($orderId, $data)) {
            echo "De verkooporder is succesvol bijgewerkt.";
        } else {
            echo "Er is een fout opgetreden bij het bijwerken van de verkooporder.";
        }
    } else {
        // Haal de huidige verkoopordergegevens op om in het formulier te tonen
        $orderData = $verkooporder->getVerkooporders();
        $currentOrder = null;
        foreach ($orderData as $order) {
            if ($order['orderId'] == $orderId) {
                $currentOrder = $order;
                break;
            }
        }

        if ($currentOrder) {
            // Toon het formulier met de huidige gegevens
            ?>
            <form method="post" action="">
                <label for="klantId">Klant ID:</label>
                <input type="number" id="klantId" name="klantId" value="<?php echo htmlspecialchars($currentOrder['klantId']); ?>" required><br>

                <label for="artId">Artikel ID:</label>
                <input type="number" id="artId" name="artId" value="<?php echo htmlspecialchars($currentOrder['artId']); ?>" required><br>

                <label for="verkOrdDatum">Order Datum:</label>
                <input type="date" id="verkOrdDatum" name="verkOrdDatum" value="<?php echo htmlspecialchars($currentOrder['verkOrdDatum']); ?>" required><br>

                <label for="verkOrdBestAantal">Bestelling Aantal:</label>
                <input type="number" id="verkOrdBestAantal" name="verkOrdBestAantal" value="<?php echo htmlspecialchars($currentOrder['verkOrdBestAantal']); ?>" required><br>

                <label for="verkOrdStatus">Order Status:</label>
                <input type="text" id="verkOrdStatus" name="verkOrdStatus" value="<?php echo htmlspecialchars($currentOrder['verkOrdStatus']); ?>" required><br>

                <button type="submit">Bijwerken</button>
            </form>
            <?php
        } else {
            echo "Verkooporder niet gevonden.";
        }
    }
} else {
    echo "Geen orderId opgegeven.";
}
?>
