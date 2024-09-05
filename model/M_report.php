<?php
// include_once 'Conn.php';

// class M_report extends Conn
// {
//     public function getSalesReport()
//     {
//         $query = "SELECT * FROM t_sales";

//         $result = $this->db->query($query);
//         $data = $result->fetch(PDO::FETCH_ASSOC);
//         $row = $result->rowCount();
    
//         $sql['data'] = $data;
//         $sql['row'] = $row;
//         return $sql;
//     }

// }


//PERCOBAAN - DATA TAMPIL CUMA 1

// include_once 'Conn.php';

// class M_report extends Conn
// {
//     public function getSalesReport($date_from, $date_till)
//     {
//         $query = "SELECT * FROM t_sales WHERE date BETWEEN :date_from AND :date_till";
//         $stmt = $this->db->prepare($query);
//         $stmt->bindParam(':date_from', $date_from);
//         $stmt->bindParam(':date_till', $date_till);
//         $stmt->execute();
//         $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
//         $row = $stmt->rowCount();

//         $sql['data'] = $data;
//         $sql['row'] = $row;
//         return $sql;
//     }
// }

//PERCOBAAN 2

include_once 'Conn.php';

class M_report extends Conn
{
    public function getSalesReport($date_from, $date_till)
    {
        $query = "SELECT * FROM t_sales WHERE date BETWEEN :date_from AND :date_till";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':date_from', $date_from);
        $stmt->bindParam(':date_till', $date_till);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $row = $stmt->rowCount();

        $sql['data'] = $data;
        $sql['row'] = $row;
        return $sql;
    }   
    public function getSalesReportDetail($date_from, $date_till)
    {
        $query = "SELECT 
        t_sales.sales_code,
        t_sales.date,
        t_sales.operator,
        m_product.product,
        d_sales.qty AS quantity,
        m_product.price AS price_per_unit,
        (d_sales.qty * m_product.price) AS total_per_product,
        t_sales.total AS total_transaction
            FROM 
                t_sales
            JOIN 
                d_sales ON t_sales.sales_code = d_sales.sales_code
            JOIN 
                m_product ON d_sales.product_code = m_product.product_code
            WHERE 
                date BETWEEN :date_from AND :date_till;
            ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':date_from', $date_from);
        $stmt->bindParam(':date_till', $date_till);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $row = $stmt->rowCount();

        $sql['data'] = $data;
        $sql['row'] = $row;
        return $sql;
    }
}
?>
