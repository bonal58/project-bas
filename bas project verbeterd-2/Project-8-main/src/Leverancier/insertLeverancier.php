<!-- Auteur: Berkay Onal -->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe Leverancier Toevoegen</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Nieuwe Leverancier Toevoegen</h1>
    <nav>
        <a href='../index.html'>Home</a><br>
        <a href='readLeverancier.php'>Leverancier Overzicht</a><br><br>
    </nav>
    <?php
    require '../../vendor/autoload.php';
    use Bas\classes\Leverancier;

    $leverancier = new Leverancier();

    if (isset($_POST['submit'])) {
        $levNaam = $_POST['levNaam'];
        $levContact = $_POST['levContact'];
        $levEmail = $_POST['levEmail'];
        $levAdres = $_POST['levAdres'];
        $levPostcode = $_POST['levPostcode'];
        $levWoonplaats = $_POST['levWoonplaats'];

        $result = $leverancier->insertLeverancier($levNaam, $levContact, $levEmail, $levAdres, $levPostcode, $levWoonplaats);
        if ($result) {
            echo "Nieuwe leverancier succesvol toegevoegd!";
        } else {
            echo "Er is een fout opgetreden bij het toevoegen van de leverancier.";
        }
    }
    ?>
    <form method="post">
        <label for="levNaam">Naam:</label>
        <input type="text" name="levNaam" required><br>
        <label for="levContact">Contact:</label>
        <input type="text" name="levContact" required><br>
        <label for="levEmail">E-mail:</label>
        <input type="email" name="levEmail" required><br>
        <label for="levAdres">Adres:</label>
        <input type="text" name="levAdres" required><br>
        <label for="levPostcode">Postcode:</label>
        <input type="text" name="levPostcode" required><br>
        <label for="levWoonplaats">Woonplaats:</label>
        <input type="text" name="levWoonplaats" required><br>
        <input type="submit" name="submit" value="Toevoegen">
    </form>
</body>
</html>
