<?php
include_once '../include/paging.php';

// // tambahan user login di report 
// session_start(); // Pastikan sesi dimulai
// // Pastikan pengguna sudah login
// if (!isset($_SESSION['pos-id_account'])) {
//     echo json_encode(['status' => 'error', 'msg' => 'User not logged in']);
//     exit;
// }
// $userId = $_SESSION['pos-id_account']; // Ambil ID pengguna dari sesi


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
    } else {
        $response['status'] = 'error';
        $response['data'] = null;
    }

    echo json_encode($response);
} else if ($aksi == 'getReport') {
    $date_from = $_POST['date_from'];
    $date_till = $_POST['date_till'];

    $tes = $db->getSalesReport($date_from, $date_till);
    // $tes = $db->getSalesReport($userId, $date_from, $date_till);

    if ($tes['row'] > 0) {
        $response['status'] = 'success';
        $response['data'] = $tes['data'];
    } else {
        $response['status'] = 'error';
        $response['data'] = null;
    }

    echo json_encode($response);
}
?>