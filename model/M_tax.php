<?php 

include_once 'Conn.php';
class M_tax extends Conn
{

    public function getTax()
{
    // $query  = "SELECT persentage, date_from, date_till,stat FROM `p_tax`";
    $query  = "SELECT * FROM `p_tax` ORDER BY id_tax DESC";
    $result = $this->db->query($query);
    $data 		= $result->fetchALl();
    $row 		= $result->rowCount();

    $sql['data'] = $data;
    $sql['row']  = $row;
    return $sql;
}

public function addTax($persentage, $date_from, $date_till, $stat)
{
    // var_dump("masuk model");die;
    $query = "INSERT INTO `p_tax` VALUES ('','$persentage','$date_from','$date_till','$stat')";
    $result = $this->db->query($query);

    if ($result) {
        return $this->db->lastInsertId(); // Mengembalikan ID terakhir yang dimasukkan (jika diperlukan)
    } else {
        return 0; // Gagal menyimpan data
    }
}



public function editTax($id_tax, $persentage, $date_from, $date_till, $stat)
{
    $query = "UPDATE `p_tax` SET `persentage`='$persentage', `date_from`='$date_from', `date_till`='$date_till', `stat`='$stat' WHERE `id_tax`='$id_tax'";
    $result = $this->db->query($query);
    $row = $result->rowCount();
    return $row; // Mengembalikan jumlah baris yang terpengaruh oleh query UPDATE
}




public function deleteTax($id_tax)
{

    $query 	= "DELETE FROM `p_tax` WHERE `id_tax` = '$id_tax'";
    $result = $this->db->query($query);
    $row    = $result->rowCount();
    return $row;
}

}

?>