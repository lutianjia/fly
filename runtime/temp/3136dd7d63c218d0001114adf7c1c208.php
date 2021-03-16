<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:66:"/var/www/html/fly/public/../application/index/view/user/index.html";i:1589012428;s:57:"/var/www/html/fly/application/index/view/public/link.html";i:1587621171;s:59:"/var/www/html/fly/application/index/view/public/header.html";i:1589017106;s:61:"/var/www/html/fly/application/index/view/public/user-nav.html";i:1588644584;s:59:"/var/www/html/fly/application/index/view/public/footer.html";i:1587624192;}*/ ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>用户中心</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="keywords" content="fly,layui,前端社区">
  <meta name="description" content="Fly社区是模块化前端UI框架Layui的官网社区，致力于为web开发提供强劲动力">
  
<link rel="stylesheet" href="/fly/public/static/res/layui/css/layui.css">
<link rel="stylesheet" href="/fly/public/static/res/css/global.css">
</head>
<body>

<div class="fly-header layui-bg-black">
  <div class="layui-container">
    <a class="fly-logo" href="<?php echo url('Index/index'); ?>">
      <img src="/fly/public/static/res/images/logo.png" alt="layui">
    </a>
    <ul class="layui-nav fly-nav layui-hide-xs">
      <li class="layui-nav-item layui-this">
        <a href="/"><i class="iconfont icon-jiaoliu"></i>交流</a>
      </li>
      <li class="layui-nav-item">
        <a href="case/case.html"><i class="iconfont icon-iconmingxinganli"></i>案例</a>
      </li>
      <li class="layui-nav-item">
        <a href="http://www.layui.com/" target="_blank"><i class="iconfont icon-ui"></i>框架</a>
      </li>
    </ul>
    
    <ul class="layui-nav fly-nav-user">
      <?php if(session('fly.email') == ''): ?>
      <!-- 未登入的状态 -->
      <li class="layui-nav-item">
        <a class="iconfont icon-touxiang layui-hide-xs" href="<?php echo url('Login/login'); ?>"></a>
      </li>
      <li class="layui-nav-item">
        <a href="<?php echo url('Login/login'); ?>">登入</a>
      </li>
      <li class="layui-nav-item">
        <a href="<?php echo url('Register/register'); ?>">注册</a>
      </li>
      <li class="layui-nav-item layui-hide-xs">
        <a href="" onclick="layer.msg('正在通过QQ登入', {icon:16, shade: 0.1, time:0})" title="QQ登入" class="iconfont icon-qq"></a>
      </li>
      <li class="layui-nav-item layui-hide-xs">
        <a href="" onclick="layer.msg('正在通过微博登入', {icon:16, shade: 0.1, time:0})" title="微博登入" class="iconfont icon-weibo"></a>
      </li>
      <?php else: ?>
      <!-- 登入后的状态 -->

      <li class="layui-nav-item">
        <a class="fly-nav-avatar" href="javascript:;">
          <cite class="layui-hide-xs"><?php echo $user['username']; ?></cite>
          <i class="iconfont icon-renzheng layui-hide-xs" title="认证信息：layui 作者"></i>
          <i class="layui-badge fly-badge-vip layui-hide-xs">VIP</i>
          <?php if($user['image'] == ''): ?>
          <img src="http://q9bwlta7s.bkt.clouddn.com/4c79a1758a3a4c0c92c26f8e21dbd888_th.jpg">
          <?php else: if($user['dot'] == '1'): ?>
          <img src="<?php echo $user['image']; ?>"><l id="dot1"><span class="layui-badge-dot"></span></l>
            <?php else: ?>
              <img src="<?php echo $user['image']; ?>">
            <?php endif; endif; ?>
        </a>
        <dl class="layui-nav-child">
          <dd><a href="<?php echo url('User/set'); ?>"><i class="layui-icon">&#xe620;</i>基本设置</a></dd>
          <?php if($user['dot'] == '1'): ?>
          <dd><a href="<?php echo url('User/message'); ?>"><i class="iconfont icon-tongzhi" style="top: 4px;" ></i>我的消息<l id="dot2"><span class="layui-badge-dot" ></span></l></a></dd>
          <?php else: ?>
            <dd><a href="<?php echo url('User/message'); ?>"><i class="iconfont icon-tongzhi" style="top: 4px;"></i>我的消息</a></dd>
          <?php endif; ?>
          <dd><a href="<?php echo url('User/home',['id' => $user['id']]); ?>"><i class="layui-icon" style="margin-left: 2px; font-size: 22px;">&#xe68e;</i>我的主页</a></dd>
          <hr style="margin: 5px 0;">
          <dd><a href="<?php echo url('Logout/logout'); ?>" style="text-align: center;">退出</a></dd>
        </dl>
      </li>
      <?php endif; ?>
      
    </ul>
  </div>
</div>

<script type="text/javascript" src="/fly/public/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/fly/public/static/js/jquery.validate.js"></script>


<div class="layui-container fly-marginTop fly-user-main">
  <ul class="layui-nav layui-nav-tree layui-inline" lay-filter="user">
  <li class="layui-nav-item">
    <a href="<?php echo url('User/home',['id' => $user['id']]); ?>">
      <i class="layui-icon">&#xe609;</i>
      我的主页
    </a>
  </li>
  <li class="layui-nav-item layui-this">
    <a href="<?php echo url('User/index'); ?>">
      <i class="layui-icon">&#xe612;</i>
      用户中心
    </a>
  </li>
  <li class="layui-nav-item">
    <a href="<?php echo url('User/set'); ?>">
      <i class="layui-icon">&#xe620;</i>
      基本设置
    </a>
  </li>
  <li class="layui-nav-item">
    <a href="<?php echo url('User/message'); ?>">
      <i class="layui-icon">&#xe611;</i>
      我的消息
    </a>
  </li>
</ul>

<div class="site-tree-mobile layui-hide">
  <i class="layui-icon">&#xe602;</i>
</div>
<div class="site-mobile-shade"></div>

<div class="site-tree-mobile layui-hide">
  <i class="layui-icon">&#xe602;</i>
</div>
<div class="site-mobile-shade"></div>
  
  
  <div class="fly-panel fly-panel-user" pad20>
    <?php if($user['status'] != '1'): ?>
      <div class="fly-msg" style="margin-top: 15px;">
        您的邮箱尚未验证，这比较影响您的帐号安全，<a href="activate.html">立即去激活？</a>
      </div>
    <?php endif; ?>
    <div class="layui-tab layui-tab-brief" lay-filter="user">
      <ul class="layui-tab-title" id="LAY_mine">
        <li data-type="mine-jie" lay-id="index" class="layui-this">我发的帖（<span><?php echo $count; ?></span>）</li>
        <li data-type="collection" data-url="/collection/find/" lay-id="collection">我收藏的帖（<span><?php echo $collect_count; ?></span>）</li>
      </ul>
      <div class="layui-tab-content" style="padding: 20px 0;">
        <div class="layui-tab-item layui-show">
          <ul class="mine-view jie-row">
            <?php if(is_array($index) || $index instanceof \think\Collection || $index instanceof \think\Paginator): $i = 0; $__LIST__ = $index;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
              <li>
                <a class="jie-title" href="<?php echo url('Jie/detail',['id' => $vo['id']]); ?>" id="<?php echo $vo['id']; ?>" target="_blank"><?php echo $vo['title']; ?></a>
                <i><?php echo timeFormat($vo['create_time']); ?></i>
                <?php if($vo['status'] == '0'): ?>
                <i class="mine-edit layui-bg-red">审核中</i>
                <?php elseif($vo['status'] == '1'): ?>
                <i class="mine-edit">已上架</i>
                <?php endif; ?>
                <a class="mine-edit layui-bg-blue" href="<?php echo url('Jie/add',['id' => $vo['id']]); ?>">编辑</a>
                <a class="mine-edit layui-bg-black" onClick="article_del(this,'<?php echo $vo['id']; ?>')" href="javascript:;">删除</a>
                <em><?php echo $vo['read_count']; ?>阅/<?php echo $vo['comment_count']; ?>答</em>
              </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
          <div id="LAY_page"></div>
        </div>
        <div class="layui-tab-item">
          <ul class="mine-view jie-row">
            <?php if(is_array($collect_jie) || $collect_jie instanceof \think\Collection || $collect_jie instanceof \think\Paginator): $i = 0; $__LIST__ = $collect_jie;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
              <li>
                <a class="jie-title" href="<?php echo url('Jie/detail',['id' => $vo['id']]); ?>" target="_blank"><?php echo $vo['title']; ?></a>
                <i><?php echo timeFormat($vo['create_time']); ?>收藏</i>
              </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
          </ul>
          <div id="LAY_page1"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="fly-footer">
  <p><a href="http://fly.layui.com/" target="_blank">Fly社区</a> 2017 &copy; <a href="http://www.layui.com/" target="_blank">layui.com 出品</a></p>
  <p>
    <a href="http://fly.layui.com/jie/3147/" target="_blank">付费计划</a>
    <a href="http://www.layui.com/template/fly/" target="_blank">获取Fly社区模版</a>
    <a href="http://fly.layui.com/jie/2461/" target="_blank">微信公众号</a>
  </p>
</div>

<script src="/fly/public/static/res/layui/layui.js"></script>
<script type="text/javascript" src="/fly/public/static/js/common.js"></script>
<script>
layui.cache.page = '';
layui.cache.user = {
  username: '游客'
  ,uid: -1
  ,avatar: '../res/images/avatar/00.jpg'
  ,experience: 83
  ,sex: '男'
};
layui.config({
  version: "3.0.0"
  ,base: '/fly/public/static/res/mods/'  //这里实际使用时，建议改成绝对路径
}).extend({
  fly: 'index'
}).use('fly');
</script>
<script type="text/javascript">
  /*帖子-删除*/
  function article_del(obj,id){
    layer.confirm('确认要删除吗？',function(index){
      $.ajax({
        type: 'POST',
        url: "<?php echo url('Jie/delete'); ?>",
        dataType: 'json',
        data:{
          id:id
        },
        success: function(data){
          $(obj).parents("li").remove();

          layer.msg(data.msg,{icon:1,time:1000});
        },
        error:function(data) {
          console.log(data.msg);
          layer.closeAll('dialog');
        },
      });
    });
  }
</script>
</body>
</html>