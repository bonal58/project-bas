<?php
// auteur: Berkay Onal
// functie: insert class Klant

require '../../vendor/autoload.php';
use Bas\classes\Klant;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = '';

if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $klantnaam = $_POST['klantnaam'];
    $klantemail = $_POST['klantemail'];
    $klantadres = $_POST['klantadres'];
    $klantpostcode = $_POST['klantpostcode'];
    $klantwoonplaats = $_POST['klantwoonplaats'];

    // Validatie
    if (!empty($klantnaam) && !empty($klantemail) && !empty($klantadres) && !empty($klantpostcode) && !empty($klantwoonplaats)) {
        // Maak een nieuwe Klant instantie aan en voeg de klant toe
        $klant = new Klant();
        $row = [
            'klantNaam' => $klantnaam,
            'klantEmail' => $klantemail,
            'klantAdres' => $klantadres,
            'klantPostcode' => $klantpostcode,
            'klantWoonplaats' => $klantwoonplaats
        ];

        try {
            $result = $klant->insertKlant($row);

            if ($result) {
                $message = "Klant succesvol toegevoegd!";
            } else {
                $message = "Er is een fout opgetreden bij het toevoegen van de klant.";
            }
        } catch (Exception $e) {
            $message = "Error: " . $e->getMessage();
        }
    } else {
        $message = "Alle velden zijn verplicht.";
    }
}

// HTML output
echo <<<HTML
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toevoegen nieuwe klant</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<nav>
        <ul>
            <li><a href="../index.html">Home</a></li>
            <li><a href="./klant/insert.php">Toevoegen nieuwe klant</a></li>
            <li><a href="./klant/read.php">Klant overzicht</a></li>
            <li><a href="./insertartikel.php">Artikel toevoegen</a></li>
            <li><a href="./readArtikel.php">Artikel Overzicht</a></li>
        </ul>
    </nav>
    
    <h1>CRUD Klant</h1>
    <h2>Toevoegen</h2>
    <br>
    <form method="post" action="">
        <label for="nv">Klantnaam:</label>
        <input type="text" id="nv" name="klantnaam" placeholder="Klantnaam" required />
        <br>
        <label for="an">Klantemail:</label>
        <input type="text" id="an" name="klantemail" placeholder="Klantemail" required />
        <br>
        <label for="adres">Klantadres:</label>
        <input type="text" id="adres" name="klantadres" placeholder="Klantadres" required />
        <br>
        <label for="postcode">Klantpostcode:</label>
        <input type="text" id="postcode" name="klantpostcode" placeholder="Klantpostcode" required />
        <br>
        <label for="woonplaats">Klantwoonplaats:</label>
        <input type="text" id="woonplaats" name="klantwoonplaats" placeholder="Klantwoonplaats" required />
        <br><br>
        <input type="submit" name="insert" value="Toevoegen" />
    </form>
    <br>
    <a href='read.php'>Terug</a>
HTML;

if (!empty($message)) {
    echo "<script type='text/javascript'>alert('$message');</script>";
}

echo '</body></html>';
?>
