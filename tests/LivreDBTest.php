<?php

use PHPUnit\Framework\TestCase;
use WebDriver\Log;

require_once "Constantes.php";
require_once "metier/Livre.php";
require_once "PDO/LivreDB.php";


class LivreDBTest extends TestCase
{
    /**
     * @var LivreDB
     */
    protected $object;
    protected $pdodb;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        //parametre de connexion à la bae de donnée
        $strConnection = Constantes::TYPE . ':host=' . Constantes::HOST . ';dbname=' . Constantes::BASE;
        $arrExtraParam = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $this->pdodb = new PDO($strConnection, Constantes::USER, Constantes::PASSWORD, $arrExtraParam);       //Ligne 3; Instancie la connexion
        $this->pdodb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @covers LivreDB::ajout
     * @todo   Implement testAjout().
     */
    public function testAjout()
    {
        try {
            $this->livre = new LivreDB($this->pdodb);
            $l = new Livre("testTitre", "testEdition", "testInformation", "testAuteur");
            //insertion en bdd
            $this->livre->ajout($l);
            $liv = $this->livre->selectLivre($l->getId());

            $this->assertEquals($l->getTitre(), $liv->getTitre());
            $this->assertEquals($l->getEdition(), $liv->getEdition());
            $this->assertEquals($l->getInformation(), $liv->getInformation());
            $this->assertEquals($l->getAuteur(), $liv->getAuteur());
            $this->livre->suppression($liv);
        } catch (Exception $e) {
            echo 'Exception recue : ',  $e->getMessage(), "\n";
        }
    }


    /**
     * @covers LivreDB::update
     * @todo   Implement testUpdate().
     */
    public function testUpdate()
    {
        $this->object = new LivreDB($this->pdodb);
        $l = new Livre("Flaubert", "livre de Flaubert", "Galimard", "titre update");
        $l->setId(58);
        $this->object->update($l);
        //TODO  à finaliser 
    }

    /**
     * @covers LivreDB::suppression
     * @todo   Implement testSuppression().
     */
    public function testSuppression()
    {
        try {

            $this->livre = new LivreDB($this->pdodb);
            $l = new Livre("testTitre", "testEdition", "testInformation", "testAuteur");
            $this->livre->ajout($l);
            $liv = $this->livre->selectLivre($l->getId());
            $nb = $this->livre->suppression($liv);
            if ($liv != null) {
                $this->markTestIncomplete(
                    'This test delete not ok.'
                );
            }
        } catch (Exception $e) {
            //verification exception
            $exception = "RECORD ADRESSE not present in DATABASE";
            $this->assertEquals($exception, $e->getMessage());
        }
    }

    /**
     * @covers LivreDB::selectAll
     * @todo   Implement testSelectAll().
     */
    public function testSelectAll()
    {
        //TODO
    }

    /**
     * @covers LivreDB::selectLivre
     * @todo   Implement testSelectLivre().
     */
    public function testSelectLivre()
    {
        //TODO
    }
}
