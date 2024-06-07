<?php
// Auteur: Berkay Onal
// Functie: Delete Artikel

// Autoloader classes via composer
require '../../vendor/autoload.php';
use Bas\classes\Artikel;

if(isset($_POST["verwijderen"])){
	
	// Maak een object Artikel
	$artikel = new Artikel();
	
	// Haal het artikel ID op uit de URL
	$artId = $_GET['artId'];
	
	// Delete Artikel op basis van ID
	$artikel->deleteArtikel((int)$artId);

	echo '<script>alert("Artikel verwijderd")</script>';
	echo "<script> location.replace('readArtikel.php'); </script>";
}
?>
