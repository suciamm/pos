<?php 

include_once 'Conn.php';

/**
 * summary
 */
class M_payment extends Conn
{
    /**
     * summary
     */
   



   /*
    * Action FORM
  	*/
   		public function addPayment($sales_code,$id_payment)
   		{
   			$query   = "INSERT INTO `t_payment` VALUES (
   						NULL,
   						'$sales_code',
   						'$id_payment'
   					)";
            $result  = $this->db->query($query);
            $row     = $result->rowCount();
            return $row; 
   		}




}

?>