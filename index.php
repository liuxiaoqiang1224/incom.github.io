<?php
	//引用config.php文件
	require_once './config.php';
	// echo INCOM;
	//数据库连接
	$link = mysqli_connect(INCOM, USERNAME, PASSWORD, INCOM_NAME);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>.COM -- 更好的web前端体验</title>
	<meta name="description" content="专注于更好的web知识网站！">
	<meta name="keywords" content="专注于更好的web知识网站，前端，web，javascript，jQuery，html，css，php，交互，动效，优化，建站" />
	<link rel="stylesheet" href="static/assets/css/common.css">
	<link rel="stylesheet" href="static/assets/css/com.css">
	<link rel="shortcut icon" href="static/uploads/favicon.ico" />
</head>
<body>
	<!-- <div class="right_top">
		<p class="right_top_img">DAY DAY UP</p>
	</div> -->
	<!-- 1366 -->
	<!-- 引用公共头部 -->
	<?php include './include/_nav.php'?>
	<div class="content">
		<p class="downX">★ 更好的web前端体验</p>
		<div class="lessons">
			<?php
			//从数据库获取数据
			$sql = 'select id,slug,name,link,picter,classname from categories;';
			$query = mysqli_query($link, $sql);
			$result1 = mysqli_fetch_all($query, MYSQLI_ASSOC);
			// print_r($result1);
			?>
			
			<!-- 写法1 -->
			<?php //foreach($result1 as $val){
				// echo '<a href=" ' . $val['link'] . ' ">
				// 		<div class="' . $val['classname'] . ' fl">
				// 			<img src=" ' . $val['picter'] . ' ">
				// 			<p>' . $val['name'] . '<span style="color: #acacac">( ? 篇 )</span></p>
				// 		</div>
				// 	</a>';
			//}?>

			<!-- 写法2 -->
			<?php foreach($result1 as $val): ?>
				<a href="lists.php?id=<?php echo $val['id'];?>"> <!-- 发送?id=''的形式以接收 -->
					<div class="<?php echo $val['classname'];?> fl">
						<img src="<?php echo $val['picter'];?>">
						<p><?php echo $val['name'];?><span style="color: #acacac">( ? 篇 )</span></p>
					</div>
				</a>
			<?php endforeach; ?>

		</div>
	</div>
	<!-- 引用公共底部 -->
	<?php include './include/_down.php'?>
	<script src="static/assets/vendors/jquery/jquery-1.12.4.min.js"></script>
	<script src="static/assets/vendors/com.js"></script>
</body>
</html>