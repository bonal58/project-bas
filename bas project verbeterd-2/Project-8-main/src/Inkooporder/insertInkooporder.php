<!-- Auteur: Berkay Onal -->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe Inkooporder Plaatsen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Nieuwe Inkooporder Plaatsen</h1>
    <nav>
        <a href='../index.html'>Home</a><br>
        <a href='readInkooporder.php'>Inkooporder Overzicht</a><br><br>
    </nav>
    <?php
    require '../../vendor/autoload.php';
    use Bas\classes\Inkooporder;
    use Bas\classes\Leverancier;
    use Bas\classes\Artikel;

    $inkooporder = new Inkooporder();
    $leverancier = new Leverancier();
    $artikel = new Artikel();

    if (isset($_POST['submit'])) {
        $levId = $_POST['levId'];
        $artId = $_POST['artId'];
        $inkOrdDatum = $_POST['inkOrdDatum'];
        $inkOrdBestAantal = $_POST['inkOrdBestAantal'];
        $inkOrdStatus = $_POST['inkOrdStatus'];

        $result = $inkooporder->insertInkooporder($levId, $artId, $inkOrdDatum, $inkOrdBestAantal, $inkOrdStatus);
        if ($result) {
            echo "Nieuwe inkooporder succesvol geplaatst!";
        } else {
            echo "Er is een fout opgetreden bij het plaatsen van de inkooporder.";
        }
    }

    $leveranciers = $leverancier->getLeveranciers();
    $artikelen = $artikel->getArtikelen();
    ?>
    <form method="post">
        <label for="levId">Leverancier:</label>
        <select name="levId" required>
            <?php foreach ($leveranciers as $lev) { ?>
                <option value="<?php echo $lev['levId']; ?>"><?php echo $lev['levNaam']; ?></option>
            <?php } ?>
        </select><br>
        <label for="artId">Artikel:</label>
        <select name="artId" required>
            <?php foreach ($artikelen as $art) { ?>
                <option value="<?php echo $art['artId']; ?>"><?php echo $art['artOmschrijving']; ?></option>
            <?php } ?>
        </select><br>
        <label for="inkOrdDatum">Order Datum:</label>
        <input type="date" name="inkOrdDatum" required><br>
        <label for="inkOrdBestAantal">Besteld Aantal:</label>
        <input type="number" name="inkOrdBestAantal" required><br>
        <label for="inkOrdStatus">Order Status:</label>
        <input type="text" name="inkOrdStatus" required><br>
        <input type="submit" name="submit" value="Plaats Inkooporder">
    </form>
</body>
</html>
