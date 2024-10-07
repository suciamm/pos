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

    public function getQtyAndTotalBySalesCode($sales_code)
    {
        // Query untuk mengambil total qty dari d_sales, total dari t_sales, persentase pajak dari p_tax, dan persentase biaya layanan dari p_service_charge berdasarkan sales_code
        $query = "
            SELECT 
                SUM(ds.qty) AS total_qty,
                ts.total AS total_amount,
                pt.persentage AS tax_percentage,
                sc.persentage AS service_charge_percentage
            FROM 
                d_sales ds
            JOIN 
                t_sales ts ON ds.sales_code = ts.sales_code
            LEFT JOIN 
                p_tax pt ON ds.tax = pt.id_tax
            LEFT JOIN 
                p_service_charge sc ON ds.service = sc.id_service
            WHERE 
                ds.sales_code = :sales_code
            GROUP BY 
                ts.sales_code, pt.persentage, sc.persentage
        ";
    
        // Siapkan statement
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':sales_code', $sales_code, PDO::PARAM_STR);
    
        // Eksekusi query
        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return [
                    'status' => 'success',
                    'qty' => $result['total_qty'],
                    'total' => $result['total_amount'],
                    'tax' => $result['tax_percentage'],
                    'service' => $result['service_charge_percentage']
                ];
            }
        }
    
        // Kembalikan respons jika query gagal
        return [
            'status' => 'failed',
            'msg' => 'Failed to retrieve data'
        ];
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

// m_sales.php

public function getDiscountAllItem($product_code)
{
    // Mengembalikan diskon statis tanpa query ke database
    $discounts = [
        'product_code_1' => 10, // Diskon 10% untuk product_code_1
        'product_code_2' => 15, // Diskon 15% untuk product_code_2
        'product_code_3' => 5,  // Diskon 5% untuk product_code_3
    ];

    // Jika product_code ada di daftar diskon, gunakan nilai tersebut
    if (isset($discounts[$product_code])) {
        $data = ['discount' => $discounts[$product_code]];
        $row = 1;
    } else {
        // Jika tidak, anggap diskon adalah 0
        $data = ['discount' => 0];
        $row = 0;
    }

    $sql['data'] = $data;
    $sql['row'] = $row;
    return $sql;
}
    
public function getDiscountAll()
{
    $date = date('Y-m-d'); // Get the current date
    
    // SQL query to get the discount for the current date
    $query = "SELECT d.discount
              FROM m_promo p
              JOIN d_promo d ON p.promo_id = d.promo_id
              WHERE p.start <= :date
                AND p.end >= :date
              LIMIT 1";
    
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':date', $date);
    $stmt->execute();
    
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $row  = $stmt->rowCount();
    
    return [
        'hasil' => $data,
        'row' => $row
    ];
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