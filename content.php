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
	<link rel="stylesheet" href="static/assets/css/common.css">
	<link rel="shortcut icon" href="static/uploads/favicon.ico" />
	<link rel="stylesheet" href="static/assets/css/content.css">
</head>
<body>
	<script>NProgress.start()</script>
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
				<a href="index.html" target="_blank">主页</a> / 
				<a href="lists.html" target="_blank">H5C3</a> / 
				<a href="#">文章标题</a>
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
			<p>== 文章详情 ==</p>
				<?php
					$id = $_GET['id'];
					if (isset($_GET['id']) === false) {
						header('Location:404.html');
					}
					$sql = "select posts.title,categories.id,users.id as userid,posts.created,posts.content,posts.views,posts.likes,categories.name,users.nickname from posts
							inner join users on posts.user_id=users.id
							inner join categories on posts.category_id=categories.id
							where posts.id=$id;";
					$query = mysqli_query($link, $sql);
					$result = mysqli_fetch_all($query, MYSQLI_ASSOC)[0];
					// print_r($result);
					//评论数？？？
					
				?>	
				<div class="thisNew">
					<p class="thisNew_title"><?php echo $result['title'];?></p>
					<p class="thisNew_from"><span>文章分类：</span><a href="./lists.php?id=<?php echo $result['id']?>"><?php echo $result['name'];?></a></p>
					<p class="thisNew_author"><?php echo $result['nickname'];?></p>
					<p class="thisNew_date"><?php echo $result['created'];?></p>
					<p class="thisNew_content">   <?php echo $result['content'];?></p>
					<div class="share_fabulous">
						<img src="static/uploads/share.png" alt="转发"><span>（<?php echo $result['views'];?>）</span>
						<img src="static/uploads/fabulous.png" alt="点赞"><span>（<?php echo $result['likes'];?>）</span>
						
						<img src="static/uploads/pl.png" alt="评论"><span>（<?php echo $result['id'];?>）</span>  <!-- 根据文章id获取该id文章下的评论数？？？ -->
					</div>
				</div>
			


			<!-- <div class="thisNew">
				<p class="thisNew_title">.CoM -- 提供更好的web前端体验</p>
				<p class="thisNew_from"><span>文章分类：</span><a href="lists.html">HTML5/CSS3</a></p>
				<p class="thisNew_author">管理员</p>
				<p class="thisNew_date">2017-07-01 08:08:00</p>
				<p class="thisNew_content">   在这个信息爆炸的时代，相信每个人都无时无刻不陶醉在互联网的海洋之中，生活中与我们接触最多的就是各种千奇百怪的网站了把！当你看到各种网站上眼花缭乱的效果的时候，有木有被震撼？有木有想亲手做一下呢？俗话说好奇心害死猫啊。博主就是这样入了前端的坑，不知不觉已一十又五天；没错zhen博主入坑了，博主并不是计算机专业的aaa!博主是一只名副其实的电气狗，从单片机开始走到了前端！好了好了废话少说直接进入正题！   博主在学习了十五天之后呢，注备开始仿造一些网站了！博主还在念书，无疑学校官网是比较熟悉的！于是今天就给小伙伴们带来了这样一片文章！--新手web前端第一个网站！博主相信，小伙伴们在做出第一个网站的时候肯定是异常兴奋的！那种成就感是无与伦比的！</p>
				<p class="now_from"> -- 转载自CSDN</p>
				<div class="share_fabulous">
					<img src="static/uploads/share.png" alt="转发"><span>（214）</span>
					<img src="static/uploads/fabulous.png" alt="点赞"><span>（523）</span>
				</div>
			</div> -->



			<div class="clearfloat"></div>
			<!-- 评论区 -->
			<div class="comment_info">
				<textarea name="" id="text" rows="3" placeholder="由于暂时没有匹配数据库，评论功能暂时无法使用，请耐心等待哟~ 马上上线！！！"></textarea>
				<a href="javascript:;">
					<div class="comment_top">
						<p id="btnPL">我来说一句</p>
					</div>
				</a>
			</div>
			<div class="opt_content">
					<a href="javascript:;"><p>上一篇：</p></a>
					<a href="javascript:;"><p>下一篇：</p></a>
				</div>
			<ul id="ul"></ul>
		</div>


		<!-- 内容页广告 -->
		<div class="banner">
			<div class="closeit">
				<p class="close" title="点击移除所有广告">X</p>
			</div>	
			<div class="banner_01">
				<a href="http://www.sosopng.com" title="免费 矢量 高清 图库 下载" target="_blank"><img src="static/uploads/banner1.png" alt=""></a>
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
	<script>NProgress.done()</script>
</body>
</html>