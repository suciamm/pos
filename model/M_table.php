<?php 
include_once 'Conn.php';
/**
 * summary
 */
class M_table extends Conn
{
    /**
     * summary
     */
    
    public function getTable()
    {
    		$query 		= "SELECT * FROM `m_table` ORDER BY table_id DESC";
    		$result 	= $this->db->query($query);
    		$data 		= $result->fetchALl();
    		$row 		= $result->rowCount();

    		$sql['data'] = $data;
    		$sql['row']  = $row;
    		return $sql;
    }



    public function getTable_ById($id)
    {
	    	$query 		= "SELECT * FROM `m_table` WHERE `table_id`='$id'";
			$result 	= $this->db->query($query);
			$data 		= $result->fetch(PDO::FETCH_ASSOC);
			$row 		= $result->rowCount();

			$sql['data'] = $data;
			$sql['row']  = $row;
			return $sql;
    }



    public function getTable_ByStatus($status)
    {
    		$query 		= "SELECT * FROM `m_table` WHERE `status`='N' ORDER BY table_code ASC";
    		$result 	= $this->db->query($query);
    		$data 		= $result->fetchALl();
    		$row 		= $result->rowCount();

    		$sql['data'] = $data;
    		$sql['row']  = $row;
    		return $sql;
    }



    public function checkTable_code($id,$table_code)
    {
    		$query 	= "SELECT 
    					table_code FROM m_table 
						WHERE 
						table_code = '$table_code' AND 
						table_id != '$id'";

			$result = $this->db->query($query);
			$data 	= $result->fetch(PDO::FETCH_ASSOC);
			$row 	= $result->rowCount();

			$sql['data'] = $data;
			$sql['row']  = $row;

			return $sql;
    }



    public function setTable($table_code,$table_number)
    {
	    	$query 		= "INSERT INTO m_table (table_id, table_code, table_number)
							SELECT * FROM (SELECT NULL,'$table_code','$table_number') AS tmp
							WHERE NOT EXISTS (
							    SELECT table_number FROM m_table WHERE table_number = '$table_number'
							) LIMIT 1";
			$result 	= $this->db->query($query);
			$row 		= $result->rowCount();
			return $row;
    }



    public function deleteTable($id)
    {
	    	$query 		= "DELETE FROM m_table
							WHERE table_id='$id' AND table_id 
							NOT IN (SELECT F.table_id
								FROM t_sales AS F WHERE F.table_id=table_id)";

			$result 	= $this->db->query($query);
			$row 		= $result->rowCount();
			return $row;
    }



    public function updateTable($id,$table_code,$table_number)
    {
    		$query 		= "UPDATE `m_table` SET 
    						`table_code`   = '$table_code',
    						`table_number` = '$table_number' 
    						WHERE 
    							`table_id` = '$id'";

			$result 	= $this->db->query($query);
			$row 		= $result->rowCount();

			return $row;
    }



    public function updateTable_status($id,$status)
    {
    		$query  	= "UPDATE `m_table` SET `status` = '$status' WHERE `table_id` = '$id'";
    		$result 	= $this->db->query($query);
			$row 		= $result->rowCount();
			return $row;
    }

}



?>