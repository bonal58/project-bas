<!--
    Auteur: Berkay Onal
    Function: home page CRUD Verkooporder
-->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Verkooporder</title>
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
            <li><a href="./verkooporder/insert.php">Toevoegen nieuwe verkooporder</a></li>
            <li><a href="./verkooporder/read.php">Verkooporder Overzicht</a></li>
        </ul>
    </nav>

    <h1>CRUD Verkooporder</h1>
    
    <nav>
        <a href='../index.html'>Home</a><br>
        <a href='insertVerkooporder.php'>Toevoegen nieuwe verkooporder</a><br><br>
    </nav>
    
<?php

// Autoloader classes via composer
require '../../vendor/autoload.php';

use Bas\classes\Verkooporder;

// Maak een object Verkooporder
$verkooporder = new Verkooporder;

// Start CRUD
$verkooporder->crudVerkooporder();

?>
</body>
</html>
