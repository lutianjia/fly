<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:66:"/var/www/html/fly/public/../application/index/view/jie/detail.html";i:1590584983;s:57:"/var/www/html/fly/application/index/view/public/link.html";i:1587621171;s:59:"/var/www/html/fly/application/index/view/public/header.html";i:1589017106;s:59:"/var/www/html/fly/application/index/view/public/footer.html";i:1587624192;}*/ ?>
 
 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Fly Template v3.0，基于 layui 的极简社区页面模版</title>
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


<div class="layui-hide-xs">
  <div class="fly-panel fly-column">
    <div class="layui-container">
      <ul class="layui-clear">
        <li class="layui-hide-xs"><a href="<?php echo url('Index/index'); ?>">首页</a></li>
        <?php if($detail['class'] == '0'): ?>
        <li class="layui-this"><a href="<?php echo url('Jie/index',['type' => 'ti']); ?>">提问</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'fen']); ?>">分享</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'tao']); ?>">讨论</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'jian']); ?>">建议</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'gong']); ?>">公告</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'dong']); ?>">动态</a></li>
        <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><span class="fly-mid"></span></li> 
        <?php endif; if($detail['class'] == '99'): ?>
        <li><a href="<?php echo url('Jie/index',['type' => 'ti']); ?>">提问</a></li>
        <li class="layui-this"><a href="<?php echo url('Jie/index',['type' => 'fen']); ?>">分享</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'tao']); ?>">讨论</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'jian']); ?>">建议</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'gong']); ?>">公告</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'dong']); ?>">动态</a></li>
        <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><span class="fly-mid"></span></li>
        <?php endif; if($detail['class'] == '100'): ?>
        <li><a href="<?php echo url('Jie/index',['type' => 'ti']); ?>">提问</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'fen']); ?>">分享</a></li>
        <li class="layui-this"><a href="<?php echo url('Jie/index',['type' => 'tao']); ?>">讨论</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'jian']); ?>">建议</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'gong']); ?>">公告</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'dong']); ?>">动态</a></li>
        <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><span class="fly-mid"></span></li>
        <?php endif; if($detail['class'] == '101'): ?>
        <li><a href="<?php echo url('Jie/index',['type' => 'ti']); ?>">提问</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'fen']); ?>">分享</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'tao']); ?>">讨论</a></li>
        <li class="layui-this"><a href="<?php echo url('Jie/index',['type' => 'jian']); ?>">建议</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'gong']); ?>">公告</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'dong']); ?>">动态</a></li>
        <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><span class="fly-mid"></span></li>
        <?php endif; if($detail['class'] == '168'): ?>
        <li><a href="<?php echo url('Jie/index',['type' => 'ti']); ?>">提问</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'fen']); ?>">分享</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'tao']); ?>">讨论</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'jian']); ?>">建议</a></li>
        <li class="layui-this"><a href="<?php echo url('Jie/index',['type' => 'gong']); ?>">公告</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'dong']); ?>">动态</a></li>
        <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><span class="fly-mid"></span></li>
        <?php endif; if($detail['class'] == '169'): ?>
        <li><a href="<?php echo url('Jie/index',['type' => 'ti']); ?>">提问</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'fen']); ?>">分享</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'tao']); ?>">讨论</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'jian']); ?>">建议</a></li>
        <li><a href="<?php echo url('Jie/index',['type' => 'gong']); ?>">公告</a></li>
        <li class="layui-this"><a href="<?php echo url('Jie/index',['type' => 'dong']); ?>">动态</a></li>
        <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><span class="fly-mid"></span></li>
        <?php endif; ?>

        <!-- 用户登入后显示 -->
        <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><a href="<?php echo url('user/index'); ?>">我发表的贴</a></li>
        <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><a href="<?php echo url('user/index#collection'); ?>">我收藏的贴</a></li>
      </ul> 
      
      <div class="fly-column-right layui-hide-xs"> 
        <span class="fly-search"><i class="layui-icon"></i></span> 
        <a href="<?php echo url('Jie/add'); ?>" class="layui-btn">发表新帖</a>
      </div> 
      <div class="layui-hide-sm layui-show-xs-block" style="margin-top: -10px; padding-bottom: 10px; text-align: center;"> 
        <a href="add.html" class="layui-btn">发表新帖</a> 
      </div> 
    </div>
  </div>
</div>

<div class="layui-container">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md8 content detail">
      <div class="fly-panel detail-box">
        <h1><?php echo $detail['title']; ?></h1>
        <div class="fly-detail-info">
          <!-- <span class="layui-badge">审核中</span> -->
          <span class="layui-badge layui-bg-green fly-detail-column">动态</span>
          
          <span class="layui-badge" style="background-color: #999;">未结</span>
          <!-- <span class="layui-badge" style="background-color: #5FB878;">已结</span> -->
          <?php if($detail['is_head_figure'] == '1'): ?>
          <span class="layui-badge layui-bg-black">置顶</span>
          <?php endif; if($detail['read_count'] > '200'): ?>
          <span class="layui-badge layui-bg-red">精帖</span>
          <?php endif; ?>

          <span class="fly-list-nums" id="change">
            <a href="#comment"><i class="iconfont" title="回答">&#xe60c;</i> <?php echo $detail['comment_count']; ?></a>
            <i class="iconfont" title="人气">&#xe60b;</i> <?php echo $read_count; if($user['username'] != ''): if($detail['user_id'] != $user['id']): if($collect['username'] != $user['username']): ?>
                <a href="#"><i class="layui-icon" title="收藏" onclick="collect(this,'<?php echo $detail['id']; ?>')">&#xe600;</i>    <?php echo $detail['collect_count']; ?></a>
              <?php else: ?>
                <a href="#"><i class="layui-icon" title="收藏" onclick="nocollect(this,'<?php echo $detail['id']; ?>')">&#xe658;</i>    <?php echo $detail['collect_count']; ?></a>
              <?php endif; endif; endif; ?>
          </span>
        </div>
        <div class="detail-about">
          <a class="fly-avatar" href="<?php echo url('User/home',['id' => $detail['user_id']]); ?>">
            <img src="<?php echo $detail['image']; ?>" alt="贤心">
          </a>
          <div class="fly-detail-user">
            <a href="<?php echo url('User/home',['id' => $detail['user_id']]); ?>" class="fly-link">
              <cite><?php echo $detail['username']; ?></cite>
              <i class="iconfont icon-renzheng" title="认证信息：{{ rows.user.approve }}"></i>
              <i class="layui-badge fly-badge-vip">VIP</i>
            </a>
            <span><?php echo date("Y-m-d",$detail['create_time']); ?></span>
          </div>
          <div class="detail-hits" id="LAY_jieAdmin" data-id="123">
            <span style="padding-right: 10px; color: #FF7200">悬赏：<?php echo $detail['experience']; ?>飞吻</span>
          </div>
        </div>
        <div class="detail-body photos d_content" id="content">

        </div>
      </div>

      <div class="fly-panel detail-box" id="flyReply">
        <fieldset class="layui-elem-field layui-field-title" style="text-align: center;">
          <legend>回帖</legend>
        </fieldset>

        <ul class="jieda" id="jieda">
          <?php if(is_array($comment) || $comment instanceof \think\Collection || $comment instanceof \think\Paginator): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li data-id="111" class="jieda-daan" id="zong<?php echo $vo['id']; ?>">
              <a name="item-1111111111"></a>
              <div class="detail-about detail-about-reply">
                <a class="fly-avatar" href="<?php echo url('User/home',['id' => $vo['user_id']]); ?>">
                  <img src="<?php echo $vo['image']; ?>" alt=" ">
                </a>
                <div class="fly-detail-user">
                  <a href="<?php echo url('User/home',['id' => $vo['user_id']]); ?>" class="fly-link">
                    <cite><?php echo $vo['username']; ?></cite>
                    <i class="iconfont icon-renzheng" title="认证信息：XXX"></i>
                    <i class="layui-badge fly-badge-vip">VIP</i>
                  </a>
                  <?php if($vo['user_id'] == $detail['user_id']): ?>
                    <span>(楼主)</span>
                  <?php endif; ?>
                  <!--
                  <span style="color:#5FB878">(管理员)</span>
                  <span style="color:#FF9E3F">（社区之光）</span>
                  <span style="color:#999">（该号已被封）</span>
                  -->
                </div>

                <div class="detail-hits">
                  <span><?php echo timeFormat($vo['create_time']); ?></span>
                </div>
                <city id="accept<?php echo $vo['id']; ?>">
                  <?php if($vo['accept'] == '1'): ?>
                    <i class="iconfont icon-caina" title="最佳答案"></i>
                  <?php endif; ?>
                </city>
              </div>
              <div class="detail-body jieda-body photos" >
                <p id="<?php echo $vo['id']; ?>"></p>
              </div>
              <div class="jieda-reply">
                <?php if($vo['isStar'] == '1'): ?>
                  <span class="jieda-zan zanok" type="zan" id="zan<?php echo $vo['id']; ?>" >
                    <s id="on<?php echo $vo['id']; ?>"><i class="iconfont icon-zan" onclick="nostar(this,'<?php echo $vo['id']; ?>')"></i></s>
                    <em id="zan_count<?php echo $vo['id']; ?>"><?php echo $vo['star']; ?></em>
                  </span>
                <?php endif; if($vo['isStar'] == '0'): ?>
                <span class="jieda-zan" type="zan" id="zan<?php echo $vo['id']; ?>" >
                    <s id="on<?php echo $vo['id']; ?>"><i class="iconfont icon-zan" onclick="star(this,'<?php echo $vo['id']; ?>')"></i></s>
                    <em id="zan_count<?php echo $vo['id']; ?>"><?php echo $vo['star']; ?></em>
                  </span>
                <?php endif; ?>
                <a href="#comment"><span type="reply" onclick="replace(this,'<?php echo $vo['user_id']; ?>')">
                  <i class="iconfont icon-svgmoban53"></i>
                  回复
                </span></a>
                <div class="jieda-admin">
                  <?php if($user['id'] == $vo['user_id']): ?>
                    <a href="#comment"><span type="edit"onclick="edit(this,'<?php echo $vo['id']; ?>')">编辑</span></a>
                    <i id="del<?php echo $vo['id']; ?>"><span type="del" onclick="del(this,'<?php echo $vo['id']; ?>')">删除</span></i>
                  <?php endif; if($vo['accept'] == '0'): if($accept == '0'): if($user['id'] == $detail['user_id']): ?>
                      <span class="jieda-accept" type="accept" id="accept1<?php echo $vo['id']; ?>" onclick="accept(this,'<?php echo $vo['id']; ?>')">采纳</span>
                    <?php endif; endif; endif; ?>
                </div>
              </div>
            </li>
          <?php endforeach; endif; else: echo "" ;endif; if(empty($comment)): ?>
            <li class="fly-none">消灭零回复</li>
          <?php endif; ?>
          <div id="zeng"></div>
        </ul>
        
        <div class="layui-form layui-form-pane">
          <form method="post" id="myform" url="<?php echo url('Comment/comment'); ?>">
            <div class="layui-form-item layui-form-text">
              <a name="comment"></a>
              <div class="layui-input-block">
                <textarea id="L_content" name="content" textarea="123" required lay-verify="required" placeholder="请输入内容"  class="layui-textarea fly-editor" style="height: 150px;"></textarea>
              </div>
            </div>
            <div class="layui-form-item">
              <div id="hidden"></div>
              <input type="hidden" name="jie_id" value="<?php echo $detail['id']; ?>">
              <button class="layui-btn" lay-filter="*">提交回复</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="layui-col-md4">
      <dl class="fly-panel fly-list-one">
        <dt class="fly-panel-title">本周热议</dt>
        <?php if(is_array($newData) || $newData instanceof \think\Collection || $newData instanceof \think\Paginator): $i = 0; $__LIST__ = $newData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <dd>
          <a href="<?php echo url('Jie/detail', ['id'=>$vo['id']]); ?>"><?php echo $vo['title']; ?></a>
          <span><i class="iconfont icon-pinglun1"></i> <?php echo $vo['comment_count']; ?></span>
        </dd>
        <?php endforeach; endif; else: echo "" ;endif; ?>

        <!-- 无数据时 -->
        <?php if(empty($newData)): ?>
        <div class="fly-none">没有相关数据</div>
        <?php endif; ?>
      </dl>

      <div class="fly-panel">
        <div class="fly-panel-title">
          这里可作为广告区域
        </div>
        <div class="fly-panel-main">
          <a href="http://layim.layui.com/?from=fly" target="_blank" class="fly-zanzhu" time-limit="2017.09.25-2099.01.01" style="background-color: #5FB878;">LayIM 3.0 - layui 旗舰之作</a>
        </div>
      </div>

      <div class="fly-panel" style="padding: 20px 0; text-align: center;">
        <img src="/fly/public/static/res/images/weixin.jpg" style="max-width: 100%;" alt="layui">
        <p style="position: relative; color: #666;">微信扫码关注 layui 公众号</p>
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
  <script language="javascript">
    function edit(obj,id) {
      $.ajax({
        type: 'POST',
        url: "<?php echo url('Comment/edit'); ?>",
        dataType: 'json',
        data:{
          id:id
        },
        success: function(data){
          // console.log(data.data);
          var str = data.data.content;
          content = '<input id="article_comment_id" type="hidden" name="article_comment_id" value="">';
          document.getElementById("hidden").innerHTML = content;
          document.getElementById("article_comment_id").value = data.data.id;
          $("#L_content").val(str);
        },
        error:function(data) {
          layer.closeAll('dialog');
        },
      });
    }

    function del(obj,id) {
      layer.confirm('确认要删除该回复吗？',function(index) {
        $.ajax({
          type: 'POST',
          url: "<?php echo url('Comment/del'); ?>",
          dataType: 'json',
          data:{
            id:id
          },
          success: function(data){
            var obj = document.getElementById('zong' + data.data);
            $(obj).remove();
            layer.msg(data.msg,{icon:1,time:1000});
          },
          error:function(data) {
            layer.closeAll('dialog');
          },
        });
      })
    }

    function star(obj,id) {
      $.ajax({
        type: 'POST',
        url: "<?php echo url('Comment/star'); ?>",
        dataType: 'json',
        data:{
          id:id
        },
        success: function(data){
          var count = data.data.star;
          var content = "jieda-zan zanok";
          var id = data.data.id;
          var obj = document.getElementById('zan' + id);
          obj.className = content;
          contentt = '<i class="iconfont icon-zan" onclick="nostar(this,\''+id+'\')"></i>';
          document.getElementById('on' + id).innerHTML = contentt;
          document.getElementById('zan_count' + id).innerHTML = count;
          layer.msg(data.msg,{icon:1,time:1000});
        },
        error:function(data) {
          layer.closeAll('dialog');
        },
      });
    }
    function nostar(obj,id) {
      $.ajax({
        type: 'POST',
        url: "<?php echo url('Comment/nostar'); ?>",
        dataType: 'json',
        data:{
          id:id
        },
        success: function(data){
          var count = data.data.star;
          var content="jieda-zan";
          var id = data.data.id;
          var obj = document.getElementById('zan' + id);
          obj.className=content;
          contentt = '<i class="iconfont icon-zan" onclick="star(this,\''+id+'\')"></i>';
          document.getElementById('on'+id).innerHTML = contentt;
          document.getElementById('zan_count'+id).innerHTML = count;
          layer.msg(data.msg,{icon:1,time:1000});
        },
        error:function(data) {
          layer.closeAll('dialog');
        },
      });
    }


    function replace(obj,$user_id) {
      $.ajax({
        type: 'POST',
        url: "<?php echo url('Comment/replace'); ?>",
        dataType: 'json',
        data: {
          user_id: $user_id,
        },
        success: function (data) {
          // console.log(data.data);
          var str = '@' + data.data.username + ' ';
          content = '<input id="user_id" type="hidden" name="comment_id" value="">';
          document.getElementById("hidden").innerHTML = content;
          document.getElementById("user_id").value = data.data.user_id;
          $("#L_content").val(str);
        },
        error: function (data) {
          // console.log(data.msg);
          layer.closeAll('dialog');
        },
      });
    }

    function accept(obj,$id){
      $.ajax({
        type: 'POST',
        url: "<?php echo url('Comment/accept'); ?>",
        dataType: 'json',
        data: {
          id: $id,
        },
        success: function (data) {
         if(data.code == 1){
	  content='<i class="iconfont icon-caina" title="最佳答案"></i>';
          document.getElementById("accept"+data.data).innerHTML = content;
          document.getElementById("accept1"+data.data).innerHTML = '';
	}
          layer.msg(data.msg, {icon: 1, time: 1000});
        },
        error: function (data) {
          console.log(data.msg);
          layer.closeAll('dialog');
        },
      });
    }

    $(function() {
      //表单验证
      $("#myform").validate({
        onkeyup: false,
        focusCleanup: true,
        success: "valid",
        submitHandler: function (form) {
          singwaapp_save(form);// 需要小伙伴自定义一个singwaapp_save方法 用来处理抛送请求的哦
        }
      });
    });


    //内容转义

    window.onload= function (){
            var chartData='<?php echo "$detailcontent";?>';
            // alert(chartData);
           zhuanyi(chartData);
          var commentData='<?php echo json_encode($commentcontent) ?>';
//console.log(commentData);          
	  commentzhuanyi(commentData);

  }

    function commentzhuanyi(content){
      //支持的html标签
      var html = function(end){
        return new RegExp('\\n*\\['+ (end||'') +'(pre|hr|div|span|p|table|thead|th|tbody|tr|td|ul|li|ol|li|dl|dt|dd|h2|h3|h4|h5)([\\s\\S]*?)\\]\\n*', 'g');
      };
      var content = escape(content||'') //XSS
              .replace(/img\[([^\s]+?)\]/g, function(img){  //转义图片
                return '<img src="' + img.replace(/(^img\[)|(\]$)/g, '') + '">';
              }).replace(/@(\S+)(\s+?|$)/g, '@<a href="http://121.36.3.37:89/fly/public/index.php/index/user/home/username/$1" class="fly-aite">$1</a>$2') //转义@
              .replace(/face\[([^\s\[\]]+?)\]/g, function(face){  //转义表情
                var alt = face.replace(/^face/g, '');
                alt = alt.slice(1,-1);
                var alt = toChineseWords(alt);
                alt = alt.slice(1);
                alt = '['+alt+']';
                return '<img alt="'+ alt +'" title="'+ alt +'" src="' + faces[alt] + '">';
              })
              .replace(/a\([\s\S]+?\)\[[\s\S]*?\]/g, function(str){ //转义链接
                var href = (str.match(/a\(([\s\S]+?)\)\[/)||[])[1];
                var text = (str.match(/\)\[([\s\S]*?)\]/)||[])[1];
                if(!href) return str;
                var rel =  /^(http(s)*:\/\/)\b(?!(\w+\.)*(sentsin.com|layui.com))\b/.test(href.replace(/\s/g, ''));
                return '<a href="'+ href +'" target="_blank"'+ (rel ? ' rel="nofollow"' : '') +'>'+ (text||href) +'</a>';
              }).replace(html(), '\<$1 $2\>').replace(html('/'), '\</$1\>') //转移HTML代码
              .replace(/\n/g, '<br>') //转义换行


      var content = content.replace(/\&quot;/g,'"');
      var content = content.replace(/\:"/g,":'");
      var content = content.replace(/\"}/g,"'}");
      var content = content.replace(/\",/g,"',");
      var cont = content.slice(1,-1);
       
      var cont = eval(cont);
//console.log( cont);      
count = cont.length;
//console.log(count);
      for(var i=0;i<count;i++)
      {
        document.getElementById(cont[i]['id']).innerHTML = cont[i]['content'];
      }
    }

    function toChineseWords(data){
      if(data == '' || typeof data == 'undefined') return '请输入十六进制unicode';
      data = data.split("\\u");
      var str ='';
      for(var i=0;i<data.length;i++){
        str+=String.fromCharCode(parseInt(data[i],16).toString(10));
      }
      return str;
    }




    function zhuanyi(content){
      //支持的html标签
      var html = function(end){
        return new RegExp('\\n*\\['+ (end||'') +'(pre|hr|div|span|p|table|thead|th|tbody|tr|td|ul|li|ol|li|dl|dt|dd|h2|h3|h4|h5)([\\s\\S]*?)\\]\\n*', 'g');
      };
      var content = escape(content||'') //XSS
              .replace(/img\[([^\s]+?)\]/g, function(img){  //转义图片
                return '<img src="' + img.replace(/(^img\[)|(\]$)/g, '') + '">';
              }).replace(/@(\S+)(\s+?|$)/g, '@<a href="javascript:;" class="fly-aite">$1</a>$2') //转义@
              .replace(/face\[([^\s\[\]]+?)\]/g, function(face){  //转义表情
                var alt = face.replace(/^face/g, '');
                console.log(alt);
                return '<img alt="'+ alt +'" title="'+ alt +'" src="' + faces[alt] + '">';
              })
              .replace(/a\([\s\S]+?\)\[[\s\S]*?\]/g, function(str){ //转义链接
                var href = (str.match(/a\(([\s\S]+?)\)\[/)||[])[1];
                var text = (str.match(/\)\[([\s\S]*?)\]/)||[])[1];
                if(!href) return str;
                var rel =  /^(http(s)*:\/\/)\b(?!(\w+\.)*(sentsin.com|layui.com))\b/.test(href.replace(/\s/g, ''));
                return '<a href="'+ href +'" target="_blank"'+ (rel ? ' rel="nofollow"' : '') +'>'+ (text||href) +'</a>';
              }).replace(html(), '\<$1 $2\>').replace(html('/'), '\</$1\>') //转移HTML代码
              .replace(/\n/g, '<br>') //转义换行
      // alert(content);
      // console.log(content);
      document.getElementById("content").innerHTML = content;
    }

    function rezhuanyi(content){
      //支持的html标签
      // alert(content);
      var html = function(end){
        return new RegExp('\\n*\\['+ (end||'') +'(pre|hr|div|span|p|table|thead|th|tbody|tr|td|ul|li|ol|li|dl|dt|dd|h2|h3|h4|h5)([\\s\\S]*?)\\]\\n*', 'g');
      };
      var content = escape(content||'') //XSS
              .replace(/img\[([^\s]+?)\]/g, function(img){  //转义图片
                return '<img src="' + img.replace(/(^img\[)|(\]$)/g, '') + '">';
              }).replace(/@(\S+)(\s+?|$)/g, '@<a href="http://121.36.3.37:89/fly/public/index.php/index/user/home/username/$1" class="fly-aite">$1</a>$2') //转义@
              .replace(/face\[([^\s\[\]]+?)\]/g, function(face){  //转义表情
                var alt = face.replace(/^face/g, '');
                console.log(alt);
                return '<img alt="'+ alt +'" title="'+ alt +'" src="' + faces[alt] + '">';
              })
              .replace(/a\([\s\S]+?\)\[[\s\S]*?\]/g, function(str){ //转义链接
                var href = (str.match(/a\(([\s\S]+?)\)\[/)||[])[1];
                var text = (str.match(/\)\[([\s\S]*?)\]/)||[])[1];
                if(!href) return str;
                var rel =  /^(http(s)*:\/\/)\b(?!(\w+\.)*(sentsin.com|layui.com))\b/.test(href.replace(/\s/g, ''));
                return '<a href="'+ href +'" target="_blank"'+ (rel ? ' rel="nofollow"' : '') +'>'+ (text||href) +'</a>';
              }).replace(html(), '\<$1 $2\>').replace(html('/'), '\</$1\>') //转移HTML代码
              .replace(/\n/g, '<br>') //转义换行
      // alert(content);
      console.log(content);
     return content;
    }
    function escape(html){
      // alert(html);
      return String(html||'').replace(/&(?!#?[a-zA-Z0-9]+;)/g, '&amp;')
              .replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/'/g, '&#39;').replace(/"/g, '&quot;');
    }
    var faces = {
      "[微笑]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/5c/huanglianwx_thumb.gif",
      "[嘻嘻]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/0b/tootha_thumb.gif",
      "[哈哈]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6a/laugh.gif",
      "[可爱]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/14/tza_thumb.gif",
      "[可怜]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/af/kl_thumb.gif",
      "[挖鼻]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/0b/wabi_thumb.gif",
      "[吃惊]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/f4/cj_thumb.gif",
      "[害羞]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6e/shamea_thumb.gif",
      "[挤眼]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/c3/zy_thumb.gif",
      "[闭嘴]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/29/bz_thumb.gif",
      "[鄙视]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/71/bs2_thumb.gif",
      "[爱你]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6d/lovea_thumb.gif",
      "[泪]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/9d/sada_thumb.gif",
      "[偷笑]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/19/heia_thumb.gif",
      "[亲亲]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/8f/qq_thumb.gif",
      "[生病]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/b6/sb_thumb.gif",
      "[太开心]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/58/mb_thumb.gif",
      "[白眼]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/d9/landeln_thumb.gif",
      "[右哼哼]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/98/yhh_thumb.gif",
      "[左哼哼]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6d/zhh_thumb.gif",
      "[嘘]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/a6/x_thumb.gif",
      "[衰]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/af/cry.gif",
      "[委屈]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/73/wq_thumb.gif",
      "[吐]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/9e/t_thumb.gif",
      "[哈欠]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/cc/haqianv2_thumb.gif",
      "[抱抱]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/27/bba_thumb.gif",
      "[怒]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/7c/angrya_thumb.gif",
      "[疑问]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/5c/yw_thumb.gif",
      "[馋嘴]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/a5/cza_thumb.gif",
      "[拜拜]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/70/88_thumb.gif",
      "[思考]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/e9/sk_thumb.gif",
      "[汗]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/24/sweata_thumb.gif",
      "[困]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/40/kunv2_thumb.gif",
      "[睡]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/96/huangliansj_thumb.gif",
      "[钱]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/90/money_thumb.gif",
      "[失望]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/0c/sw_thumb.gif",
      "[酷]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/40/cool_thumb.gif",
      "[色]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/20/huanglianse_thumb.gif",
      "[哼]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/49/hatea_thumb.gif",
      "[鼓掌]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/36/gza_thumb.gif",
      "[晕]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/d9/dizzya_thumb.gif",
      "[悲伤]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/1a/bs_thumb.gif",
      "[抓狂]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/62/crazya_thumb.gif",
      "[黑线]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/91/h_thumb.gif",
      "[阴险]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6d/yx_thumb.gif",
      "[怒骂]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/60/numav2_thumb.gif",
      "[互粉]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/89/hufen_thumb.gif",
      "[心]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/40/hearta_thumb.gif",
      "[伤心]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/ea/unheart.gif",
      "[猪头]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/58/pig.gif",
      "[熊猫]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/6e/panda_thumb.gif",
      "[兔子]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/81/rabbit_thumb.gif",
      "[ok]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/d6/ok_thumb.gif",
      "[耶]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/d9/ye_thumb.gif",
      "[good]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/d8/good_thumb.gif",
      "[NO]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/ae/buyao_org.gif",
      "[赞]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/d0/z2_thumb.gif",
      "[来]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/40/come_thumb.gif",
      "[弱]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/d8/sad_thumb.gif",
      "[草泥马]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/7a/shenshou_thumb.gif",
      "[神马]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/60/horse2_thumb.gif",
      "[囧]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/15/j_thumb.gif",
      "[浮云]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/bc/fuyun_thumb.gif",
      "[给力]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/1e/geiliv2_thumb.gif",
      "[围观]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/f2/wg_thumb.gif",
      "[威武]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/70/vw_thumb.gif",
      "[奥特曼]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/bc/otm_thumb.gif",
      "[礼物]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/c4/liwu_thumb.gif",
      "[钟]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/d3/clock_thumb.gif",
      "[话筒]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/9f/huatongv2_thumb.gif",
      "[蜡烛]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/d9/lazhuv2_thumb.gif",
      "[蛋糕]": "http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/3a/cakev2_thumb.gif"
    };

    var fly = {

      //Ajax
      json: function(url, data, success, options){
      }
      //简易编辑器
      ,layEditor: function(options){
        var log = {}, mod = {
          face: function(editor, self){ //插入表情
            var str = '', ul, face = fly.faces;
            for(var key in face){
              str += '<li title="'+ key +'"><img src="'+ face[key] +'"></li>';
            }
            str = '<ul id="LAY-editface" class="layui-clear">'+ str +'</ul>';
            // alert(str);
            layer.tips(str, self, {
              tips: 3
              ,time: 0
              ,skin: 'layui-edit-face'
            });
            $(document).on('click', function(){
              layer.closeAll('tips');
            });
            $('#LAY-editface li').on('click', function(){
              var title = $(this).attr('title') + ' ';
              layui.focusInsert(editor[0], 'face' + title);
            });
          }
        };

        layui.use('face', function(face){
          options = options || {};
          fly.faces = face;
          $(options.elem).each(function(index){
            var that = this, othis = $(that), parent = othis.parent();
            parent.prepend(html);
            parent.find('.fly-edit span').on('click', function(event){
              var type = $(this).attr('type');
              mod[type].call(that, othis, this);
              // alert(type);
              if(type === 'face'){
                event.stopPropagation()
              }
            });
          });
        });
      }
    };

    function collect(obj,id) {
      $.ajax({
        type: 'POST',
        url: "<?php echo url('Jie/collect'); ?>",
        dataType: 'json',
        data:{
          id:id
        },
        success: function(data){
          var count = data.data.collect_count;
          content = '<a href="#comment"><i class="iconfont" title="回答">&#xe60c;</i> <?php echo $detail['comment_count']; ?></a>\n' +
                  '            <i class="iconfont" title="人气">&#xe60b;</i> <?php echo $read_count; ?>\n' +
                  '            <a href="#"><i class="layui-icon" title="收藏" onclick="nocollect(this,\'<?php echo $detail['id']; ?>\')">&#xe658;</i>    <cite id="count"></cite></a>';
          document.getElementById("change").innerHTML = content;

          document.getElementById("count").innerHTML = count;
          layer.msg(data.msg,{icon:1,time:1000});
        },
        error:function(data) {
          layer.closeAll('dialog');
        },
      });
    }
    function nocollect(obj,id) {
      $.ajax({
        type: 'POST',
        url: "<?php echo url('Jie/nocollect'); ?>",
        dataType: 'json',
        data:{
          id:id
        },
        success: function(data){
          var count = data.data.collect_count;
          content = '<a href="#comment"><i class="iconfont" title="回答">&#xe60c;</i> <?php echo $detail['comment_count']; ?></a>\n' +
                  '            <i class="iconfont" title="人气">&#xe60b;</i> <?php echo $read_count; ?>\n' +
                  '            <a href="#"><i class="layui-icon" title="收藏" onclick="collect(this,\'<?php echo $detail['id']; ?>\')">&#xe600;</i>    <cite id="count"></cite></a>';
          document.getElementById("change").innerHTML = content;

          document.getElementById("count").innerHTML = count;
          layer.msg(data.msg,{icon:1,time:1000});
        },
        error:function(data) {
          layer.closeAll('dialog');
        },
      });
    }
</script>

</body>
</html>
