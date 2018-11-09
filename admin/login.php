<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="/IN.com/static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/IN.com/static/assets/css/admin.css">
  <link rel="stylesheet" href="/IN.com/static/assets/vendors/nprogress/nprogress.css">
  <script src="/IN.com/static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <div class="login">
    <form class="login-wrap" id="form">
      <img class="avatar" src="/IN.com/static/assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong> 用户名或密码错误！
      </div> -->
      <div id="errorBox" class="alert alert-danger" style="display: none;">
        <strong>错误！</strong> 用户名或密码错误！
      </div>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" type="text" name="email" class="form-control" placeholder="邮箱" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" name="password" type="password" class="form-control" placeholder="密码">
      </div>
      <!-- 以前href是个html页面的跳转操作,现在需要使用ajax操作,将href修改为空连接 -->
      <a id="login" class="btn btn-primary btn-block" href="javascript:;">登 录</a>
    </form>
  </div>
  <script src="/IN.com/static/assets/vendors/jquery/jquery.js"></script>
  <script>
    // 获取元素
    var $email = $('#email');
    var $password = $('#password');
    var $errorBox = $('#errorBox');
    var $form = $('#form');

    // 1 点击登录按钮进行数据检测和提交操作
    $('#login').on('click', function () {
      // 2 进行两个输入框的内容验证
      //  - 对邮箱输入框进行正则验证操作
      if (!/^\w{1,20}@\w+\.\w+$/.test($email.val())) {
        // 如果匹配失败,阻止后续的提交操作,显示错误提示信息
        $errorBox.show().children('strong').text('用户名不符合规则!');
        return;
      }
      // 密码检测
      if (!/^[a-zA-Z0-9_.*]{1,20}$/.test($password.val())) {
         $errorBox.show().children('strong').text('密码不符合规则!');
        return;
      }

      // 将数据发送给服务端进行检测
      $.ajax({
        type : 'POST',
        url : '/IN.com/admin/api/_login.php',
        data : $form.serialize(),
        success : function (datas) {
          // 对检测结果进行判断
          if (datas.status === '成功') {
            //  - 如果成功,跳转到可能存在的指定页面  
            //     - 检测datas.path属性是具体的路径还是空字符串
            //        - 如果没有,跳转到首页
            location.href = datas.path ? datas.path : '/IN.com//admin/index.php';
          } else {
            //  - 如果失败,进行错误提示
            $errorBox.show().children('strong').text('用户名或密码错误!');
          }
        },
        dataType : 'json'
      });
    });

    // 3 当用户名和密码输入框获取焦点时,将错误提示框隐藏
    $form.find('input').on('focus', function () {
      $errorBox.hide();
    });



  </script>
</body>
</html>
