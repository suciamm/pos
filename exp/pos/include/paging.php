<?php 

	DEFINE('link', 'https://apl.cloudtech.id/pos/index.php');

	function page($page) 
	{
		$redirect = link.'page='.$page;
		return $redirect;
	}

	function sub($page,$sub) 
	{
		$redirect = link.'page='.$page.'&sub='.$sub;
		return $redirect;
	}

	function edit($page,$sub,$id)
	{
		$redirect = link.'page='.$page.'&sub='.$sub.'&id='.$id;
		return $redirect;
	}



	function model($model)
	{
		include_once 'model/'.$model.'.php';
		return $db = new $model;
	}

	function direct_model($model) 
	{
		include_once '../model/'.$model.'.php';
		return $db = new $model;
	}


	function upload($tmpFile,$pathFilename)
	{
		move_uploaded_file($tmpFile,'../image/upload/'.$pathFilename);
	}

	function remove_file($fileName)
	{
		unlink('../image/upload/'.$fileName);
	}

	function update_file($fileName_old,$tmpFile_new,$pathFilename_new) 
	{
		unlink('../image/upload/'.$fileName_old);
		move_uploaded_file($tmpFile_new,'../image/upload/'.$pathFilename_new);
	}


	function rupiah($nominal)
	{
			$rp = number_format($nominal,0,',','.');
			return $rp;
	}

?>
