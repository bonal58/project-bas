<!-- delete.php -->

<?php
// Auteur: Berkay Onal
// Functie: Verwijder verkooporder

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Verkooporder;

$verkooporder = new Verkooporder();

// Controleer of het formulier is ingediend en of de delete-knop is ingedrukt
if(isset($_POST["verwijderen"]) && isset($_GET["orderId"])) {
    // Haal de orderId op uit de URL-parameter
    $orderId = $_GET["orderId"];

    // Verwijder de verkooporder met behulp van de deleteVerkooporder-methode
    if($verkooporder->deleteVerkooporder($orderId)) {
        // Geef een succesmelding weer als de verwijdering succesvol is
        echo '<script>alert("Verkooporder succesvol verwijderd")</script>';
    } else {
        // Geef een foutmelding weer als er een probleem was met het verwijderen
        echo '<script>alert("Er is een fout opgetreden bij het verwijderen van de verkooporder")</script>';
    }
    
    // Stuur de gebruiker terug naar de Verkooporder Overzicht pagina
    echo "<script> location.replace('read.php'); </script>";
}
?>

<!-- Voeg een bevestigingsbericht toe aan de gebruiker -->
<p>Weet u zeker dat u deze verkooporder wilt verwijderen?</p>

<!-- Maak een formulier met een delete-knop -->
<form method="post">
    <button type="submit" name="verwijderen">Verwijderen</button>
</form>
