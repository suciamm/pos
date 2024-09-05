<?php 

require 'custom-printer.php';

/**
 * summary
 */
class PrintPage extends WindowsPrint 
{
    


    public function open() 
    {
    	$open = $this->print->initialize();
    	return $open;
    }


    public function close()
    {
    	$this->print->feed(4);
    	$this->print->pulse();
    	$this->print->close();
    }




}




?>