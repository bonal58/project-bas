<?php
    // Auteur: Berkay Onal
    // Functie: update class Artikel

    // Autoloader classes via composer
    require '../../vendor/autoload.php';
    use Bas\classes\Artikel;
    
    $artikel = new Artikel();

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen") {
        // Code voor een update
        $row = [
            'artId' => $_POST['artId'],
            'artOmschrijving' => $_POST['artOmschrijving'],
            'artInkoop' => $_POST['artInkoop'],
            'artVerkoop' => $_POST['artVerkoop'],
            'artVoorraad' => $_POST['artVoorraad'],
            'artMinVoorraad' => $_POST['artMinVoorraad'],
            'artMaxVoorraad' => $_POST['artMaxVoorraad'],
            'artLocatie' => $_POST['artLocatie']
        ];

        if($artikel->updateArtikel($row)) {
            echo '<script>alert("Artikel gewijzigd")</script>';
            echo "<script> location.replace('readArtikel.php'); </script>";
        } else {
            echo '<script>alert("Fout bij wijzigen artikel")</script>';
        }
    }

    if (isset($_GET['artId'])) {
        $row = $artikel->getArtikel($_GET['artId']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<h1>CRUD Artikel</h1>
<h2>Wijzigen</h2>    
<form method="post">
<input type="hidden" name="artId" 
    value="<?php if(isset($row)) { echo $row['artId']; } ?>">
<label for="artOmschrijving">Artikelomschrijving:</label>
<input type="text" id="artOmschrijving" name="artOmschrijving" required 
    value="<?php if(isset($row)) { echo $row['artOmschrijving']; } ?>"> *</br>
<label for="artInkoop">Inkoopprijs:</label>
<input type="text" id="artInkoop" name="artInkoop" required 
    value="<?php if(isset($row)) { echo $row['artInkoop']; } ?>"> *</br>
<label for="artVerkoop">Verkoopprijs:</label>
<input type="text" id="artVerkoop" name="artVerkoop" required 
    value="<?php if(isset($row)) { echo $row['artVerkoop']; } ?>"> *</br>
<label for="artVoorraad">Voorraad:</label>
<input type="text" id="artVoorraad" name="artVoorraad" required 
    value="<?php if(isset($row)) { echo $row['artVoorraad']; } ?>"> *</br>
<label for="artMinVoorraad">Minimale Voorraad:</label>
<input type="text" id="artMinVoorraad" name="artMinVoorraad" required 
    value="<?php if(isset($row)) { echo $row['artMinVoorraad']; } ?>"> *</br>
<label for="artMaxVoorraad">Maximale Voorraad:</label>
<input type="text" id="artMaxVoorraad" name="artMaxVoorraad" required 
    value="<?php if(isset($row)) { echo $row['artMaxVoorraad']; } ?>"> *</br>
<label for="artLocatie">Locatie:</label>
<input type="text" id="artLocatie" name="artLocatie" required 
    value="<?php if(isset($row)) { echo $row['artLocatie']; } ?>"> *</br></br>
<input type="submit" name="update" value="Wijzigen">
</form></br>

<a href="readArtikel.php">Terug</a>

</body>
</html>

<?php
    } else {
        echo "Geen artId opgegeven<br>";
    }
?>
