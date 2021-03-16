<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:67:"/var/www/html/fly/public/../application/index/view/index/index.html";i:1589121372;s:57:"/var/www/html/fly/application/index/view/public/link.html";i:1587621171;s:59:"/var/www/html/fly/application/index/view/public/header.html";i:1589017106;s:59:"/var/www/html/fly/application/index/view/public/column.html";i:1589100252;s:59:"/var/www/html/fly/application/index/view/public/filter.html";i:1588399331;s:59:"/var/www/html/fly/application/index/view/public/footer.html";i:1587624192;}*/ ?>
 
 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>基于 layui 的极简社区页面模版</title>
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


<div class="fly-panel fly-column">
  <div class="layui-container">
    <ul class="layui-clear">
      <?php if($type == ''): ?>
      <li class="layui-hide-xs layui-this"><a href="<?php echo url('Jie/index'); ?>">首页</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'ti']); ?>">提问</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'fen']); ?>">分享</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'tao']); ?>">讨论</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'jian']); ?>">建议</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'gong']); ?>">公告</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'dong']); ?>">动态</a></li>
      <?php elseif($type == 'ti'): ?>
      <li><a href="<?php echo url('Jie/index'); ?>">首页</a></li>
      <li class="layui-hide-xs layui-this"><a href="<?php echo url('Jie/index',['type' => 'ti']); ?>">提问</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'fen']); ?>">分享</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'tao']); ?>">讨论</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'jian']); ?>">建议</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'gong']); ?>">公告</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'dong']); ?>">动态</a></li>
      <?php elseif($type == 'fen'): ?>
      <li><a href="<?php echo url('Jie/index'); ?>">首页</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'ti']); ?>">提问</a></li>
      <li class="layui-hide-xs layui-this"><a href="<?php echo url('Jie/index',['type' => 'fen']); ?>">分享</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'tao']); ?>">讨论</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'jian']); ?>">建议</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'gong']); ?>">公告</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'dong']); ?>">动态</a></li>
      <?php elseif($type == 'tao'): ?>
      <li><a href="<?php echo url('Jie/index'); ?>">首页</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'ti']); ?>">提问</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'fen']); ?>">分享</a></li>
      <li class="layui-hide-xs layui-this"><a href="<?php echo url('Jie/index',['type' => 'tao']); ?>">讨论</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'jian']); ?>">建议</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'gong']); ?>">公告</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'dong']); ?>">动态</a></li>
      <?php elseif($type == 'jian'): ?>
      <li><a href="<?php echo url('Jie/index'); ?>">首页</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'ti']); ?>">提问</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'fen']); ?>">分享</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'tao']); ?>">讨论</a></li>
      <li class="layui-hide-xs layui-this"><a href="<?php echo url('Jie/index',['type' => 'jian']); ?>">建议</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'gong']); ?>">公告</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'dong']); ?>">动态</a></li>
      <?php elseif($type == 'gong'): ?>
      <li><a href="<?php echo url('Jie/index'); ?>">首页</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'ti']); ?>">提问</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'fen']); ?>">分享</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'tao']); ?>">讨论</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'jian']); ?>">建议</a></li>
      <li class="layui-hide-xs layui-this"><a href="<?php echo url('Jie/index',['type' => 'gong']); ?>">公告</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'dong']); ?>">动态</a></li>
      <?php elseif($type == 'dong'): ?>
      <li><a href="<?php echo url('Jie/index'); ?>">首页</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'ti']); ?>">提问</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'fen']); ?>">分享</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'tao']); ?>">讨论</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'jian']); ?>">建议</a></li>
      <li><a href="<?php echo url('Jie/index',['type' => 'gong']); ?>">公告</a></li>
      <li class="layui-hide-xs layui-this"><a href="<?php echo url('Jie/index',['type' => 'dong']); ?>">动态</a></li>
      <?php endif; ?>
      <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><span class="fly-mid"></span></li> 

      <!-- 用户登入后显示 -->
      <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><a href="<?php echo url('user/index'); ?>">我发表的贴</a></li>
      <li class="layui-hide-xs layui-hide-sm layui-show-md-inline-block"><a href="<?php echo url('user/index#collection'); ?>">我收藏的贴</a></li>
    </ul> 
    
    <div class="fly-column-right layui-hide-xs">
      <span class="fly-search"><i class="layui-icon"></i></span>
      <a href="<?php echo url('Jie/add'); ?>" class="layui-btn">发表新帖</a>
    </div>
    <div class="layui-hide-sm layui-show-xs-block" style="margin-top: -10px; padding-bottom: 10px; text-align: center;">
      <a href="<?php echo url('Jie/add'); ?>" class="layui-btn">发表新帖</a>
    </div>
  </div>
</div>

<div class="layui-container">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md8">
      <div class="fly-panel">
        <div class="fly-panel-title fly-filter">
          <a>置顶</a>
          <a href="#signin" class="layui-hide-sm layui-show-xs-block fly-right" id="LAY_goSignin" style="color: #FF5722;">去签到</a>
        </div>
        <ul class="fly-list">
          <?php if(is_array($top) || $top instanceof \think\Collection || $top instanceof \think\Paginator): $i = 0; $__LIST__ = $top;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
              <a href="<?php echo url('User/home',['id' => $vo['user_id']]); ?>" class="fly-avatar">
                <img src="<?php echo $vo['image']; ?>" alt="贤心">
              </a>
              <h2>
                <?php if($vo['class'] == '0'): ?>
                <a class="layui-badge">提问</a>
                <?php elseif($vo['class'] == '99'): ?>
                <a class="layui-badge">分享</a>
                <?php elseif($vo['class'] == '100'): ?>
                <a class="layui-badge">讨论</a>
                <?php elseif($vo['class'] == '101'): ?>
                <a class="layui-badge">建议</a>
                <?php elseif($vo['class'] == '168'): ?>
                <a class="layui-badge">公告</a>
                <?php elseif($vo['class'] == '169'): ?>
                <a class="layui-badge">动态</a>
                <?php endif; ?>
                <a href="<?php echo url('Jie/detail',['id' => $vo['id']]); ?>"><?php echo $vo['title']; ?></a>
              </h2>
              <div class="fly-list-info">
                <a href="<?php echo url('User/home',['id' => $vo['user_id']]); ?>">
                  <cite><?php echo $vo['username']; ?></cite>

                  <i class="iconfont icon-renzheng" title="认证信息：XXX"></i>
                  <i class="layui-badge fly-badge-vip">VIP</i>

                </a>
                <span><?php echo timeFormat($vo['create_time']); ?></span>

                <span class="fly-list-kiss layui-hide-xs" title="悬赏飞吻"><i class="iconfont icon-kiss"></i> <?php echo $vo['experience']; ?></span>
                <!--<span class="layui-badge fly-badge-accept layui-hide-xs">已结</span>-->
                <span class="fly-list-nums">
                  <i class="iconfont icon-pinglun1" title="回答"></i> <?php echo $vo['comment_count']; ?>
                </span>
              </div>
              <div class="fly-list-badge">

                <span class="layui-badge layui-bg-black">置顶</span>
                <?php if($vo['read_count'] >= '200'): ?>
                  <span class="layui-badge layui-bg-red">精帖</span>
                <?php endif; ?>
              </div>
            </li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>

      <div class="fly-panel" style="margin-bottom: 0;">

        <div class="fly-panel-title fly-filter">
  <?php if($from == 'zong' || $from == ''): ?>
    <a href="<?php echo url('Index/index',['from' => 'zong','condition' => $condition]); ?>" class="layui-this">综合</a>
    <span class="fly-mid"></span>
    <a href="<?php echo url('Index/index',['from' => 'wei','condition' => $condition]); ?>">未结</a>
    <span class="fly-mid"></span>
    <a href="<?php echo url('Index/index',['from' => 'yi','condition' => $condition]); ?>">已结</a>
    <span class="fly-mid"></span>
    <a href="<?php echo url('Index/index',['from' => 'jing','condition' => $condition]); ?>">精华</a>
  <?php endif; if($from == 'wei'): ?>
    <a href="<?php echo url('Index/index',['from' => 'zong','condition' => $condition]); ?>">综合</a>
    <span class="fly-mid"></span>
    <a href="<?php echo url('Index/index',['from' => 'wei','condition' => $condition]); ?>" class="layui-this">未结</a>
    <span class="fly-mid"></span>
    <a href="<?php echo url('Index/index',['from' => 'yi','condition' => $condition]); ?>">已结</a>
    <span class="fly-mid"></span>
    <a href="<?php echo url('Index/index',['from' => 'jing','condition' => $condition]); ?>">精华</a>
  <?php endif; if($from == 'yi'): ?>
    <a href="<?php echo url('Index/index',['from' => 'zong','condition' => $condition]); ?>">综合</a>
    <span class="fly-mid"></span>
    <a href="<?php echo url('Index/index',['from' => 'wei','condition' => $condition]); ?>">未结</a>
    <span class="fly-mid"></span>
    <a href="<?php echo url('Index/index',['from' => 'yi','condition' => $condition]); ?>" class="layui-this">已结</a>
    <span class="fly-mid"></span>
    <a href="<?php echo url('Index/index',['from' => 'jing','condition' => $condition]); ?>">精华</a>
  <?php endif; if($from == 'jing'): ?>
    <a href="<?php echo url('Index/index',['from' => 'zong','condition' => $condition]); ?>">综合</a>
    <span class="fly-mid"></span>
    <a href="<?php echo url('Index/index',['from' => 'wei','condition' => $condition]); ?>">未结</a>
    <span class="fly-mid"></span>
    <a href="<?php echo url('Index/index',['from' => 'yi','condition' => $condition]); ?>">已结</a>
    <span class="fly-mid"></span>
    <a href="<?php echo url('Index/index',['from' => 'jing','condition' => $condition]); ?>" class="layui-this">精华</a>
  <?php endif; ?>
  <span class="fly-filter-right layui-hide-xs" id="type">
    <?php if($condition == 'new' || $condition == ''): ?>
      <a href="<?php echo url('Index/index',['condition' => 'new','from' => $from]); ?>" onclick="condition(this, 'new')" class="layui-this" >按最新</a>
      <span class="fly-mid"></span>
      <a href="<?php echo url('Index/index',['condition' => 're','from' => $from]); ?>" onclick="condition(this, 're')">按热议</a>
    <?php endif; if($condition == 're'): ?>
      <a href="<?php echo url('Index/index',['condition' => 'new','from' => $from]); ?>" onclick="condition(this, 'new')" >按最新</a>
      <span class="fly-mid"></span>
      <a href="<?php echo url('Index/index',['condition' => 're','from' => $from]); ?>" onclick="condition(this, 're')" class="layui-this" >按热议</a>
    <?php endif; ?>
  </span>
</div>

<script type="text/javascript">
  function condition(obj,type) {
    if(type == 'new'){
      content = '<a href="<?php echo url('Index/index',['condition' => 'new']); ?>" onclick="condition(\'new\')"  class="layui-this">按最新</a>\n' +
              '    <span class="fly-mid"></span>\n' +
              '    <a href="<?php echo url('Index/index',['condition' => 're']); ?>" onclick="condition(\'re\')">按热议</a>';
    }else if(type == 're'){
      content = '<a href="<?php echo url('Index/index',['condition' => 'new']); ?>" onclick="condition(\'new\')" >按最新</a>\n' +
              '    <span class="fly-mid"></span>\n' +
              '    <a href="<?php echo url('Index/index',['condition' => 're']); ?>" onclick="condition(\'re\')" class="layui-this" >按热议</a>';
    }
    document.getElementById("type").innerHTML = content;
  }
</script>

        <ul class="fly-list">
          <?php if(is_array($composite) || $composite instanceof \think\Collection || $composite instanceof \think\Paginator): $i = 0; $__LIST__ = $composite;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
              <a href="<?php echo url('User/home',['id' => $vo['user_id']]); ?>" class="fly-avatar">
                <img src="<?php echo $vo['image']; ?>" alt="贤心">
              </a>
              <h2>
                <?php if($vo['class'] == '0'): ?>
                <a class="layui-badge">提问</a>
                <?php elseif($vo['class'] == '99'): ?>
                <a class="layui-badge">分享</a>
                <?php elseif($vo['class'] == '100'): ?>
                <a class="layui-badge">讨论</a>
                <?php elseif($vo['class'] == '101'): ?>
                <a class="layui-badge">建议</a>
                <?php elseif($vo['class'] == '168'): ?>
                <a class="layui-badge">公告</a>
                <?php elseif($vo['class'] == '169'): ?>
                <a class="layui-badge">动态</a>
                <?php endif; ?>
                <a href="<?php echo url('Jie/detail',['id' => $vo['id']]); ?>"><?php echo $vo['title']; ?></a>
              </h2>
              <div class="fly-list-info">
                <a href="<?php echo url('User/home',['id' => $vo['user_id']]); ?>">
                  <cite><?php echo $vo['username']; ?></cite>

                  <i class="iconfont icon-renzheng" title="认证信息：XXX"></i>
                  <i class="layui-badge fly-badge-vip">VIP</i>

                </a>
                <span><?php echo timeFormat($vo['create_time']); ?></span>

                <span class="fly-list-kiss layui-hide-xs" title="悬赏飞吻"><i class="iconfont icon-kiss"></i> <?php echo $vo['experience']; ?></span>
                <!--<span class="layui-badge fly-badge-accept layui-hide-xs">已结</span>-->
                <span class="fly-list-nums">
                  <i class="iconfont icon-pinglun1" title="回答"></i> <?php echo $vo['comment_count']; ?>
                </span>
              </div>
              <div class="fly-list-badge">
                <?php if($vo['read_count'] >= '200'): ?>
                  <span class="layui-badge layui-bg-red">精帖</span>
                <?php endif; ?>
              </div>
            </li>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <div style="text-align: center">
          <div class="laypage-main">
            <a href="<?php echo url('Jie/index'); ?>" class="laypage-next">更多求解</a>
          </div>
        </div>

      </div>
    </div>
    <div class="layui-col-md4">

      <div class="fly-panel">
        <h3 class="fly-panel-title">温馨通道</h3>
        <ul class="fly-panel-main fly-list-static">
          <li>
            <a href="http://fly.layui.com/jie/4281/" target="_blank">layui 的 GitHub 及 Gitee (码云) 仓库，欢迎Star</a>
          </li>
          <li>
            <a href="http://fly.layui.com/jie/5366/" target="_blank">
              layui 常见问题的处理和实用干货集锦
            </a>
          </li>
          <li>
            <a href="http://fly.layui.com/jie/4281/" target="_blank">layui 的 GitHub 及 Gitee (码云) 仓库，欢迎Star</a>
          </li>
          <li>
            <a href="http://fly.layui.com/jie/5366/" target="_blank">
              layui 常见问题的处理和实用干货集锦
            </a>
          </li>
          <li>
            <a href="http://fly.layui.com/jie/4281/" target="_blank">layui 的 GitHub 及 Gitee (码云) 仓库，欢迎Star</a>
          </li>
        </ul>
      </div>

	<a name="signin">
      <div class="fly-panel fly-signin">
        <div class="fly-panel-title">
          签到
          <i class="fly-mid"></i> 
          <a href="javascript:;" class="fly-link" id="LAY_signinHelp">说明</a>
          <i class="fly-mid"></i> 
          <a href="javascript:;" class="fly-link" id="LAY_signinTop">活跃榜</a>
          <span class="fly-signin-days">已连续签到<cite id="inData"><?php echo $data; ?></cite>天</span>
        </div>
        <div class="fly-panel-main fly-signin-main" id="in">
          <?php if($isData == '0'): ?>
            <form method="post" id="myform" url="<?php echo url('In/index'); ?>">
              <button class="layui-btn layui-btn-danger" >今日签到</button>
            </form>
            <span>可获得<cite>
              <?php if($data < '4'): ?>
                5

              <?php elseif($data < '14'): ?>
                10

              <?php elseif($data < '29'): ?>
                15

              <?php elseif($data >= '30'): ?>
                20
              <?php endif; ?>
            </cite>飞吻</span>
          <?php endif; ?>
          <!-- 已签到状态 -->
          <?php if($isData == '1'): ?>
            <button class="layui-btn layui-btn-disabled">今日已签到</button>
            <span>获得了<cite>
              <?php if($data <= '4'): ?>
                5
              <?php elseif($data <= '14'): ?>
                10
              <?php elseif($data <= '29'): ?>
                15
              <?php elseif($data >= '30'): ?>
                20
              <?php endif; ?>
            </cite>飞吻</span>
          <?php endif; ?>
        </div>
      </div>
	</a>
      <div class="fly-panel fly-rank fly-rank-reply" id="LAY_replyRank">
        <h3 class="fly-panel-title">回贴周榜</h3>
        <dl>
          <!--<i class="layui-icon fly-loading">&#xe63d;</i>-->
          <?php if(is_array($huiData) || $huiData instanceof \think\Collection || $huiData instanceof \think\Paginator): $i = 0; $__LIST__ = $huiData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <dd>
              <a href="<?php echo url('User/home',['id' => $vo['id']]); ?>">
                <img src="<?php echo $vo['image']; ?>"><cite><?php echo $vo['username']; ?></cite><i><?php echo $vo['comment_count']; ?>次回答</i>
              </a>
            </dd>
          <?php endforeach; endif; else: echo "" ;endif; ?>
        </dl>
      </div>

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
      
      <div class="fly-panel fly-link">
        <h3 class="fly-panel-title">友情链接</h3>
        <dl class="fly-panel-main">
          <dd><a href="http://www.layui.com/" target="_blank">layui</a><dd>
          <dd><a href="http://layim.layui.com/" target="_blank">WebIM</a><dd>
          <dd><a href="http://layer.layui.com/" target="_blank">layer</a><dd>
          <dd><a href="http://www.layui.com/laydate/" target="_blank">layDate</a><dd>
          <dd><a href="mailto:xianxin@layui-inc.com?subject=%E7%94%B3%E8%AF%B7Fly%E7%A4%BE%E5%8C%BA%E5%8F%8B%E9%93%BE" class="fly-link">申请友链</a><dd>
        </dl>
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

<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_30088308'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "w.cnzz.com/c.php%3Fid%3D30088308' type='text/javascript'%3E%3C/script%3E"));</script>
<script type="text/javascript">
  $(function() {
    //表单验证
    $("#myform").validate({
      onkeyup: false,
      focusCleanup: true,
      success: "valid",
      submitHandler: function (form) {
        console.log(form);
        singwaapp_save(form);// 需要小伙伴自定义一个singwaapp_save方法 用来处理抛送请求的哦
      }
    });
  });
</script>
</body>
</html>
