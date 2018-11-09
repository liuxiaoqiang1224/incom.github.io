<?php
	//引用config.php文件
	require_once './config.php';
	// echo INCOM;
	//数据库连接
	$link = mysqli_connect(INCOM, USERNAME, PASSWORD, INCOM_NAME);
	//从数据库获取数据
	$sql = 'select id,slug,name,link,picter,classname from categories;';
	$query = mysqli_query($link, $sql);
	$result1 = mysqli_fetch_all($query, MYSQLI_ASSOC);
	// print_r($result1);
?>
<div class="tbody">
		<!-- 1200 -->
		<div class="topnav w">
			<div class="logo fl">
				<a href="index.html" target="_blank"><h1><img src="static/uploads/logo.png" alt="更好的web体验"></h1></a>
			</div>
			<div class="nav fl">
				<ul>
					<li><a href="./index.php" target="_blank">首页</a></li>

					<!-- 这个跟随分类树一起创建的在导航栏上的分类，为了防止导航栏分类向右变多使其它内容挤出去 -->
					<?php //foreach ($result1 as $val): ?>
						<!-- <li><a href="lists.php?id=<?php //echo $val['id'];?>" target="_blank"><?php //echo $val['name'];?></a></li> -->
					<?php //endforeach;?>



					
					<!-- <li><a href="index.html" target="_blank">首页</a></li> -->
					
					<li><a href="https://share.weiyun.com/5CfMiQa" target="_blank">编辑器选择</a></li>
					<li><a href="https://www.chuangkit.com/" target="_blank">图像在线</a></li>
					<li><a href="https://share.weiyun.com/5EKXcB0" target="_blank">推荐书籍</a></li>
				</ul>
			</div>
			<div class="self_link fl">
				<div class="qqicon fl">
					<a href="http://sighttp.qq.com/msgrd?v=1&uin=1247867397" target="_blank"><img src="static/uploads/qq.png" width="30" title="点击开始跟我聊天！"></a>
				</div>
				<div class="github fl">
					<a href="https://github.com/liuxiaoqiang1224" target="_blank"><img src="static/uploads/github-circle.png" width="30" title="欢迎访问！"></a>
				</div>
				<div class="sina fl">
					<a href="https://weibo.com/yueyabai123/profile?rightmod=1&wvr=6&mod=personinfo" target="_blank"><img src="static/uploads/sina.png" width="25" title="点击关注我哟~"></a>
				</div>
				<div class="email fl">
					<a href="mailto:yueyabai123@126.com" target="_blank"><img src="static/uploads/email.png" width="30" title="地点发送邮件给我！"></a>
				</div>
			</div>
			<div class="search fr">
				<input type="text" maxlength="16" placeholder="去发现吧！想要的所有！" id="search_input">
				<img src="static/uploads/search.png" id="search_img" alt="">
			</div>
		</div>
	</div>