<?php 

include_once 'Conn.php';

/**
 * summary
 */
class M_profile extends Conn
{
    /**
     * summary
     */
    public function getProfile()
    {
		$query 	= "SELECT * FROM `profile`";
		$result	= $this->db->query($query);
		$data 	= $result->fetch(PDO::FETCH_ASSOC);
		$row 	= $result->rowCount();

		$sql['data'] = $data;
		$sql['row']	 = $row;
		return $sql; 
    }



    public function addProfile($name,$phone,$email,$address,$app_name)
    {
    	$query 	= "INSERT INTO `profile` 
    				VALUES (
    					NULL,
	    				'$name',
	    				'$phone',
	    				'$email',
	    				'$address',
	    				'$app_name'
	    			)";
    	$result = $this->db->query($query);
    	$row 	= $result->rowCount();
    	return $row;
    }



    public function updateProfile($id,$name,$phone,$email,$address,$app_name)
    {
    	$query 	= "UPDATE `profile` 
    				SET 
	    				`name` 		= '$name',
	    				`phone` 	= '$phone',
	    				`email` 	= '$email',
	    				`address` 	= '$address',
	    				`app_name`	= '$app_name'    				
    				WHERE 
    					`id` = '$id'";
    	$result = $this->db->query($query);
    	$row 	= $result->rowCount();
    	return $row;
    }
}











?>