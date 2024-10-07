<?php
include_once '../include/paging.php';
 
session_start();
$namaUser = isset($_SESSION['pos-username']) ? $_SESSION['pos-username'] : "User tidak dikenal";    

$db = direct_model('M_report'); 
$aksi = $_POST['aksi'];

if ($aksi == 'getReportDetail') {
    
    $date_from = $_POST['date_from'];
    $date_till = $_POST['date_till'];

    $tes = $db->getSalesReportDetail($date_from, $date_till);
    // $tes = $db->getSalesReportDetail($userId, $date_from, $date_till);
    
    if ($tes['row'] > 0) {
        $response['status'] = 'success';
        $response['data'] = $tes['data'];
        $response['namaUser'] = $namaUser; // Sertakan nama pengguna

    } else {
        $response['status'] = 'error';
        $response['data'] = null;
        $response['namaUser'] = $namaUser; // Sertakan nama pengguna

    }

    echo json_encode($response);
} 

else if ($aksi == 'getReport') {
    
    $date_from = $_POST['date_from'];
    $date_till = $_POST['date_till'];

    $tes = $db->getSalesReport($date_from, $date_till);
    // $tes = $db->getSalesReport($userId, $date_from, $date_till);

    if ($tes['row'] > 0) {
        $response['status'] = 'success';
        $response['data'] = $tes['data'];
        $response['namaUser'] = $namaUser; // Sertakan nama pengguna
    } else {
        $response['status'] = 'error';
        $response['data'] = null;
        $response['namaUser'] = $namaUser; // Sertakan nama pengguna
    }

    echo json_encode($response);
} 


else if ($aksi == 'getReportDetailAll') {
    
    $date_from = $_POST['date_from'];
    $date_till = $_POST['date_till'];
    $operator = $_POST['operator'];

    $tes = $db->getSalesReportDetailAll($date_from, $date_till, $operator);
    // $tes = $db->getSalesReportDetail($userId, $date_from, $date_till);
    
    if ($tes['row'] > 0) {
        $response['status'] = 'success';
        $response['data'] = $tes['data'];
        $response['namaUser'] = $namaUser; // Sertakan nama pengguna

    } else {
        $response['status'] = 'error';
        $response['data'] = null;
        $response['namaUser'] = $namaUser; // Sertakan nama pengguna
    }

    echo json_encode($response);
} 



else if ($aksi == 'getReportAll') {
    $date_from = $_POST['date_from'];
    $date_till = $_POST['date_till'];

    $tes = $db->getSalesReportAll($date_from, $date_till);
    
    if ($tes['row'] > 0) {
        $groupedData = [];
        foreach ($tes['data'] as $row) {
            $groupedData[$row['operator']][] = $row;
        }
        // foreach ($tes['data'] as $row) {
        //     $groupedData[$row['operator']][] = [
        //         'date' => $row['date']
        //     ];
        // }
        $response['status'] = 'success';
        $response['data'] = $groupedData;
        $response['namaUser'] = $namaUser;
    } else {
        $response['status'] = 'error';
        $response['data'] = null;
        $response['namaUser'] = $namaUser;
    }

    echo json_encode($response);
}


?>