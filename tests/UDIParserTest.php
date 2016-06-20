<?php


class UdiParserTest extends \PHPUnit_Framework_TestCase {
  
  //Basline sanity check.
  public function testTrueisTrue() {
    $foo = true; 

    $this->assertTrue($foo);
  }

  //make sure we can create an instance.
  public function testUdiParserCreation() {
    $p = new UdiParser();

    $this->assertInstanceOf(UdiParser::class, $p);
  }

  //lets verify we can extract applications
  public function testParseWithExpiration() {
    $p = new UdiParser();

    $nextApp = $p->parse("0100634782053611101234567811160609171706092112345678901234567890");

    $this->assertEquals("OK", $nextApp);

    $upc = $p->getUpc();
    $this->assertEquals("00634782053611", $upc);  

    $lot = $p->getLot();
    $this->assertEquals("12345678", $lot);
    
    $prodDate = $p->getProductionDate();
    $this->assertEquals("160609", $prodDate);    
    
    $expireDate = $p->getExpirationDate();
    $this->assertEquals("170609", $expireDate);

    $serial = $p->getSerialNumber();
    $this->assertEquals("12345678901234567890", $serial);
  }
 
  //lets verify we can extract applications
  public function testParseWithOutExpiration() {
    $p = new UdiParser();

    $nextApp = $p->parse("01006347820536111012345678111606092112345678901234567890");

    $this->assertEquals("OK", $nextApp);

    $upc = $p->getUpc();
    $this->assertEquals("00634782053611", $upc);  

    $lot = $p->getLot();
    $this->assertEquals("12345678", $lot);
    
    $prodDate = $p->getProductionDate();
    $this->assertEquals("160609", $prodDate);    
    
    $expireDate = $p->getExpirationDate();
    $this->assertEquals("", $expireDate);

    $serial = $p->getSerialNumber();
    $this->assertEquals("12345678901234567890", $serial);
  }

}
