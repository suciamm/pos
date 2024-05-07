<?php 
include_once 'Conn.php';

/**
 * summary
 */
class M_menu extends Conn
{
    /**
     * summary
     */
    public function view_menu()
    {
    	$query 	= "SELECT * FROM `m_menu` ORDER BY id_menu DESC";
 		$result	= $this->db->query($query);
 		$fetch 	= $result->fetchALL();
  		$row 	= $result->rowCount();


    	$sql['data'] = $fetch;
    	$sql['row'] = $row;
    	return $sql;
    }


    public function edit_menu($id)
    {
        $query  = "SELECT * FROM `m_menu` WHERE `id_menu`='$id'";
        $result = $this->db->query($query);
        $fetch  = $result->fetch(PDO::FETCH_ASSOC);

        $sql['data'] = $fetch;
        return $sql;
    }

    
    public function insert_menu($menu,$icon)
    {	
    	$query 	= "INSERT INTO `m_menu` 
    				VALUES (NULL, '$menu', '$icon')";
    	$result = $this->db->query($query);
    	return 1;
    }


    public function update_menu($id,$menu,$icon)
    {
        $query = "UPDATE `m_menu` SET `menu` = '$menu', `icon` = '$icon' 
                WHERE `id_menu` = '$id'";
        $result = $this->db->query($query);

        return 1;
    }

    public function delete_menu($id)
    {
        $query = "DELETE FROM `m_menu` WHERE `icon` = '$id'";
        $result = $this->db->query($query);

        return 1;
    }









    //CHECK
    public function check_menu($menu) 
    {
        $query = "SELECT `menu` FROM `m_menu` WHERE `menu`='$menu'";
        $result = $this->db->query($query);
        $row    = $result->rowCount();

        if($row > 0) {
            return 1;
        } 
        else{
            return 0;
        }
    }

    public function check_menu_edit($menu,$menu_old) 
    {
        $query = "SELECT `menu` FROM `m_menu` 
                WHERE `menu` ='$menu' AND `menu` != '$menu_old'";

        $result = $this->db->query($query);
        $row    = $result->rowCount();

        if($row > 0) {
            return 1;
        } 
        else{
            return 0;
        }
    }
}

?>