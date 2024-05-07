<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//require_once '../model/M_tax.php'; // Pastikan file M_tax.php benar-benar diperlukan
//include_once '../include/paging.php';	
//include_once '../model/M_tax.php'; // Ganti path sesuai dengan struktur direktori yang benar
//$db 	= direct_model('M_tax');
include_once '../model/M_tax.php';
$db = new M_tax(); // Inisialisasi objek M_tax
// $aksi 	= $_POST['aksi'];
$aksi = $_POST['aksi'] ?? '';
// echo $aksi;die;
$response = array();

/*
* ACTION FORM
*/ 


	if ($aksi == 'addTax') {
		$persentage = $_POST['persentage'] ?? '';
		$date_from = $_POST['date_from'] ?? '';
		$date_till = $_POST['date_till'] ?? '';
		$stat = $_POST['stat'] ?? '';

		
		// Panggil fungsi addTax
		$result = $db->addTax($persentage, $date_from, $date_till, $stat);

		if ($result > 0) {
			$response['status'] = 'success';
			$response['msg'] = 'Data berhasil disimpan';
		} else {
			$response['status'] = 'failed';
			$response['msg'] = 'Gagal menyimpan data';
		}
	} 
	else if ($aksi == 'editTax') {
		// Ambil data dari POST
		$id_tax = $_POST['id_tax'] ?? '';
		$persentage = $_POST['persentage'] ?? '';
		$date_from = $_POST['date_from'] ?? '';
		$date_till = $_POST['date_till'] ?? '';
		$stat = $_POST['stat'] ?? '';
	
		// Panggil fungsi editTax untuk memperbarui data
		$result = $db->editTax($id_tax, $persentage, $date_from, $date_till, $stat);
	
		if ($result > 0) {
			$response['status'] = 'success';
			$response['msg'] = 'Data berhasil diperbarui';
		} else {
			$response['status'] = 'failed';
			$response['msg'] = 'Gagal memperbarui data';
		}
	
		echo json_encode($response); // Kirim respons JSON kembali ke frontend
	}
	
	

	else if ($aksi == 'deleteTax') {
		$id_tax = $_POST['id'] ?? '';
	
		if (!empty($id_tax)) {
			
			$result = $db->deleteTax($id_tax);
	
			if ($result > 0) {
				$response['status'] = 'success';
				$response['msg'] = 'Data berhasil dihapus';
			} else {
				$response['status'] = 'failed';
				$response['msg'] = 'Gagal menghapus data';
			}
		} else {
			$response['status'] = 'failed';
			$response['msg'] = 'ID data tidak valid';
		}
	
		echo json_encode($response);
	}
	
	


	else if($aksi =='deleteAll')
	{
		$id_tax 	= $_POST['id_tax$id_tax'];
		$result = count($id_tax);
		if($result > 0 )
		{
			foreach ($id_tax as $key => $id_tax) {
				$db->deleteTax($id_tax);
			}

			$response['status'] = 'success';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'delete data success';
		}
		else 
		{
			$response['status'] = 'failed';
			$response['aksi'] 	= $aksi;
			$response['msg'] 	= 'failed to deleting data';
		}
		echo json_encode($response);
	}



?>

