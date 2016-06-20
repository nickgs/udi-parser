<?php

/**
 * Parse UDI Strings
 **/
class UdiParser {
  public $upc;          //Twelve digit number 
  public $lot;          //Up to a 20 digit in length. (ADC will always be 8)
  public $prodDate;     //Production Date in YYMMDD format
  public $expireDate;   //Expiration date in YYMMDD format. 
  public $serial;       //product serial number

  //source udi string.
  protected $udi;

  //fixed length lot number
  protected $lotLength = 8;


  /**
   * Cruede parse function for scanned UDI numbers.
   * Assumes application identifiers are laid out in the following fashion:
   *
   * (01)(10)(11)(17)(21)
   *
   * Where (17) is optional AND (10) is a fixed length by $lotLength.
   **/
  public function parse($udi) {

    $this->udi = str_split($udi);  //convert string to array
    
    //extract UPC. Application identifier (01)
    $this->upc = array_slice($this->udi,2,14);

    //extract Lot #. Application identifier (10)
    $this->lot = array_slice($this->udi,18,$this->lotLength);
    
    //extract production date. Application identifier (11)
    $this->prodDate = array_slice($this->udi,28,6);

    //conditional fields
    $nextApp = implode(array_slice($this->udi,34,2));
    if($nextApp == "17") {
      //extract expiration date
      $this->expireDate = array_slice($this->udi,36,6);
      $this->serial = array_slice($this->udi,44, 20);
    }
    else {
      $this->expireDate = array();
      $this->serial = array_slice($this->udi,36,20);
    }

    return "OK";
  }

  public function getUpc(){
    return implode("", $this->upc);
  }

  public function getLot() {
    return implode("", $this->lot);
  }
  public function getProductionDate() {
    return implode("", $this->prodDate);
  }
  public function getExpirationDate() {
    return implode("", $this->expireDate);
  }
  public function getSerialNumber() {
    return implode("", $this->serial);
  }
}
