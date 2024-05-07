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


$printer -> initialize(); //This resets formatting back to the defaults.
// $printer -> text("------------------------------------------\n");
// $printer -> text("Awan Teknologi Inovasi Store\n");
// $printer -> text("------------------------------------------\n");


/* Text of various (in-proportion) sizes */
// title($printer, "Change height & width\n");
// for ($i = 1; $i <= 8; $i++) {
//     $printer -> setTextSize(10, $i);
//     $printer -> text($i);
// }
// $printer -> text("\n");

/* Width changing only */
// title($printer, "Change width only (height=4):\n");
// for ($i = 1; $i <= 5; $i++) {
//     $printer -> setTextSize($i, 4);
//     $printer -> text($i);
// }
// $printer -> text("\n");

/* Height changing only */
// title($printer, "Change height only (width=4):\n");
// for ($i = 1; $i <= 8; $i++) {
//     $printer -> setTextSize(4, $i);
//     $printer -> text($i);
// }
// $printer -> text("\n");

/* Very narrow text */
// title($printer, "Very narrow text:\n");
// $printer -> setTextSize(1, 8);
// $printer -> text("The quick brown fox jumps over the lazy dog.\n");

/* Very flat text */
// title($printer, "Very wide text:\n");
// $printer -> setTextSize(4, 1);
// $printer -> text("Hello world!\n");

/* Very large text */
// title($printer, "Largest possible text:\n");
// $printer -> setTextSize(8, 8);
// $printer -> text("Hello\nworld!\n");


//set title
// $logo 		= EscposImage::load("logo.png");
// $printer -> setJustification(Printer::JUSTIFY_CENTER);
// $printer -> bitImage($logo);
// $printer -> text("\n");

// $printer -> setTextSize(2, 2);
// $printer -> text("ATI Store\n");
// $printer -> selectPrintMode(); //reset
// $printer -> feed();
// $printer -> text("------------------------------------------------\n");
// $printer -> selectPrintMode();



// //set content
// $printer -> setTextSize(1, 1);
// $printer -> setJustification(Printer::JUSTIFY_LEFT);
// $printer -> text("ITEM ");
// $printer -> setJustification();
// $printer -> setJustification(Printer::JUSTIFY_CENTER);
// $printer -> text("SUBTOTAL \n");

// $printer -> setJustification();
// $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
// $printer->text("Jus Mangga \n");
// $printer->selectPrintMode();



//image//
	// $tux = EscposImage::load("logo.png");
	// $printer -> bitImage($tux);
	// $printer -> feed();

	// $printer -> bitImage($tux, Printer::IMG_DOUBLE_WIDTH);
	// $printer -> text("Wide Tux (bit image).\n");
	// $printer -> feed();

	// $printer -> bitImage($tux, Printer::IMG_DOUBLE_HEIGHT);
	// $printer -> text("Tall Tux (bit image).\n");
	// $printer -> feed();

	// $printer -> bitImage($tux, Printer::IMG_DOUBLE_WIDTH | Printer::IMG_DOUBLE_HEIGHT);
	// $printer -> text("Large Tux in correct proportion (bit image).\n");

//barcode & qr coede
	// $printer->barcode("oke123", Printer::BARCODE_CODE39); //number&alfabet(alfabet captial)
	// $printer->barcode("oke123", Printer::BARCODE_CODE93); //all character
	// $testStr = "AKU ANAK INDONESIA sehat dan kuat 1234b %723&*";
	// $printer -> qrCode($testStr);

//table
    $printer->setPrintLeftMargin(0);
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->setEmphasis(false);
    $printer->text(addSpaces('ITEM', 20) . addSpaces('QTY', 20) . addSpaces('SUBTOTAL', 10) . "\n");
    $printer->setEmphasis(true);

    $items = [];


    $items[] = [
        'name' => 'Nasi Goreng Seafood Kemayoran',
        'qtyx_price' => '5',
        'total_price' => '125.000',
        'igst' => 'Rp 25.000',
        'cgst' => '12.00',
        'mrp' => '14.00',
        'upr' => '#',
    ];


    $items[] = [
        'name' => 'Ayam Goreng Pk Gembus Jogjakarta punya cuy',
        'qtyx_price' => '10',
        'total_price' => '50.000',
        'igst' => 'Rp 5.000',
        'cgst' => '-',
        'mrp' => '-',
        'upr' => '#',
    ];

    foreach ($items as $item) {

        //Current item ROW 1
        $name_lines = str_split($item['name'], 15);
        foreach ($name_lines as $k => $l) {
            $l = trim($l);
            $name_lines[$k] = addSpaces($l, 20);
        }

        $qtyx_price = str_split($item['qtyx_price'], 5);
        foreach ($qtyx_price as $k => $l) {
            $l = trim($l);
            $qtyx_price[$k] = addSpaces($l, 10);
        }

        $total_price = str_split($item['total_price'], 15);
        foreach ($total_price as $k => $l) {
            $l = trim($l);
            $total_price[$k] = addSpaces($l, 15);
        }

        $counter = 0;
        $temp = [];
        $temp[] = count($name_lines);
        $temp[] = count($qtyx_price);
        $temp[] = count($total_price);
        $counter = max($temp);

        for ($i = 0; $i < $counter; $i++) {
            $line = '';
            if (isset($name_lines[$i])) {
                $line .= ($name_lines[$i]);
            }
            if (isset($qtyx_price[$i])) {
                $line .= ($qtyx_price[$i]);
            }
            if (isset($total_price[$i])) {
                $line .= ($total_price[$i]);
            }
            $printer->text($line . "\n");
        }

        //Current item ROW 2
        $igst_lines = str_split($item['igst'], 15);
        foreach ($igst_lines as $k => $l) {
            $l = trim($l);
            $igst_lines[$k] = addSpaces($l, 20);
        }

        $cgst_price = str_split($item['cgst'], 28);
        foreach ($cgst_price as $k => $l) {
            $l = trim($l);
            $cgst_price[$k] = addSpaces($l, 28);
        }


        $counter = 0;
        $temp = [];
        $temp[] = count($igst_lines);
        $temp[] = count($cgst_price);
        $counter = max($temp);

        for ($i = 0; $i < $counter; $i++) {
            $line = '';
            if (isset($igst_lines[$i])) {
                $line .= ($igst_lines[$i]);
            }
            if (isset($cgst_price[$i])) {
                $line .= ($cgst_price[$i]);
            }

            $printer->text($line . "\n");
        }

        //Current item ROW 3
        $mrp_lines = str_split($item['mrp'], 15);
        foreach ($mrp_lines as $k => $l) {
            $l = trim($l);
            $mrp_lines[$k] = addSpaces($l, 20);
        }

        $upr_price = str_split($item['upr'], 28);
        foreach ($upr_price as $k => $l) {
            $l = trim($l);
            $upr_price[$k] = addSpaces($l, 28);
        }


        $counter = 0;
        $temp = [];
        $temp[] = count($mrp_lines);
        $temp[] = count($upr_price);

        $counter = max($temp);

        for ($i = 0; $i < $counter; $i++) {

            $line = '';

            if (isset($mrp_lines[$i])) {
                $line .= ($mrp_lines[$i]);
            }

            if (isset($upr_price[$i])) {
                $line .= ($upr_price[$i]);
            }

            $printer->text($line . "\n");
        }
        $printer->feed();
    }



























$printer -> feed(4);
$printer->cut();
$printer->pulse();
$printer -> close();







function title(Printer $printer, $text)
{
    $printer -> selectPrintMode(Printer::MODE_EMPHASIZED);
    $printer -> text("\n" . $text);
    $printer -> selectPrintMode(); // Reset
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