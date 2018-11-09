<?php 

  $page = 'categories';

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
  <title>Categories &laquo; Admin</title>
  <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../static/assets/css/admin.css">
  <script src="../static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>  
  <script>NProgress.start()</script>

  <div class="main">
    <!-- 用于引入顶部导航部分的区域 -->
    <?php include './include/_nav.php';?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>IN.COM 分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form>
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <label for="feature">特色图像</label>
              <!-- show when image chose -->
              <img class="help-block thumbnail" style="display: none">
              <input id="feature" class="form-control" name="feature" type="file">
            </div>
            <div class="form-group">
              <!-- <button class="btn btn-primary" type="submit">添加</button> -->
              <span class="btn btn-primary">添加</span>
              <span class="btn btn-primary" id="edit" style="display: none">编辑</span>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a id="btn_delect" class="btn btn-danger btn-sm" href="javascript:;" style="display: none;position: absolute;top:-30px;">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox" id="selectAll"></th>
                <th>名称</th>
                <th>Slug</th>
                <th>图像</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody id="tbody">
              <!-- <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td><img src="../static/uploads/html5.png" alt="" style="width: 20px"></td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td><img src="../static/uploads/html5.png" alt="" style="width: 20px"></td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td><img src="../static/uploads/html5.png" alt="" style="width: 20px"></td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- 用于引入侧边栏部分的区域 -->
  <?php include './include/_slide.php';?>

  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script>
    $.ajax({
      type : 'GET',
      url : '/IN.com/admin/api/_cate.php',
      contentType: 'application/json',
      dataType : 'json', 
      contentType:"application/x-www-form-urlencoded;charset=UTF-8",
      success : function(datas){
        // console.log(datas);
        // 根据数据创建结构
        var str = '';
        $.each(datas, function(i, ele){
          str += '<tr>\
                    <td class="text-center"><input type="checkbox" data-id="' + ele.id + '"></td>\
                    <td>' + ele.name + '</td>\
                    <td>' + ele.slug + '</td>\
                    <td><img src=".' + ele.picter + '" alt="" style="width: 20px"></td>\
                    <td class="text-center">\
                      <a href="javascript:;" class="btn btn-info btn-xs cate-edit" data-id="' + ele.id + '">编辑</a>\
                      <a href="javascript:;" class="btn btn-danger btn-xs cate-del" data-id="' + ele.id + '">删除</a>\
                    </td>\
                 </tr>'
        });
        $('#tbody').append(str);
      },
      //检测错误信息使用
      error : function (XMLHttpRequest, textStatus, errorThrown) {
        // console.log(textStatus);
        // console.log(XMLHttpRequest.status);
        // console.log(XMLHttpRequest.readyState);
      }
    });
    $('#tbody').on('click', 'a.cate-del', function(){
      //删除cate-del.php -- 后台删除一条数据
      var id = $(this).data('id');
      var $tr = $(this).parents('tr');
      $.ajax({
        url : '/IN.com/admin/api/cate-del.php',
        data : {id : id},
        success : function(datas){
          // console.log(datas);
          if (datas === '成功') {
            $tr.remove();
          }else{
            alert('删除失败！请稍后再试');
          }
        }
      });
    });

    // 批量删除
    //-1-全选按钮
    var $selectAll = $('#selectAll');//全选按钮
    var $btn_delect = $('#btn_delect');//批量删除
    $selectAll.on('change', function(){
      //设置为数据操作形式，为下面相同
      idArr = [];
      var $cbs = $('tbody input');
      $cbs.prop('checked', $(this).prop('checked'));//批量按钮的状态
      //遍历操作，设置批量按钮的显示与隐藏
      if ($(this).prop('checked')) {
        $cbs.each(function(i, ele){
          idArr.push($(ele).data('id'));
        });
        $btn_delect.stop().fadeIn();
      }else{
        $btn_delect.stop().hide();
      };
                 
                  // var cbs = $('tbody input');
                  // //保存选框的选中状态
                  // var bool = $(this).prop('checked');
                  // //prop用于操作自带属性
                  // cbs.prop('checked',bool);
                  // //有勾选的时候  批量删除按钮显示
                  // bool ? $btn_delect.stop().fadeIn() : $btn_delect.stop().hide();
    });


    var idArr = [];
    $('#tbody').on('change', 'input', function(){
      if ($(this).prop('checked')) {
        var id = $(this).data('id');
        //创建结构时创建data-id
        idArr.push(id);
      }else{
        //取消勾选清除对应id
        idArr.splice(idArr.indexOf(id),1);
      }
        // console.log(idArr);
      //设置批量按钮的显示与隐藏
      idArr.length > 0 ? $btn_delect.stop().fadeIn() : $btn_delect.stop().hide();
      //设置全选按钮的状态
      var bool = idArr.length === $('tbody input').length;
      $selectAll.prop('checked', bool);
    });

                  // //底部选框与全选框状态
                  // $('#tbody').on('change', 'input', function(){
                  //   //获取选中个数
                  //   var $once = $('tbody input:checked').length;
                  //   // console.log($once);//打印点击选中的个数
                  //   //获取全部个数ncqm  
                  //   var $all = $('tbody input').length;
                  //   //如果有选中，批量按钮显示
                      
                  //   $once > 0 ? $btn_delect.show() : $btn_delect.hide();
                  //   //判断个数是否相等
                  //   var bool = $once === $all;
                  //   $selectAll.prop('checked', bool);
                  // })

    //批量删除按钮生效操作
    $btn_delect.on('click', function(){
      $.ajax({
        url : '/IN.com/admin/api/cate-del.php',
        data : {id : idArr.join()},
        success : function(datas){
          console.log(datas);
          if (datas === '成功') {
            $('tbody input:checked').parents('tr').remove();//删除被选中的框
            idArr = [];//清除删除后数组内被删除的数据
          }else{
            alert('删除失败！请稍后再试');
          }
        }
      });
    });



    //添加功能
    //因为添加的内容中含有图片文件，暂时不写
    


    //编辑功能
    //因为添加的内容中含有图片文件，暂时不写
  


  </script>
</body>
</html>
