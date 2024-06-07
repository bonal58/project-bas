<?php
// Auteur: Berkay Onal
require '../../vendor/autoload.php';
use Bas\classes\Inkooporder;


$inkooporder = new Inkooporder();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Inkooporders</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="../index.html">Home</a></li>
            <li><a href="../klant/insert.php">Toevoegen nieuwe klant</a></li>
            <li><a href="../klant/read.php">Klant overzicht</a></li>
            <li><a href="../insertartikel.php">Artikel toevoegen</a></li>
            <li><a href="../readArtikel.php">Artikel Overzicht</a></li>
            <li><a href="../verkooporder/insert.php">Toevoegen nieuwe verkooporder</a></li>
            <li><a href="../verkooporder/read.php">Verkooporder Overzicht</a></li>
            <li><a href="./Inkooporder/insertInkooporder.php">Inkooporder toevoegen</a></li>
        </ul>
    </nav>
    <h1>Inkooporders</h1>
    <?php
    $inkooporder->crudInkooporder();
    ?>
</body>
</html>
