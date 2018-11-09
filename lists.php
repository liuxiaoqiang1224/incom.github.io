<?php
	//引用config.php文件
	require_once './config.php';
	// echo INCOM;
	//数据库连接
	$link = mysqli_connect(INCOM, USERNAME, PASSWORD, INCOM_NAME);
	// 跳转
	// 接收GET请求参数 并判断是否有该id
	if (isset($_GET['id']) === false) {
		//没有的时候跳转首页
		header('Location:404.php');
	}
	//正常操作,接收id参数请求数据页面
	$id = $_GET['id'];
	$sql = "select name from categories where id=$id;";
	$query = mysqli_query($link, $sql);
	//直接获取到分类名称
	$content_name = mysqli_fetch_all($query, MYSQLI_ASSOC)[0]['name'];
	// print_r($content_name);
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>.COM -- 更好的web前端体验</title>
	<link rel="stylesheet" href="static/assets/css/common.css">
	<link rel="shortcut icon" href="static/uploads/favicon.ico" />
	<link rel="stylesheet" href="static/assets/css/lists.css">
	<link rel="stylesheet" href="static/assets/css/content.css">
</head>
<body>
	<!-- 右下角 -->
	<div class="right_top">
		<p class="right_top_img">UP</p>
	</div>
	<!-- 顶部 -->
	<!-- 引用公共头部 -->
	<?php include './include/_nav.php'?>
	<div class="on_content">
		<!-- 内容页导航 -->
		<div class="map">
			<p>
				<?php
					$sql3 = 'select id,name,slug from categories';
					$query3 = mysqli_query($link, $sql3);
					$result3 = mysqli_fetch_all($query3, MYSQLI_ASSOC)[$id-1];
					// print_r($result3);
				?>
				<a href="index.php" target="_blank">主页</a> / <a href="lists.php?id=<?php echo $result3['id'];?>" target="_blank"> <?php echo $result3['name'];?></a>
			</p>
		</div>
		<div class="downX">
			
		</div>
		<!-- 内容页标题 -->
		<div class="top_img_title">
			<img src="static/uploads/C++.png" alt="">
			<h2 class="top_img_title_h2" title="更好的web前端体验">更好的web前端体验</h2>
		</div>
		<!-- 内容页博文列表 -->
		<div class="content_lists">
			<p>== <?php echo $content_name;?> 知识列表（热门排序） ==</p>
			
			<?php
			//文章列表获取
				$sql2 = "select * from posts where category_id=$id limit 10;";
				$query2 = mysqli_query($link, $sql2);
				$posts = mysqli_fetch_all($query2, MYSQLI_ASSOC);
				// print_r($posts);
			?>
			<?php foreach($posts as $val):?>
				<a href="./content.php?id=<?php echo $val['id'];?>" target="_blank">
					<div class="<?php echo $val['class'];?>">
						<p><?php echo $val['title'];?></p>
					</div>
				</a>
			<?php endforeach;?>



		</div>
		<!-- 内容页广告 -->
		<div class="banner">
			<div class="closeit">
				<p class="close" title="点击移除所有广告">X</p>
			</div>	
			<div class="banner_01">
				<a href="http://www.sosopng.com" title="免费 矢量 高清 图库 下载"><img src="static/uploads/banner1.png" alt=""></a>
			</div>
		</div>
	</div>
	<!-- 清除浮动 -->
	<div class="clearfloat"></div>
	<!-- 内容页底部 -->
	<!-- 引用公共底部 -->
	<?php include './include/_down.php'?>
	<script src="static/assets/vendors/jquery/jquery-1.12.4.min.js"></script>
	<script src="static/assets/vendors/com.js"></script>
</body>
</html>