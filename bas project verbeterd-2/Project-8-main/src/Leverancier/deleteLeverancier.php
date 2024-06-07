<!-- Auteur: Berkay Onal -->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leverancier Verwijderen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Leverancier Verwijderen</h1>
    <nav>
        <a href='../index.html'>Home</a><br>
        <a href='readLeverancier.php'>Leverancier Overzicht</a><br><br>
    </nav>
    <?php
    require '../../vendor/autoload.php';
    use Bas\classes\Leverancier;

    $leverancier = new Leverancier();

    if (isset($_GET['levId'])) {
        $levId = $_GET['levId'];
        $result = $leverancier->deleteLeverancier($levId);
        if ($result) {
            echo "Leverancier succesvol verwijderd!";
        } else {
            echo "Er is een fout opgetreden bij het verwijderen van de leverancier.";
        }
    } else {
        echo "Geen leverancier geselecteerd om te verwijderen.";
    }
    ?>
</body>
</html>
