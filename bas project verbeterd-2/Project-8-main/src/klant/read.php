<!--
	Auteur: Berkay Onal
	Function: home page CRUD Klant
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
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
	
    <nav>
		<a href='../index.html'>Home</a><br>
		<a href='insert.php'>Toevoegen nieuwe klant</a><br><br>
	</nav>
	
<?php

// Autoloader classes via composer
require '../../vendor/autoload.php';

use Bas\classes\Klant;

// Maak een object Klant
$klant = new Klant;

// Start CRUD
$klant->crudKlant();

?>
</body>
</html>