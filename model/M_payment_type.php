<?php 

include_once 'Conn.php';

/**
 * summary
 */
class M_payment_type extends Conn
{
    /**
     * summary
     */
    
    public function getPayment()
    {
        $query  = "SELECT * FROM `m_payment_type` ORDER BY `id_payment` DESC";
        $result = $this->db->query($query);
        $data   = $result->fetchALL();
        $row    = $result->rowCount();

        $sql['data'] = $data;
        $sql['row']  = $row;
        return $sql; 
    }



    public function getPaymentByName($payment)
    {
        $query  = "SELECT * FROM `m_payment_type` WHERE name ='$payment'";
        $result = $this->db->query($query);
        $data   = $result->fetch(PDO::FETCH_ASSOC);
        $row    = $result->rowCount();

        $sql['data']    = $data;
        $sql['row']     = $row;
        return $sql; 
    }











    /**
     * FORM ACTION
     */
    public function addPayment($name) 
    {
        $query  = "INSERT INTO `m_payment_type` VALUES (NULL,'$name')";
        $result = $this->db->query($query);
        $row    = $result->rowCount();

        return $row;
    }



    public function updatePayment($id,$name)
    {
        $query  = "UPDATE `m_payment_type` SET `name` = '$name' WHERE `id_payment` = '$id'";
        $result = $this->db->query($query);
        $row    = $result->rowCount();

        return $row;
    }



    public function deletePayment($id)
    {
        $query  = "DELETE FROM `m_payment_type` WHERE `id_payment` = '$id'";
        $result = $this->db->query($query);
        $row    = $result->rowCount();
        return $row;
    }











}


?>