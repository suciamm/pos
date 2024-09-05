<?php 
include_once 'Conn.php';

/**
 * summary
 */
class M_sales extends Conn
{

    /*
    menu
    */
    public function getMenu()
    {
    	$query 	= "SELECT * FROM `m_menu` ORDER BY `menu` ASC";
    	$result = $this->db->query($query);
    	$fetch 	= $result->fetchALL();

    	$sql['data'] = $fetch;
    	return $sql;
    }
    
    /*
	 function untuk segala kebutuhan tentang produk
    */
    public function getProduct($product)
    {
    	$query 	= "SELECT * FROM `m_product` WHERE `product` LIKE '%$product%' AND  `status`='ready' ORDER BY `product` ASC";
    	$result = $this->db->query($query);
    	$fetch 	= $result->fetchALL();
    	$row 	= $result->rowCount();

    	$sql['data'] = $fetch;
    	$sql['row']  = $row;
    	return $sql;
    }


    public function getAllProduct()
    {
    	$query 	= "SELECT * FROM `m_product` WHERE `status`='ready' ORDER BY `product` ASC";
    	$result = $this->db->query($query);
    	$fetch 	= $result->fetchALL();
    	$row 	= $result->rowCount();

    	$sql['data'] = $fetch;
    	$sql['row']  = $row;
    	return $sql;
    }



    public function getPageProduct($start,$sort) 
    {
    	$query = "SELECT * FROM `m_product` WHERE  `status`='ready' ORDER BY `product` ASC LIMIT $start, $sort";
    	$result = $this->db->query($query);
    	$fetch 	= $result->fetchALL();
    	$row 	= $result->rowCount();

    	$sql['data'] = $fetch;
    	$sql['row']  = $row;
    	return $sql;
    }


    public function getProductByMenu($menu)
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
    			INNER JOIN (m_submenu AS b INNER JOIN m_menu as c ON b.id_menu = c.id_menu AND c.menu='$menu')
    			ON a.id_submenu = b.id_submenu 
    			AND `status`='ready' ORDER BY a.`id` DESC";
    	$result = $this->db->query($query);
    	$fetch 	= $result->fetchALL();    	

    	$sql['data'] = $fetch;
    	$sql['row']  = $result->rowCount();
    	return $sql;
    }




    /*
    *Funtion untuk segala kebutuhan order
    */
    public function getSales()
    {
        $query  = "SELECT 
                    a.sales_code,
                    a.date,
                    a.total,
                    SUM(b.qty) as qty   
                    FROM t_sales AS a INNER JOIN d_sales AS b
                    ON a.sales_code=b.sales_code
                    AND a.status ='N'
                    GROUP BY b.sales_code 
                    ORDER BY a.id DESC";

        $result = $this->db->query($query);
        $fetch  = $result->fetchALL();
        $row    = $result->rowCount();

        $sql['row'] = $row;
        $sql['fetch'] = $fetch;
        return $sql;
    }



    public function getSales_Limit()
    {
    	$query 	= "SELECT id FROM `t_sales` ORDER BY `id` DESC LIMIT 1";
    	$result = $this->db->query($query);
    	$fetch 	= $result->fetch(PDO::FETCH_ASSOC);
    	$row 	= $result->rowCount();

    	$sql['row'] = $row;
    	$sql['fetch'] = $fetch;
    	return $sql;
    }



    // public function getSales_Limit_BySales_code($sales_code)
    // {
    //     $query  = "SELECT * FROM t_sales WHERE sales_code = '$sales_code' AND status = 'N'";
    //     $result = $this->db->query($query);
    //     $fetch  = $result->fetch(PDO::FETCH_ASSOC);
    //     $row    = $result->rowCount();

    //     $sql['row']     = $row;
    //     $sql['fetch']   = $fetch;
    //     return $sql;
    // }

    public function getSales_Limit_BySales_code($sales_code) {
        $query = "
            SELECT 
                SUM(ds.qty) AS total_items, 
                SUM(ds.subtotal) AS grand_total, 
                COALESCE(pt.persentage, 0) AS tax_percentage, 
                COALESCE(psc.persentage, 0) AS service_charge_percentage,
                ts.total as total_sales,
                ds.sales_code
            FROM 
                d_sales ds
            JOIN 
                t_sales ts ON ds.sales_code = ts.sales_code
            LEFT JOIN 
                p_tax pt ON ds.tax_id = pt.id_tax AND pt.stat = 1 AND (ts.date BETWEEN pt.date_from AND pt.date_till)
            LEFT JOIN 
                p_service_charge psc ON ds.service_id = psc.id_service AND psc.stat = 1 AND (ts.date BETWEEN psc.date_from AND psc.date_till)
            WHERE 
                ds.sales_code = :sales_code
            GROUP BY
                ds.sales_code
        ";
    
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':sales_code', $sales_code, PDO::PARAM_STR);
    
        $result = [];
        
        try {
            if ($stmt->execute()) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
                if ($row) {
                    // Calculate tax and service charge amounts
                    $taxAmount = ($row['tax_percentage'] / 100) * $row['grand_total'];
                    $serviceChargeAmount = ($row['service_charge_percentage'] / 100) * $row['grand_total'];
        
                    // Example static discount
                    $discount = 100000;
        
                    // Calculate the final total after discount
                    $finalTotal = $row['grand_total'] + $taxAmount + $serviceChargeAmount - $discount;
        
                    $result = [
                        'status' => 'success',
                        'total_items' => $row['total_items'],
                        'grand_total' => $row['grand_total'],
                        'discount' => $discount,
                        'tax' => $taxAmount,
                        'service_charge' => $serviceChargeAmount,
                        'total' => $finalTotal
                    ];
                } else {
                    $result = [
                        'status' => 'failed',
                        'msg' => 'No data found for sales code'
                    ];
                }
            }
        } catch (PDOException $e) {
            error_log('PDOException: ' . $e->getMessage());
            $result = [
                'status' => 'failed',
                'msg' => 'Query failed to execute: ' . $e->getMessage()
            ];
        }
    
        return $result;
    }
    

    


    public function getSales_BySales_code($sales_code)
    {
        $query  = "SELECT 
                    a.sales_code,
                    a.date,
                    a.total,
                    a.table_id,
                    SUM(b.qty) as qty   
                    FROM t_sales AS a INNER JOIN d_sales AS b
                    ON a.sales_code=b.sales_code
                    AND a.status ='N'
                    WHERE a.sales_code LIKE '$sales_code%'
                    GROUP BY b.sales_code 
                    ORDER BY a.id DESC";

        $result = $this->db->query($query);
        $fetch  = $result->fetchALL();
        $row    = $result->rowCount();

        $sql['row'] = $row;
        $sql['fetch'] = $fetch;
        return $sql;
    }

    

    public function getSales_detail($sales_code)
    {
		$query = "SELECT 
					a.*,
                    b.id as id_product,
					b.product,
					b.price,
					b.image,
					b.id_submenu,
					(a.qty * b.price) as subtotal
				FROM d_sales as a INNER JOIN m_product as b
				ON a.product_code=b.product_code
				WHERE a.sales_code='$sales_code'
				ORDER BY b.product ASC";

		$result = $this->db->query($query);
    	$fetch 	= $result->fetchALL();
    	$row 	= $result->rowCount();

    	$sql['row'] = $row;
    	$sql['fetch'] = $fetch;
    	return $sql;
    }



    
    public function setOrder($sales_code,$date,$total,$operator,$table_id)
    {
    	$query 	= "INSERT INTO `t_sales` VALUES (NULL, '$sales_code', '$date', '$total', 'N', '$operator',$table_id)";
    	$result = $this->db->query($query);
    }


    
    public function setDetail_order($product_code,$qty,$sales_code)
    {
    	$query 	= "INSERT INTO `d_sales` VALUES (NULL, '$product_code', '$qty', '$sales_code')";
    	$result = $this->db->query($query);
    }



    public function updateOrder($sales_code,$total,$operator)
    {
    	$query 	= "UPDATE `t_sales` 
    				SET 
    				`total` 	= '$total',
    				`operator`  = '$operator'    				
    				WHERE 
    				`sales_code` = '$sales_code'";
    	$result = $this->db->query($query);
    	$row 	= $result->rowCount();

    	return $row;
    }


    public function updateSales_status($sales_code,$status)
    {
            $query   = "UPDATE `t_sales` SET `status` = '$status' WHERE `sales_code` = '$sales_code'";
            $result  = $this->db->query($query);
            $row     = $result->rowCount();
            return $row; 
    }



    public function deleteDetail_order($sales_code)
    {
    	$query 	= "DELETE FROM `d_sales` WHERE `sales_code` = '$sales_code'";
    	$result = $this->db->query($query);
    	$row 	= $result->rowCount();

    	return $row;
    } 





    /* 
     * GET DISCOUNT
     */
    public function getDiscount($date)
    {
        $query  = "SELECT 
                    * 
                    FROM 
                        m_promo 
                    WHERE 
                        `start` <= '$date' AND 
                        `end` >= '$date'
                    LIMIT 1";

        $result = $this->db->query($query);
        $data   = $result->fetch(PDO::FETCH_ASSOC);
        $row    = $result->rowCount();

        $sql['data']    = $data;
        $sql['row']     = $row;
        return $sql; 
    }



    public function getDiscountDetail($promo_id)
    {
        $query  = "SELECT * FROM `d_promo` WHERE promo_id = '$promo_id'";
        $result = $this->db->query($query);
        $data   = $result->fetchAll();
        $row    = $result->rowCount();

        $sql['data']    = $data;
        $sql['row']     = $row;
        return $sql;
    }


    
    public function getPriceDiscount($product_code,$sales_code)
    {
            $query  = "SELECT 
                            a.*,
                            b.product_code,
                            b.product,
                            b.price,
                            c.sales_code,
                            c.qty,
                            ((discount /100) * price) AS `discount_price`,
                            (((discount /100) * price) * c.qty) AS `discount_total`
                            
                        FROM 
                            d_promo as a 
                        INNER JOIN m_product AS b
                        ON a.id_product=b.id
                        
                        INNER JOIN d_sales as c
                        ON b.product_code = c.product_code
                        WHERE 
                            b.product_code = '$product_code' AND
                            c.sales_code = '$sales_code'";

            $result = $this->db->query($query);
            $data   = $result->fetch(PDO::FETCH_ASSOC);
            $row    = $result->rowCount();
            return $data;
    }





}




?>