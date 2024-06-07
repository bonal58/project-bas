<?php
// auteur: Berkay Onal
// functie: unitests class Klant

use PHPUnit\Framework\TestCase;
use Bas\classes\Klant;

// Filename moet gelijk zijn aan de classname KlantTest
class KlantTest extends TestCase {
    
    protected $klant;

    protected function setUp(): void {
        $this->klant = new Klant();
    }

    // Methods moeten starten met de naam test....
    public function testgetKlanten() {
        $klanten = $this->klant->getKlanten();
        $this->assertIsArray($klanten);
        $this->assertTrue(count($klanten) > 0, "Aantal moet groter dan 0 zijn");
    }

    public function testGetKlant() {
        $klantId = 1; // check of dit ook echt in de database bestaat!
        $klant = $this->klant->getKlant($klantId);
        $this->assertEquals($klantId, $klant['klantId']);
    }

    public function testInsertKlant() {
        $row = [
            'klantNaam' => 'Test Klant',
            'klantEmail' => 'testklant@example.com',
            'klantAdres' => 'Teststraat 123',
            'klantPostcode' => '1234 AB',
            'klantWoonplaats' => 'Teststad'
        ];

        $result = $this->klant->insertKlant($row);
        $this->assertTrue($result, "Klant moet succesvol worden toegevoegd");

        // Controleren of de klant is toegevoegd
        $klanten = $this->klant->getKlanten();
        $lastKlant = end($klanten);
        $this->assertEquals($row['klantNaam'], $lastKlant['klantNaam'], "De toegevoegde klantnaam moet overeenkomen");
        $this->assertEquals($row['klantEmail'], $lastKlant['klantEmail'], "De toegevoegde klantemail moet overeenkomen");
        $this->assertEquals($row['klantAdres'], $lastKlant['klantAdres'], "De toegevoegde klantadres moet overeenkomen");
        $this->assertEquals($row['klantPostcode'], $lastKlant['klantPostcode'], "De toegevoegde klantpostcode moet overeenkomen");
        $this->assertEquals($row['klantWoonplaats'], $lastKlant['klantWoonplaats'], "De toegevoegde klantwoonplaats moet overeenkomen");
    }
}
?>
