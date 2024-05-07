<?php 

require 'escpos-php/autoload.php';

//class
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;  
use Mike42\Escpos\ImagickEscposImage;

use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintBuffers\ImagePrintBuffer;
use Mike42\Escpos\CapabilityProfiles\DefaultCapabilityProfile;
use Mike42\Escpos\CapabilityProfiles\SimpleCapabilityProfile;



$connector = new WindowsPrintConnector("ZJ-80");
$printer   = new Printer($connector);

$printer->initialize();



/*
 JUSTIFICATION
*/
	function alignLeft() 	{ return Printer::JUSTIFY_LEFT; }
	function alignCenter() 	{ return Printer::JUSTIFY_CENTER; }
	function alignRight() 	{ return Printer::JUSTIFY_RIGHT; }


/*
 PRINTMODE
*/
	function doubleWidth() 	{ return Printer::MODE_DOUBLE_WIDTH; }
	function doubleHeight() { return Printer::MODE_DOUBLE_HEIGHT; }


/*
 *
*/
	function loadImage($image) 	{ return EscposImage::load($image); }























function close()
{	
	$printer = $GLOBALS['printer'];
	$printer->feed(4);
	$printer->pulse();
	$printer->close();
}

function addSpaces($string = '', $valid_string_length = 0) 
{
    if (strlen($string) < $valid_string_length) {
        $spaces = $valid_string_length - strlen($string);
        for ($index1 = 1; $index1 <= $spaces; $index1++) {
            $string = $string . ' ';
        }
    }

    return $string;
}


























?>