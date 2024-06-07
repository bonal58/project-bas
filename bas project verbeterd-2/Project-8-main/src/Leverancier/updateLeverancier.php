<!-- Auteur: Berkay Onal -->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leverancier Bijwerken</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Leverancier Bijwerken</h1>
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
        $leverancierData = $leverancier->getLeverancierById($levId);

        if ($leverancierData) {
            if (isset($_POST['submit'])) {
                $levNaam = $_POST['levNaam'];
                $levContact = $_POST['levContact'];
                $levEmail = $_POST['levEmail'];
                $levAdres = $_POST['levAdres'];
                $levPostcode = $_POST['levPostcode'];
                $levWoonplaats = $_POST['levWoonplaats'];

                $result = $leverancier->updateLeverancier($levId, $levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats);
                if ($result) {
                    echo "Leverancier succesvol bijgewerkt!";
                } else {
                    echo "Er is een fout opgetreden bij het bijwerken van de leverancier.";
                }
            }
        } else {
            echo "Leverancier niet gevonden.";
        }
    } else {
        echo "Geen leverancier geselecteerd om bij te werken.";
    }

    if (isset($leverancierData)) {
    ?>
    <form method="post">
        <label for="levNaam">Naam:</label>
        <input type="text" name="levNaam" value="<?php echo htmlspecialchars($leverancierData['levNaam']); ?>" required><br>
        <label for="levContact">Contact:</label>
        <input type="text" name="levContact" value="<?php echo htmlspecialchars($leverancierData['levContact']); ?>" required><br>
        <label for="levEmail">E-mail:</label>
        <input type="email" name="levEmail" value="<?php echo htmlspecialchars($leverancierData['levEmail']); ?>" required><br>
        <label for="levAdres">Adres:</label>
        <input type="text" name="levAdres" value="<?php echo htmlspecialchars($leverancierData['levAdres']); ?>" required><br>
        <label for="levPostcode">Postcode:</label>
        <input type="text" name="levPostcode" value="<?php echo htmlspecialchars($leverancierData['levPostcode']); ?>" required><br>
        <label for="levWoonplaats">Woonplaats:</label>
        <input type="text" name="levWoonplaats" value="<?php echo htmlspecialchars($leverancierData['levWoonplaats']); ?>" required><br>
        <input type="submit" name="submit" value="Bijwerken">
    </form>
    <?php
    }
    ?>
</body>
</html>
