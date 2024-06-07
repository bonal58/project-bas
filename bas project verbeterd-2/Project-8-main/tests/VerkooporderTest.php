<?php
// auteur: Berkay Onal
// functie: unitests class Verkooporder

use PHPUnit\Framework\TestCase;
use Bas\classes\Verkooporder;

class VerkooporderTest extends TestCase{
    
	protected $Verkooporder;

    protected function setUp(): void {
        $this->Verkooporder = new Verkooporder();
    }

	// Methods moeten starten met de naam test....
	public function testgetVerkooporders(){
		$Verkooporders = $this->Verkooporder->getVerkooporders();
        $this->assertIsArray($Verkooporders);
		$this->assertTrue(count($Verkooporders) > 0, "Aantal moet groter dan 0 zijn");
	}

	public function testGetVerkooporder(){
		$VerkooporderId = 1; // check of dit ook echt in de database bestaat!
		$Verkooporder = $this->Verkooporder->getVerkooporder($VerkooporderId);
		$this->assertEquals($VerkooporderId, $Verkooporder['verkOrdId']);
	}

    public function testInsertVerkooporder(){
        $newVerkooporder = [
            'klant_id' => 1,
            'datum' => '2024-06-05',
            'totaal_bedrag' => 100.00,
            // Add other necessary fields according to your database schema
        ];

        // Insert the new verkooporder
        $insertId = $this->Verkooporder->insertVerkooporder($newVerkooporder);
        
        // Check if the insertId is not false or null
        $this->assertNotFalse($insertId, "Insert failed or returned false");

        // Retrieve the inserted verkooporder to verify
        $insertedVerkooporder = $this->Verkooporder->getVerkooporder($insertId);
        $this->assertNotEmpty($insertedVerkooporder, "Inserted verkooporder should not be empty");

        // Verify each field
        $this->assertEquals($newVerkooporder['klant_id'], $insertedVerkooporder['klant_id']);
        $this->assertEquals($newVerkooporder['datum'], $insertedVerkooporder['datum']);
        $this->assertEquals($newVerkooporder['totaal_bedrag'], $insertedVerkooporder['totaal_bedrag']);
        // Add assertions for other fields as necessary
    }
}

?>
