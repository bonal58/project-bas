<!-- Auteur: Berkay Onal -->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leverancier Overzicht</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Leverancier Overzicht</h1>
    <nav>
        <a href='../index.html'>Home</a><br>
        <a href='insertLeverancier.php'>Nieuwe Leverancier Toevoegen</a><br><br>
    </nav>
    <?php
    require '../../vendor/autoload.php';
    use Bas\classes\Leverancier;

    $leverancier = new Leverancier();
    $leverancier->crudLeverancier();
    ?>
</body>
</html>
