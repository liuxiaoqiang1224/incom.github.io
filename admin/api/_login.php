<?php 
	// 引入配置文件
	require_once '../../config.php';

	// 1 检测是否传递了参数
	if (!isset($_POST['email']) || !isset($_POST['password'])) {
		echo '失败';
		return;
	}

	// 2 接收请求参数
	$email = $_POST['email'];
	$password = $_POST['password'];

	// 3 检测是否存在用户名和密码
	$link = mysqli_connect(INCOM, USERNAME, PASSWORD, INCOM_NAME);
	$sql = "select * from users where email='$email' and password='$password';";
	$query = mysqli_query($link, $sql);

	// 4 检测结果中是否存在1条数据
	$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
	
	if (count($result) === 1) {
		// echo '成功';
		// 登陆成功时,不仅需要响应成功的信息,还需要保存登陆的状态,以便其他后台页面检测
		//  - 开启session
		session_start();
		//  - 保存登陆成功的标识:不要纠结标识的内容,这不重要
		$_SESSION['login_status'] = 'success';

		//  - 检测session中是否存在current_path,如果有,取出后响应给客户端
		$path = '';
		if (isset($_SESSION['current_path'])) {
			$path = $_SESSION['current_path'];
		}

		//  - 由于响应的数据可能具有两个部分,修改为数据接口的响应方式
		echo '{"status":"成功","path":"' . $path . '"}';

	} else {
		echo '{"status":"失败","path":""}';
	}



?>