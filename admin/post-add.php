<?php 

  $page = 'post-add';

  // 访问后台页面时,需要对当前用户的登陆状态进行检测,可以从session中判断是否存在login_status的值为success
  session_start();

  if (isset($_SESSION['login_status']) && $_SESSION['login_status'] === 'success') {
    echo '可以访问';
  } else {
    echo '禁止访问,跳转到登陆页';

    // 为了增强用户体验,可以将本页面的路径信息保存在session中,在一会儿登陆页面登陆成功后,跳转到session中保存的对应页面即可
    //  - $_SERVER['PHP_SELF'] - 可以获取到本页面的路径信息
    $_SESSION['current_path'] = $_SERVER['PHP_SELF'];

    // 没有登陆,自动跳转到登陆页
    header('Location:./login.php');
  }
  
 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../static/assets/css/admin.css">
  <script src="../static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include './include/_nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>IN.com写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row" id="form" action="/IN.com/admin/api/_postsadd.php" method="POST">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">标题</label>
            <textarea id="content" class="form-control input-lg" name="content" cols="30" rows="10" placeholder="内容"></textarea>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            <p class="help-block">https://zce.me/post/<strong>slug</strong></p>
          </div>
          <div class="form-group">
            <label for="content_from">转载自</label>
            <input id="content_from" class="form-control" name="content_from" type="text" placeholder="转载自/作者">
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
              <!-- 从服务端获取数据动态添加分类 -->
              
              <!-- <option value="1">未分类</option>
              <option value="2">潮生活</option> -->
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <option value="drafted">草稿</option>
              <option value="published">已发布</option>
              <option value="published">已删除</option>
            </select>
          </div>
          <div class="form-group">
            <!-- <button class="btn btn-primary" type="submit">保存</button> -->
            <span class="btn btn-primary" id="btn">提交</span>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- 用于引入侧边栏部分的区域 -->
  <?php include './include/_slide.php';?>

  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <!-- 富文本框操作--下载引入 -->
  <script src="../static/assets/vendors/ckeditor/ckeditor.js"></script>
  <link rel="stylesheet" href="../static/assets/vendors/ckeditor/contents.css">
  <script>
    //文本域操作
    CKEDITOR.replace('content');

    //提交操作
    var $form = $('#form');
    var $category = $('#category');
    //请求数据进行分类创建
    $.ajax({
      url : '/IN.com/admin/api/_cate.php',
      success : function(datas){
        var str = '';
        $.each(datas, function(i, ele){
          str += ' <option value = " ' + ele.id + ' ">' + ele.name + '</option> ';
          $category.html(str);
        });
      },
      dataType : 'json'
    })

    //检测输入内容是否为空（未写）
    

    //提交发送
    $('#btn').on('click', function(){
      //如果操作的元素只有一个，则不需要遍历，只需要CKEDITOR.instances['ID'].updateElement();
      for (var k in CKEDITOR.instances){
        CKEDITOR.instances[k].updateElement();
      }
      //表单内含图片文件，所以用POST
      //使用FromData处理
      var fd = new FormData($form[0]);
      $.ajax({
        type : 'POST',
        url : '/IN.com/admin/api/_postsadd.php',
        data : fd,
        //使用FormData时，必须设置processData : false与contentType : false
        processData : false,
        contentType : false,
        success : function(datas){
          // console.log(datas);
          if (datas === '成功') {
            //成功 - 跳转所有文章页
            location.href = '/IN.com/admin/posts.php';
          }else{
            alert('网络错误！');
          }
        }
      })
    })
    
  </script>
</body>
</html>
