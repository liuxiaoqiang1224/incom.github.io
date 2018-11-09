<?php
	// 查询功能	
	require_once '../../config.php';
	$link = mysqli_connect(INCOM, USERNAME, PASSWORD, INCOM_NAME);
	$sql = "select id,slug,name,classname,link,picter from categories;"; 
	$query = mysqli_query($link, $sql);
	$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
	echo json_encode($result);
?>