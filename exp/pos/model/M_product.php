<?php
include_once 'Conn.php'; 
/**
 * summary
 */
class M_product extends Conn
{
    /**
     * summary
     */
    

    //CRUD
    public function getProduct()
    {
            $query  = "SELECT * FROM `m_product` WHERE status ='ready'";
            $result = $this->db->query($query);
            $row    = $result->rowCount();
            $fetch  = $result->fetchALL();

            $sql['data'] = $fetch;
            $sql['row']  = $row;

            return $sql;
    }



    public function view_product($product)
    {
    	$query = "SELECT 
    			id,product_code,
    			product,
    			qty,
    			price,
    			`status`,
    			submenu,
                menu,
                image,
    			a.id_submenu,
                c.id_menu
    			FROM m_product AS a 
    			INNER JOIN (m_submenu AS b INNER JOIN m_menu as c ON b.id_menu = c.id_menu AND c.menu='$product')
    			ON a.id_submenu = b.id_submenu ORDER BY a.`id` DESC";

    	$result = $this->db->query($query);
    	$row 	= $result->rowCount();
    	$fetch 	= $result->fetchALL();

    	$sql['data'] = $fetch;
    	$sql['row']  = $row;

    	return $sql;
    }


    public function insert_product($product_code,$product,$qty,$price,$status,$image,$id_submenu)
    {   
        $query  = "INSERT INTO `m_product` 
                    VALUES (NULL,'$product_code','$product','$qty','$price','$status','$image','$id_submenu')";
        $result = $this->db->query($query);
        return 1;
    }


    public function update_product($product_code,$product,$qty,$price,$status,$image,$id_submenu,$id)
    {
        $query  = "UPDATE `m_product` SET 
                    `product_code` = '$product_code', 
                    `product`      = '$product', 
                    `qty`          = '$qty',
                    `price`        = '$price',
                    `status`       = '$status',
                    `image`        = '$image',
                    `id_submenu`   = '$id_submenu'
                    WHERE `id` = '$id'"; 

        $result = $this->db->query($query);
        return 1;
    }


    public function delete_product($id)
    {
        $query  = "DELETE FROM m_product WHERE image ='$id'";
        $result = $this->db->query($query);

        return 1;
    }









    //CHECK//
    public function checkonefieldProduct($field,$data)
    {
        $query  = "SELECT * FROM m_product WHERE  $field ='$data'";
        $result = $this->db->query($query);
        $fetch  = $result->fetch(PDO::FETCH_ASSOC);
        $row    = $result->rowCount();

        $sql['data']    = $result;
        $sql['row']     = $row;

        return $sql;   
    }

    public function  checkonefieldProduct_byCategory($field,$data,$category)
    {
        $query  = "SELECT * FROM m_product WHERE  $field ='$data' AND `id_submenu` != '$category'";
        $result = $this->db->query($query);
        $fetch  = $result->fetch(PDO::FETCH_ASSOC);
        $row    = $result->rowCount();

        $sql['data']    = $result;
        $sql['row']     = $row;

        return $sql;
    }





    //GET
    public function get_product_by_id($product,$id)
    {
        $query  = "SELECT 
                    id,product_code,
                    product,
                    qty,
                    price,
                    `status`,
                    submenu,
                    menu,
                    image,
                    a.id_submenu,
                    c.id_menu
                    FROM m_product AS a 
                    INNER JOIN (m_submenu AS b INNER JOIN m_menu as c ON b.id_menu = c.id_menu AND c.menu='$product')
                    ON a.id_submenu = b.id_submenu AND a.id = '$id' ORDER BY a.id DESC";
        $result = $this->db->query($query);
        $fetch  = $result->fetch(PDO::FETCH_ASSOC);
        $row    = $result->rowCount();

        $sql['data'] = $fetch;
        $sql['row']  = $row;

        return $sql;
    }



    public function get_id_submenu_byMenu($submenu,$menu)
    {
            $query  = "SELECT id_submenu,submenu,menu 
                        FROM m_submenu AS a 
                        INNER JOIN m_menu as b 
                        ON a.id_menu=b.id_menu AND submenu='$submenu' AND menu='$menu'";
            $result = $this->db->query($query);
            $fetch  = $result->fetch(PDO::FETCH_ASSOC);
            
            $sql['data'] = $fetch;
            return $sql; 
    } 



    public function getSubmenu_byMenu($menu)
    {
            $query  = "SELECT id_submenu,submenu,menu 
                        FROM m_submenu AS a 
                        INNER JOIN m_menu as b 
                        ON a.id_menu=b.id_menu AND menu='$menu'";
            $result = $this->db->query($query);
            $data   = $result->fetchAll();
            $row    = $result->rowCount();

            $sql['data']    = $data;
            $sql['row']     = $row;
            return $sql; 
    }






}




?>