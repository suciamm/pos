<?php 
include_once 'Conn.php';


/**
 * summary
 */
class M_promo_detail extends Conn
{
    /**
     * GET
     */
    
	    public function getPromoDetail($promo_id)
	    {
	    		$query 	= "SELECT 
								a.*,
							    b.name as payment_name,
							    c.product,
							    c.price
							FROM d_promo AS a 
							LEFT JOIN m_payment_type as b
							ON a.id_payment=b.id_payment
							
							LEFT JOIN m_product as c
							ON a.id_product = c.id
							
							WHERE promo_id='$promo_id'
							ORDER BY detail_promo_id DESC";
				$result = $this->db->query($query);
				$data 	= $result->fetchALL();
				$row 	= $result->rowCount();

				$sql['data'] = $data;
				$sql['row']  = $row;

				return $sql;
	    }

	



	/* 
	  * ACTION FORM
	*/
		public function addPromoDetail($promo_code,$promo_id,$promo_type,$promo_payment,$id_product,$id_payment,$discount)
		{
				$query 		= "INSERT INTO `d_promo` VALUES (
									NULL,
									'$promo_code',
									'$promo_id',
									'$promo_type',
									'$promo_payment',
									 $id_product,
									 $id_payment,
									'$discount'
								)";
				$result 	= $this->db->query($query);
				$row 		= $result->rowCount();
				return $row;
		}



		public function deletePromoDetail($id) 
		{
				$query 	= "DELETE FROM `d_promo` WHERE `detail_promo_id` = '$id'";
	   			$result = $this->db->query($query);
		        $row    = $result->rowCount();
		        return $row;
		}

}


?>