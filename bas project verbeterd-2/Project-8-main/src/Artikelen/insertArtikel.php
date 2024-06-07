<?php
// Auteur: Studentnaam
// Functie: Insert artikel

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Artikel;

// Initialiseer de artikelklasse
$artikel = new Artikel();

// Verwerken van formulier indien verzonden
if (isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen") {
    $artOmschrijving = $_POST['artOmschrijving'];
    $artInkoop = $_POST['artInkoop'];
    $artVerkoop = $_POST['artVerkoop'];
    $artVoorraad = $_POST['artVoorraad'];
    $artMinVoorraad = $_POST['artMinVoorraad'];
    $artMaxVoorraad = $_POST['artMaxVoorraad'];
    $artLocatie = $_POST['artLocatie'];

    // Voeg het artikel toe
    $result = $artikel->insertArtikel([
        'artOmschrijving' => $artOmschrijving,
        'artInkoop' => $artInkoop,
        'artVerkoop' => $artVerkoop,
        'artVoorraad' => $artVoorraad,
        'artMinVoorraad' => $artMinVoorraad,
        'artMaxVoorraad' => $artMaxVoorraad,
        'artLocatie' => $artLocatie,
    ]);

    if ($result) {
        echo "<script>alert('Artikel succesvol toegevoegd');</script>";
    } else {
        echo "<script>alert('Fout bij het toevoegen van artikel');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Artikel</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
            <li><a href="../index.html">Home</a></li>
            <li><a href="./insert.php">Toevoegen nieuwe klant</a></li>
            <li><a href="./read.php">Klant overzicht</a></li>
            <li><a href="./insertartikel.php">Artikel toevoegen</a></li>
            <li><a href="./readArtikel.php">Artikel overzicht</a></li>
            </ul>
        </nav>
    </header>

    <h1>Toevoegen nieuw artikel</h1>

    <form method="post">
        <label for="omschrijving">Artikelomschrijving:</label>
        <input type="text" id="omschrijving" name="artOmschrijving" placeholder="Artikelomschrijving" required/>
        <br>   
        <label for="inkoop">Inkoopprijs:</label>
        <input type="number" step="0.01" id="inkoop" name="artInkoop" placeholder="Inkoopprijs" required/>
        <br>
        <label for="verkoop">Verkoopprijs:</label>
        <input type="number" step="0.01" id="verkoop" name="artVerkoop" placeholder="Verkoopprijs" required/>
        <br>
        <label for="voorraad">Voorraad:</label>
        <input type="number" id="voorraad" name="artVoorraad" placeholder="Voorraad" required/>
        <br>
        <label for="minvoorraad">Minimumvoorraad:</label>
        <input type="number" id="minvoorraad" name="artMinVoorraad" placeholder="Minimumvoorraad" required/>
        <br>
        <label for="maxvoorraad">Maximumvoorraad:</label>
        <input type="number" id="maxvoorraad" name="artMaxVoorraad" placeholder="Maximumvoorraad" required/>
        <br>
        <label for="locatie">Locatie:</label>
        <input type="text" id="locatie" name="artLocatie" placeholder="Locatie" required/>
        <br><br>
        <input type='submit' name='insert' value='Toevoegen'>
    </form>
</body>
</html>
