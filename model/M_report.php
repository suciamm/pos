<?php
include_once 'Conn.php';

class M_report extends Conn
{
    // ALL REPORT 
    public function getSalesReport($date_from, $date_till)
    {
        $namaUser = isset($_SESSION['pos-username']) ? $_SESSION['pos-username'] : "User tidak dikenal";
        $query = "SELECT * FROM t_sales WHERE operator = :namaUser and date BETWEEN :date_from AND :date_till";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':date_from', $date_from);
        $stmt->bindParam(':date_till', $date_till);
        $stmt->bindParam(':namaUser', $namaUser);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $row = $stmt->rowCount();

        $sql['data'] = $data;
        $sql['row'] = $row;
        return $sql;
    }  
    
    public function getSalesReportDetail($date_from, $date_till)
    {
        $namaUser = isset($_SESSION['pos-username']) ? $_SESSION['pos-username'] : "User tidak dikenal";
       
       $query = "SELECT 
        d_sales.sales_code,
        t_sales.date, 
        m_product.product,
        d_sales.qty AS quantity,
        m_product.price AS price_per_unit,
        (d_sales.qty * m_product.price) AS total_per_product,
        d_sales.discount,
        d_sales.tax,
        d_sales.service,
        t_sales.total,
        t_sales.total AS total_transaction
            FROM 
                t_sales
            JOIN 
                d_sales ON t_sales.sales_code = d_sales.sales_code
            JOIN 
                m_product ON d_sales.product_code = m_product.product_code
            WHERE 
                t_sales.operator = :namaUser
            AND
                date BETWEEN :date_from AND :date_till
            ORDER BY
                t_sales.date DESC, d_sales.sales_code DESC;
            
        
            ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':date_from', $date_from);
        $stmt->bindParam(':date_till', $date_till);
        $stmt->bindParam(':namaUser', $namaUser);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $row = $stmt->rowCount();

        $sql['data'] = $data;
        $sql['row'] = $row;
        return $sql;
    }



    
    public function getSalesReportAll($date_from, $date_till)
{
    // $namaUser = isset($_SESSION['pos-username']) ? $_SESSION['pos-username'] : "User tidak dikenal";
    $query = "
        SELECT 
            operator, 
            DATE(date) as date, 
            SUM(total) as total 
        FROM t_sales 
        WHERE date BETWEEN :date_from AND :date_till    
        GROUP BY operator, date
        ORDER BY operator, date ASC";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':date_from', $date_from);
    $stmt->bindParam(':date_till', $date_till);
    // $stmt->bindParam(':namaUser', $namaUser);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $row = $stmt->rowCount();

    $sql['data'] = $data;
    $sql['row'] = $row;
    return $sql;
}

    
public function getSalesReportDetailAll($date_from, $date_till, $operator)
{
    $query = "
    SELECT 
        d_sales.sales_code,
        t_sales.date, 
        m_product.product,
        d_sales.qty AS quantity,
        m_product.price AS price_per_unit,
        (d_sales.qty * m_product.price) AS total_per_product,
        t_sales.total AS total_transaction,         
        d_sales.discount,
        d_sales.tax,
        d_sales.service
    FROM 
        t_sales
    JOIN 
        d_sales ON t_sales.sales_code = d_sales.sales_code
    JOIN 
        m_product ON d_sales.product_code = m_product.product_code
    WHERE 
        t_sales.operator = :operator
    AND 
        t_sales.date BETWEEN :date_from AND :date_till
    ORDER BY 
        t_sales.operator, t_sales.date ASC";

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':date_from', $date_from);
    $stmt->bindParam(':date_till', $date_till);
    $stmt->bindParam(':operator', $operator);
    // $stmt->bindParam(':selected_date', $selected_date);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $row = $stmt->rowCount();

    $sql['data'] = $data;
    $sql['row'] = $row;
    return $sql;
}


}       