<!--
    Auteur: Berkay Onal
    Function: home page CRUD Artikel
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Artikel</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<nav>
        <ul>
            <li><a href="../index.html">Home</a></li>
            <li><a href="./insert.php">Toevoegen nieuwe klant</a></li>
            <li><a href="./read.php">Klant overzicht</a></li>
            <li><a href="./insertartikel.php">Artikel toevoegen</a></li>
            <li><a href="./readArtikel.php">Artikel overzicht</a></li>
        </ul>
    </nav>

    <h1>CRUD Artikel</h1>
    
    <nav>
		
		<a href='insertArtikel.php'>Toevoegen nieuwe artikel</a><br><br>

	</nav>
  
    
<?php

// Autoloader classes via composer
require '../../vendor/autoload.php';

use Bas\classes\Artikel;

// Maak een object Artikel
$artikel = new Artikel();

// Start CRUD
$artikel->crudArtikel();

?>
</body>
</html>
