<?php
// Auteur: Amin
// Functie: Insert klantgegevens


require '../../vendor/autoload.php';
use Bas\classes\Klant;

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){
    if(isset($_POST['klantnaam']) && isset($_POST['klantemail']) && isset($_POST['klantadres']) && isset($_POST['klantpostcode'])) {
        // Maak een nieuw Klant object aan
        $klant = new Klant();
        
        // Bereid de klantgegevens voor
        $klantgegevens = [
            'klantNaam' => $_POST['klantnaam'],
            'klantEmail' => $_POST['klantemail'],
            'klantWoonplaats' => $_POST['klantwoonplaats'],
            'klantAdres' => $_POST['klantadres'], 
            'klantPostcode' => $_POST['klantpostcode'] 
        ];

        // Voeg de klantgegevens toe aan de database
        if($klant->insertKlant($klantgegevens)) {
            echo "Klant succesvol toegevoegd!";
        } else {
            echo "Er is een fout opgetreden bij het toevoegen van de klant.";
        }
    } else {
        echo "Vul alstublieft alle vereiste velden in.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toevoegen Klant</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

	<h1>CRUD Klant</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<label for="nv">Klantnaam:</label>
	<input type="text" id="nv" name="klantnaam" placeholder="Klantnaam" required/>
	<br>   
	<label for="an">Klantemail:</label>
	<input type="text" id="an" name="klantemail" placeholder="Klantemail" required/>
	<br>
	<label for="an">KlantWachtwoord:</label>
	<input type="text" id="an" name="klantwachtwoord" placeholder="Klantwachtwoord" required/>
	<br>
	<label for="an">KlantPostcode:</label>
	<input type="text" id="an" name="klantpostcode" placeholder="Klantpostcode" required/>
	<br>
	<label for="an">KlantAdres:</label>
	<input type="text" id="an" name="klantadres" placeholder="Klantadres" required/>
	<br>
	<label for="an">KlantWoonplaats:</label>
	<input type="text" id="an" name="klantwoonplaats" placeholder="Klantwoonplaats" required/>
	<br><br>
	<input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='read.php'>Terug</a>

</body>
</html>
