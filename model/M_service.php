<?php 

include_once 'Conn.php';
class M_service extends Conn
{
    public function getService()
    {
        // $query  = "SELECT persentage, date_from, date_till,stat FROM `p_service_charge`";
        $query  = "SELECT * FROM `p_service_charge` ORDER BY id_service DESC";
        $result = $this->db->query($query);
        $data 		= $result->fetchALl();
        $row 		= $result->rowCount();

        $sql['data'] = $data;
        $sql['row']  = $row;
        return $sql;
    }
    public function addService($persentage, $date_from, $date_till, $stat)
    {
        // var_dump("masuk model");die;
        $query = "INSERT INTO `p_service_charge` VALUES ('','$persentage','$date_from','$date_till','$stat')";
        $result = $this->db->query($query);

        if ($result) {
            return $this->db->lastInsertId(); // Mengembalikan ID terakhir yang dimasukkan (jika diperlukan)
        } else {
            return 0; // Gagal menyimpan data
        }
    }

    public function editService($id_service, $persentage, $date_from, $date_till, $stat)
    {
        
        $query = "UPDATE `p_service_charge` SET `persentage`='$persentage', `date_from`='$date_from', `date_till`='$date_till', `stat`='$stat' WHERE `id_service`='$id_service'";
        $result = $this->db->query($query);
        $row = $result->rowCount();
        return $row; // Mengembalikan jumlah baris yang terpengaruh oleh query UPDATE
    }

    public function deleteService($id_service)
    {

        $query 	= "DELETE FROM `p_service_charge` WHERE `id_service` = '$id_service'";
        $result = $this->db->query($query);
        $row    = $result->rowCount();
        return $row;
    }

}

?>