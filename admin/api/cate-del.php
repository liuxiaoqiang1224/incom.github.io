<?php
	require_once '../../config.php';
	//接收数据id
	$id = $_GET['id'];
	$link = mysqli_connect(INCOM, USERNAME, PASSWORD, INCOM_NAME);
	$sql = "delete from categories where id in ($id);"; 
	$query = mysqli_query($link, $sql);
	// print_r($result);
	
	//检测受影响行数
	if (mysqli_affected_rows($link) > 0) {
		echo '成功';
	}else{
		echo '失败';
	}
?>