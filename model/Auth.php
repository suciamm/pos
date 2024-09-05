<?php 

// include_once 'Conn.php'; 

// class Auth extends Conn
// {
//     private function start_session() 
//     {
//         if (session_status() == PHP_SESSION_NONE) {
//             session_start();
//         }
//     }

//     public function loginCheck($username, $password)
//     {
//         // Hash password sebelum membandingkannya dengan database
//         $hashedPassword = hash('sha256', $password);

//         $query = "SELECT * FROM `account` 
//                     WHERE 
//                     username = :username AND 
//                     password = :password AND 
//                     status   = 'T'";
//         $stmt = $this->db->prepare($query);
//         $stmt->bindParam(':username', $username);
//         $stmt->bindParam(':password', $hashedPassword);
//         $stmt->execute();
//         $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
//         $row = $stmt->rowCount();

//         if ($row > 0) {
//             $this->start_session();
//             $_SESSION['pos-id_account'] = $fetch['id_account'];
//             $_SESSION['pos-username'] = $fetch['username'];
//             $_SESSION['pos-password'] = $fetch['password'];
//             $_SESSION['pos-level'] = $fetch['level'];
//             $_SESSION['pos-status'] = $fetch['status'];

//             return array('status' => 'success');
//         } else {
//             return array('status' => 'error', 'msg' => 'Invalid username or password');
//         }
//     }

//     public function logout()
//     {
//         $this->start_session();
//         unset($_SESSION['pos-id_account']);
//         unset($_SESSION['pos-username']);
//         unset($_SESSION['pos-password']);
//         unset($_SESSION['pos-level']);
//         unset($_SESSION['pos-status']);
//     }

//     public function createAccount($username, $password, $status, $level)
//     {
//         // Hash password sebelum menyimpannya di database
//         $hashedPassword = hash('sha256', $password);

//         $query = "INSERT INTO account (username, password, status, level) VALUES (:username, :password, :status, :level)";
//         $stmt = $this->db->prepare($query);
//         $stmt->bindParam(':username', $username);
//         $stmt->bindParam(':password', $hashedPassword);
//         $stmt->bindParam(':status', $status);
//         $stmt->bindParam(':level', $level);

//         if ($stmt->execute()) {
//             return array('status' => 'success', 'msg' => 'Account created successfully');
//         } else {
//             return array('status' => 'error', 'msg' => 'Failed to create account');
//         }
//     }
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $auth = new Auth();

//     // Bersihkan semua output buffer sebelum mengirimkan JSON
//     ob_clean();

//     $response = array('status' => 'error', 'msg' => 'Unknown error');

//     if ($_GET['op'] == 'in') {
//         $username = $_POST['username'];
//         $password = $_POST['password'];
//         $response = $auth->loginCheck($username, $password);
//     } else if ($_GET['op'] == 'create') {
//         $username = $_POST['username'];
//         $password = $_POST['password'];
//         $status = $_POST['status'];
//         $level = $_POST['level'];
//         $response = $auth->createAccount($username, $password, $status, $level);
//     }

//     header('Content-Type: application/json');
//     echo json_encode($response);
// }








include_once 'Conn.php'; 

class Auth extends Conn
{
    private function start_session() 
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

	// public function loginCheck($username,$password)
    // {
    // 	$query = "SELECT * FROM `account` 
    // 				WHERE 
    // 				username = '$username' AND 
    // 				password = '$password' AND 
    // 				status 	 = 'T'";
    // 	$result = $this->db->query($query);
    // 	$fetch  = $result->fetch(PDO::FETCH_ASSOC);
    //     $row    = $result->rowCount();

    //     if($row > 0) {
    //     	$this->start_session();
    //     	$_SESSION['pos-id_account'] = $fetch['id_account'];
    // 		$_SESSION['pos-username'] 	= $fetch['username'];
    // 		$_SESSION['pos-password']	= $fetch['password'];
    // 		$_SESSION['pos-level'] 		= $fetch['level'];
    // 		$_SESSION['pos-status']		= $fetch['status'];

    // 		return 1;
    //     }
    //     else {
    //     	return 0;
    //     }
    // }

    // LOGIN HASH 
    // public function loginCheck($username, $password) {
    //     $query = "SELECT * FROM `account` 
    //               WHERE 
    //               username = :username AND 
    //               password = :password AND 
    //               status = 'T'";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindParam(':username', $username);
    //     $stmt->bindParam(':password', $password);
    //     $stmt->execute();
    //     $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
    //     $row = $stmt->rowCount();
    
    //     // Debug statements
    //     error_log("Query: " . $query);
    //     error_log("Username: " . $username);
    //     error_log("Password: " . $password);
    //     error_log("Row count: " . $row);
    //     error_log("Fetch: " . print_r($fetch, true));
    
    //     if ($row > 0) {
    //         $this->start_session();
    //         $_SESSION['pos-id_account'] = $fetch['id_account'];
    //         $_SESSION['pos-username']   = $fetch['username'];
    //         $_SESSION['pos-password']   = $fetch['password'];
    //         $_SESSION['pos-level']      = $fetch['level'];
    //         $_SESSION['pos-status']     = $fetch['status'];
    
    //         return 1;
    //     } else {
    //         return 0;
    //     }   
    // }

    //LOGIN TANPA HAS
    public function loginCheck($username, $password) {
        $query = "SELECT * FROM `account` 
                  WHERE 
                  username = :username AND 
                  password = :password AND 
                  status = 'T'";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); // Tanpa MD5
        $stmt->execute();
        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
        $row = $stmt->rowCount();
    
        // Debug statements
        error_log("Query: " . $query);
        error_log("Username: " . $username);
        error_log("Password: " . $password);
        error_log("Row count: " . $row);
        error_log("Fetch: " . print_r($fetch, true));
    
        if ($row > 0) {
            $this->start_session();
            $_SESSION['pos-id_account'] = $fetch['id_account'];
            $_SESSION['pos-username']   = $fetch['username'];
            $_SESSION['pos-password']   = $fetch['password'];
            $_SESSION['pos-level']      = $fetch['level'];
            $_SESSION['pos-status']     = $fetch['status'];
    
            return 1;
        } else {
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

    //CREATE PAKE HASH
    // public function createAccount($username, $password, $status, $level)
    // {
    //     $hashedPassword = MD5($password);
    
    //     error_log("Creating account with username: $username, hashed password: $hashedPassword, status: $status, level: $level");
    
    //     $query = "INSERT INTO account (username, password, status, level) VALUES (:username, :password, :status, :level)";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindParam(':username', $username);
    //     $stmt->bindParam(':password', $hashedPassword);
    //     $stmt->bindParam(':status', $status);
    //     $stmt->bindParam(':level', $level);
    
    //     if ($stmt->execute()) {
    //         return array('status' => 'success', 'msg' => 'Account created successfully');
    //     } else {
    //         $errorInfo = $stmt->errorInfo();
    //         error_log("Failed to create account: " . print_r($errorInfo, true));
    //         return array('status' => 'error', 'msg' => 'Failed to create account');
    //     }
    // }

    //GAPAKE HASH
    public function createAccount($username, $password, $status, $level) {
        error_log("Creating account with username: $username, password: $password, status: $status, level: $level");
    
        $query = "INSERT INTO account (username, password, status, level) VALUES (:username, :password, :status, :level)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password); // Tanpa MD5
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':level', $level);
    
        if ($stmt->execute()) {
            return array('status' => 'success', 'msg' => 'Account created successfully');
        } else {
            $errorInfo = $stmt->errorInfo();
            error_log("Failed to create account: " . print_r($errorInfo, true));
            return array('status' => 'error', 'msg' => 'Failed to create account');
        }
    }
    
           
}

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $auth = new Auth();

//     if ($_GET['op'] == 'create') {
//         $username = $_POST['username'];
//         $password = $_POST['password'];
//         $status = $_POST['status'];
//         $level = $_POST['level'];

//         // Log data yang diterima
//         error_log("Received data for account creation: Username: $username, Password: $password, Status: $status, Level: $level");

//         echo json_encode($auth->createAccount($username, $password, $status, $level));
//     }
// }


?>
