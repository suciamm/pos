<!-- AUTH.PHP  -->

<?php 

include_once 'Conn.php'; 

/**
 * summary
 */
class Auth extends Conn
{
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

	public function createAccount($username, $password, $status, $level)
        {
            $query = "INSERT INTO account (username, password, status, level) VALUES (:username, :password, :status, :level)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':level', $level);
            
            if ($stmt->execute()) {
                return array('status' => 'success', 'msg' => 'Account created successfully');
            } else {
                return array('status' => 'error', 'msg' => 'Failed to create account');
            }
        }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auth = new Auth();

    if ($_GET['op'] == 'in') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        echo json_encode(array('status' => $auth->loginCheck($username, $password) ? 'success' : 'error'));
    } else if ($_GET['op'] == 'create') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        echo json_encode($auth->createAccount($username, $password));
    }

    if ($_GET['op'] == 'create') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $status = $_POST['status'];
        $level = $_POST['level'];
        echo json_encode($auth->createAccount($username, $password, $status, $level));
    }
}


?>