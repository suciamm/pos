<?php 
include_once 'Conn.php';

/**
 * summary
 */
class M_promo extends Conn
{
    
    /*
     * MASTER PROMO
     */
    	public function getPromo()
    	{
    		$query 		= "SELECT * FROM `m_promo` ORDER BY promo_id DESC";
    		$result		= $this->db->query($query);
    		$data 		= $result->fetchALl();
    		$row 		= $result->rowCount();

    		$sql['data'] 	= $data;
    		$sql['row'] 	= $row;	
    		return $sql ; 
    	}







   	/*
   	 * ACTION FORM
   	*/
   		public function addPromo($start,$end)
   		{
   			$query 	= "INSERT INTO m_promo (`promo_id`, `start`, `end`)
							SELECT * FROM (SELECT NULL,'$start','$end') AS tmp
							WHERE NOT EXISTS (
							    SELECT `start`, `end` FROM m_promo WHERE `start` = '$start' AND `end` = '$end'
							) LIMIT 1";
   			$result = $this->db->query($query);
   			$row 	= $result->rowCount();
   			return $row;
   		}



   		public function editPromo($id,$start,$end)
   		{
   			$query  = "UPDATE `m_promo` SET `start` = '$start', `end` = '$end' WHERE `promo_id` = '$id'";
	        $result = $this->db->query($query);
	        $row    = $result->rowCount();
	        return $row;
   		}



   		public function deletePromo($id)
   		{
   			$query 	= "DELETE FROM `m_promo` WHERE `promo_id` = '$id'";
   			$result = $this->db->query($query);
	        $row    = $result->rowCount();
	        return $row;
   		}


}



?>