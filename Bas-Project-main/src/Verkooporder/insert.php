<?php
// Auteur: Berkay
// Functie: Insert

require '../../vendor/autoload.php';
use Bas\classes\Klant;
use Bas\classes\Artikel;
use Bas\classes\Verkooporder;

$message = "";

// Maak nieuwe objecten aan
$klant = new Klant();
$artikel = new Artikel();
$verkooporder = new Verkooporder();

$klanten = $klant->getKlanten(); // Hier wordt de getKlanten methode opgeroepen
$artikelen = $artikel->getArtikelen();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $requiredFields = [
        'klantId', 'artId', 'verkOrdDatum', 'verkOrdBestAantal', 'verkOrdStatus'
    ];
    $isFormValid = true;

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $isFormValid = false;
            break;
        }
    }

    if ($isFormValid) {
        // Bereid de verkoopordergegevens voor
        $verkoopordergegevens = [
            'klantId' => intval($_POST['klantId']),
            'artId' => intval($_POST['artId']),
            'verkOrdDatum' => $_POST['verkOrdDatum'],
            'verkOrdBestAantal' => intval($_POST['verkOrdBestAantal']),
            'verkOrdStatus' => $_POST['verkOrdStatus']
        ];

        if ($verkooporder->insertVerkooporder($verkoopordergegevens)) {
            $message = "Verkooporder succesvol toegevoegd!";
        } else {
            $message = "Er is een fout opgetreden bij het toevoegen van de verkooporder.";
        }
    } else {
        $message = "Vul alstublieft alle vereiste velden in.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toevoegen Verkooporder</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

    <h1>Verkooporder</h1>
    <h2>Toevoegen</h2>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="klantId">Klant:</label>
        <select id="klantId" name="klantId" required>
            <option value="">Selecteer Klant</option>
            <?php foreach ($klanten as $klant): ?>
                <option value="<?php echo $klant['klantId']; ?>"><?php echo $klant['klantNaam']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="artId">Artikel:</label>
        <select id="artId" name="artId" required>
            <option value="">Selecteer Artikel</option>
            <?php foreach ($artikelen as $artikel): ?>
                <option value="<?php echo $artikel['artId']; ?>"><?php echo $artikel['artOmschrijving']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <h3>Verkoopordergegevens</h3>
        <label for="verkOrdDatum">Verkooporder Datum:</label>
        <input type="date" id="verkOrdDatum" name="verkOrdDatum" required/>
        <br>
        <label for="verkOrdBestAantal">Verkooporder Bestel Aantal:</label>
        <input type="number" id="verkOrdBestAantal" name="verkOrdBestAantal" required/>
        <br>
        <label for="verkOrdStatus">Verkooporder Status:</label>
        <select name="verkOrdStatus" required>
            <option value="Verzonden">Verzonden</option>
            <option value="Niet Verzonden">Niet Verzonden</option>
            <option value="Onderweg">Onderweg</option>
        </select>
        <br><br>
        <input type='submit' name='insert' value='Toevoegen'>
    </form><br>

    <a href='read.php'>Terug</a>

</body>
</html>
