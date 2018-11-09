  <div class="aside">
    <div class="profile">
      <img class="avatar" src="../static/uploads/avatar.jpg">
      <h3 class="name">BUG 7</h3>
    </div>
    <ul class="nav">
      <li class="<?php echo $page === 'index' ? 'active' : '';?>">
        <a href="index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <!-- 展开处理 -->
      <!-- 指定判断规则 -->
      <?php
        $posts = ['posts', 'post-add', 'categories'];
      ?>
      <li class="<?php echo in_array($page, $posts) ? 'active' : '';?>">
        <a href="#menu-posts" data-toggle="collapse" class="<?php echo in_array($page, $posts) ? '' : 'collapsed';?>">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse <?php echo in_array($page, $posts) ? 'in' : '';?>">
          <li class="<?php echo $page === 'posts' ? 'active' : '';?>"><a href="posts.php">所有文章</a></li>
          <li class="<?php echo $page === 'post-add' ? 'active' : '';?>"><a href="post-add.php">写文章</a></li>
          <li class="<?php echo $page === 'categories' ? 'active' : '';?>"><a href="categories.php">分类目录</a></li>
        </ul>
      </li>
      <li class="<?php echo $page === 'comments' ? 'active' : '';?>">
        <a href="comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li class="<?php echo $page === 'users' ? 'active' : '';?>">
        <a href="users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <?php
        $menus = ['nav-menus', 'slides', 'settings'];
      ?>
      <li class="<?php echo in_array($page, $menus) ? 'active' : '';?>">
        <a href="#menu-settings" class="<?php echo in_array($page, $menus) ? '' : 'collapsed';?>" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse <?php echo in_array($page, $menus) ? 'in' : '';?>">
          <li class="<?php echo $page === 'nav-menus' ? 'active' : '';?>"><a href="nav-menus.php">导航菜单</a></li>
          <li class="<?php echo $page === 'slides' ? 'active' : '';?>"><a href="slides.php">图片轮播</a></li>
          <li class="<?php echo $page === 'settings' ? 'active' : '';?>"><a href="settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>
  </div>