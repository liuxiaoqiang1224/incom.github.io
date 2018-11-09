<?php

	// print_r($_POST['content_from']);
	
	require_once '../../config.php';
	//检测（未写）
	

	//接收数据
	$title = $_POST['title'];
	$content = $_POST['content'];
	$slug = $_POST['slug'];
	$content_from = $_POST['content_from'];
	$category = $_POST['category'];
	$created = $_POST['created'];
	$status = $_POST['status'];

 
	//保存内容
	$file = $_FILES['feature'];

	//对提交的图片文件进行处理并移入文件夹
	
	// 获取文件后缀名 -- strrchr($file['name'], '.')
	// 生产随机+后缀名
	$file_name = uniqid().time().rand(1000, 4000).strrchr($file['name'], '.');
	// 移入新路径
	// 绝对路径形式
	$file_path = '/IN.com/static/uploads/' . $file_name;
	// 移入操作
	move_uploaded_file($file['tmp_name'], '../../static/uploads/' . $file_name);

	//存入数据库
	$link = mysqli_connect(INCOM, USERNAME, PASSWORD, INCOM_NAME);
	$sql = "insert into posts values(null, '$slug', '$title', '$file_path', '$created', '$content', '$content_from', 0, 0, '$status', 1, $category, 'list_01');";
	// echo "$sql";
	$query = mysqli_query($link, $sql);
	// print_r($_POST);
	// echo mysqli_affected_rows($link);
	if (mysqli_affected_rows($link) === 1) {
		echo "成功";
	}else{
		echo "失败";
	}
?>