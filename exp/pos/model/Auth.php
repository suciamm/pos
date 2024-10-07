<?php 

include_once 'Conn.php'; 

/**
 * summary
 */
class Auth extends Conn
{
    /**
     * summary
     */

    private function start_session() 
    {
		if (session_status() == PHP_SESSION_NONE) {
		    session_start();
		}
	}



    public function loginCheck($username,$password)
    {
    	$query = "SELECT * FROM `account` 
    				WHERE 
    				username = '$username' AND 
    				password = '$password' AND 
    				status 	 = 'T'";
    	$result = $this->db->query($query);
    	$fetch  = $result->fetch(PDO::FETCH_ASSOC);
        $row    = $result->rowCount();

        if($row > 0) {
        	$this->start_session();
        	$_SESSION['pos-id_account'] = $fetch['id_account'];
    		$_SESSION['pos-username'] 	= $fetch['username'];
    		$_SESSION['pos-password']	= $fetch['password'];
    		$_SESSION['pos-level'] 		= $fetch['level'];
    		$_SESSION['pos-status']		= $fetch['status'];

    		return 1;
        }
        else {
        	return 0;
        }
    }

    public function logout()
    {
    	$this->start_session();
    	unset($_SESSION['pos-id_account']);
    	unset($_SESSION['pos-username']);
    	unset($_SESSION['pos-password']);
    	unset($_SESSION['pos-level']);
    	unset($_SESSION['pos-status']);
    }


}



?>