<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:68:"/var/www/html/fly/public/../application/index/view/user/message.html";i:1590571079;s:57:"/var/www/html/fly/application/index/view/public/link.html";i:1587621171;s:59:"/var/www/html/fly/application/index/view/public/header.html";i:1589017106;s:59:"/var/www/html/fly/application/index/view/public/footer.html";i:1587624192;}*/ ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>我的消息</title>
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
    <li class="layui-nav-item">
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
    <li class="layui-nav-item layui-this">
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
	  <div class="layui-tab layui-tab-brief" lay-filter="user" id="LAY_msg" style="margin-top: 15px;">
	    <button class="layui-btn layui-btn-danger" onClick="message_delAll(this)" id="LAY_delallmsg">清空全部消息</button>
	    <div  id="LAY_minemsg" style="margin-top: 10px;">
        <!--<div class="fly-none">您暂时没有最新消息</div>-->
        <ul class="mine-msg" id="message">
          <?php if(is_array($message) || $message instanceof \think\Collection || $message instanceof \think\Paginator): $i = 0; $__LIST__ = $message;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['item'] == 'addfriend'): ?>
                <li data-id="123">
                  <blockquote class="layui-elem-quote">
                    <a href="<?php echo url('User/home',['id' => $vo['from_id']]); ?>" target="_blank"><cite><?php echo $vo['username']; ?>：</cite></a><?php echo $vo['content']; ?><a target="_blank" href="/jie/8153.html/page/0/#item-1489505778669"></a>
                    <button type="button" class="layui-btn layui-btn-sm" onClick="friend_agree(this,'<?php echo $vo['id']; ?>')">同意</button>
                    <button type="button" class="layui-btn layui-btn-sm" onClick="friend_refuse(this,'<?php echo $vo['id']; ?>')">拒绝</button>
                  </blockquote>
                  <p><span><?php echo timeFormat($vo['create_time']); ?></span></p>
                </li>
              <?php endif; if($vo['item'] == 'chat'): ?>
          <li data-id="123">
            <blockquote class="layui-elem-quote">
              <a href="<?php echo url('User/home',['id' => $vo['from_id']]); ?>" target="_blank"><cite><?php echo $vo['username']; ?>给您发送消息：</cite></a><?php echo $vo['content']; ?><a target="_blank" href="<?php echo url('chat/index',['tid' => $vo['from_id']]); ?>"><cite>点击查看</cite></a>
            </blockquote>
            <p><span><?php echo timeFormat($vo['create_time']); ?></span><a href="javascript:;" onClick="message_del(this,'<?php echo $vo['id']; ?>')" class="layui-btn layui-btn-small layui-btn-danger fly-delete">删除</a></p>
          </li>
          <?php endif; if($vo['item'] == 'friendgive'): ?>
              <li data-id="123">
                <blockquote class="layui-elem-quote">
                  <a href="<?php echo url('User/home',['id' => $vo['from_id']]); ?>" target="_blank"><cite><?php echo $vo['username']; ?>：</cite></a><?php echo $vo['content']; ?>
                </blockquote>
                <p><span><?php echo timeFormat($vo['create_time']); ?></span><a href="javascript:;" onClick="message_del(this,'<?php echo $vo['id']; ?>')" class="layui-btn layui-btn-small layui-btn-danger fly-delete">删除</a></p>
              </li>
            <?php endif; if($vo['item'] == 'comment'): ?>
                <li data-id="123">
                  <blockquote class="layui-elem-quote">
                    <a href="<?php echo url('User/home',['id' => $vo['from_id']]); ?>" target="_blank"><cite><?php echo $vo['username']; ?>：</cite></a><?php echo $vo['content']; ?><a target="_blank" href="<?php echo url('Jie/detail',['id' => $vo['article_id']]); ?>"><cite><?php echo $vo['article_title']; ?></cite></a>
                  </blockquote>
                  <p><span><?php echo timeFormat($vo['create_time']); ?></span><a href="javascript:;" onClick="message_del(this,'<?php echo $vo['id']; ?>')" class="layui-btn layui-btn-small layui-btn-danger fly-delete">删除</a></p>
                </li>
              <?php endif; if($vo['item'] == 'welcome'): ?>
              <li data-id="123">
                <blockquote class="layui-elem-quote">
                  系统消息：<?php echo $vo['content']; ?>
                </blockquote>
                <p><span><?php echo timeFormat($vo['create_time']); ?></span><a href="javascript:;" onClick="message_del(this,'<?php echo $vo['id']; ?>')" class="layui-btn layui-btn-small layui-btn-danger fly-delete">删除</a></p>
              </li>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
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
  window.onload= function (){
    dot();
  };

  function dot(){
    document.getElementById("dot1").innerHTML = '';
    document.getElementById("dot2").innerHTML = '';
  }


  /*添加好友--同意*/
  function friend_agree(obj,id){
      $.ajax({
        type: 'POST',
        url: "<?php echo url('api/FriendAdd/agree'); ?>",
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
  }

  /*添加好友--拒绝*/
  function friend_refuse(obj,id){
    $.ajax({
      type: 'POST',
      url: "<?php echo url('api/FriendAdd/refuse'); ?>",
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
  }

  /*消息--删除*/
  function message_del(obj,id){
    layer.confirm('确认要删除该消息吗？',function(index) {
      $.ajax({
        type: 'POST',
        url: "<?php echo url('User/del'); ?>",
        dataType: 'json',
        data: {
          id: id
        },
        success: function (data) {
          $(obj).parents("li").remove();
          layer.msg(data.msg, {icon: 1, time: 1000});
        },
        error: function (data) {
          console.log(data.msg);
          layer.closeAll('dialog');
        },
      });
    });
  }

  /*消息--全部删除*/
  function message_delAll(obj){
    layer.confirm('确认要删除全部消息吗？',function(index) {
      $.ajax({
        type: 'POST',
        url: "<?php echo url('User/delAll'); ?>",
        dataType: 'json',
        data: {

        },
        success: function (data) {
          document.getElementById("message").remove();
          layer.msg(data.msg, {icon: 1, time: 1000});
        },
        error: function (data) {
          console.log(data.msg);
          layer.closeAll('dialog');
        },
      });
    });
  }
</script>
</body>
</html>
