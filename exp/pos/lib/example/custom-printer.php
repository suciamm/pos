<?php 

require 'vendor/autoload.php';
//require 'vendor/mike42/escpos-php/autoload.php'; //without composer


//class
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

use Mike42\Escpos\EscposImage;  
use Mike42\Escpos\ImagickEscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintBuffers\ImagePrintBuffer;
use Mike42\Escpos\CapabilityProfiles\DefaultCapabilityProfile;
use Mike42\Escpos\CapabilityProfiles\SimpleCapabilityProfile;


$connector  = new WindowsPrintConnector("ZJ-80");
$printer 	= new Printer($connector);

$printer -> initialize();


?>