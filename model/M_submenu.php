<?php 
include_once 'Conn.php';

/**
 * summary
 */
class M_submenu extends Conn
{
    /**
     * summary
     */
   public function view_submenu()
   {
   		$query = "SELECT a.*, b.* 
				FROM `m_menu` as a, `m_submenu` as b
				WHERE b.id_menu = a.id_menu 
				ORDER BY b.id_submenu DESC";
   		
   		$result	= $this->db->query($query);
 		$fetch 	= $result->fetchALL();
  		$row 	= $result->rowCount();

    	$sql['data'] = $fetch;
    	$sql['row'] = $row;
    	return $sql;
   }

	public function insert_submenu($submenu,$id_menu)
	{

		$query 	= "INSERT INTO `m_submenu` 
					VALUES (NULL, '$submenu', '$id_menu')";
		$result = $this->db->query($query);
		return 1;
	}


	public function delete_submenu($id)
	{
	    $query 	= "DELETE FROM `m_submenu` WHERE `id_submenu` = '$id'";
	    $result = $this->db->query($query);
	    return 1;
	}


	public function edit_submenu($id)
	{
		$query 	= "SELECT * FROM m_submenu WHERE id_submenu='$id'";
		$result = $this->db->query($query);
		$sql 	= $result->fetch(PDO::FETCH_ASSOC);
		return $sql;
	}


	public function update_submenu($id,$submenu,$id_menu)
    {
        $query = "UPDATE `m_submenu` SET `submenu` = '$submenu', `id_menu` = '$id_menu' 
                WHERE `id_submenu` = '$id'";
        $result = $this->db->query($query);

        return 1;
    }














    //CHECK
    public function check_submenu($id_menu,$submenu) 
    {
        $query = "SELECT * FROM `m_submenu`
        			WHERE `submenu`='$submenu' AND `id_menu`='$id_menu'";

        $result = $this->db->query($query);
        $row    = $result->rowCount();

        if($row > 0) {
            return 1;
        } 
        else{
            return 0;
        }
    }

    public function check_submenu_edit($submenu,$menu,$submenuold) 
    {
        $query = " SELECT * FROM `m_submenu`
        		WHERE `submenu`='$submenu' 
        		AND `id_menu`='$menu' 
        		AND `submenu` !='$submenuold'";               

        $result = $this->db->query($query);
        $row    = $result->rowCount();

        if($row > 0) {
            return 1;
        } 
        else{
            return 0;
        }
    }


    public function submenuserchByMenu($menu,$submenu)
    {
        $query = "SELECT 
                    id_submenu,
                    submenu,
                    a.id_menu,
                    menu
                FROM m_submenu AS a
                INNER JOIN m_menu AS b
                ON a.id_menu = b.id_menu
                AND menu ='$menu'
                AND submenu LIKE '%$submenu%'";

        $result  = $this->db->query($query);
        $fetch  = $result->fetchALL();
        $row    = $result->rowCount();

        $sql['data'] = $fetch;
        $sql['row'] = $row;

        $sql['data']    = $fetch;
        $sql['row']     = $row;

        return $sql;
    }



}


?>