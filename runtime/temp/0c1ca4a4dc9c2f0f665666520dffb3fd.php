<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:63:"/var/www/html/fly/public/../application/index/view/jie/add.html";i:1589375507;s:57:"/var/www/html/fly/application/index/view/public/link.html";i:1587621171;s:59:"/var/www/html/fly/application/index/view/public/header.html";i:1589017106;s:59:"/var/www/html/fly/application/index/view/public/footer.html";i:1587624192;}*/ ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>发表问题 编辑问题 公用</title>
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


<div class="layui-container fly-marginTop">
  <div class="fly-panel" pad20 style="padding-top: 5px;">
    <!--<div class="fly-none">没有权限</div>-->
    <div class="layui-form layui-form-pane">
      <div class="layui-tab layui-tab-brief" lay-filter="user">
        <ul class="layui-tab-title">
          <li class="layui-this">发表新帖<!-- 编辑帖子 --></li>
        </ul>
        <div class="layui-form layui-tab-content" id="LAY_ucm" style="padding: 20px 0;">
          <div class="layui-tab-item layui-show">
            <form method="post" id="myform" url="<?php echo url('Jie/add'); ?>">
              <div class="layui-row layui-col-space15 layui-form-item">
                <div class="layui-col-md3">
                  <label class="layui-form-label">所在专栏</label>
                  <div class="layui-input-block">
                    <select lay-verify="required" name="class" lay-filter="column">
                      <?php if($message['class'] == ''): ?>
                      <option></option>
                      <option value="0">提问</option>
                      <option value="99">分享</option>
                      <option value="100">讨论</option>
                      <option value="101">建议</option>
                      <option value="168">公告</option>
                      <option value="169">动态</option>
                      <?php endif; if($message['class'] == '0'): ?>
                      <option></option>
                      <option value="0" selected="selected">提问</option>
                      <option value="99">分享</option>
                      <option value="100">讨论</option>
                      <option value="101">建议</option>
                      <option value="168">公告</option>
                      <option value="169">动态</option>
                      <?php endif; if($message['class'] == '99'): ?>
                      <option></option>
                      <option value="0">提问</option>
                      <option value="99" selected="selected">分享</option>
                      <option value="100">讨论</option>
                      <option value="101">建议</option>
                      <option value="168">公告</option>
                      <option value="169">动态</option>
                      <?php endif; if($message['class'] == '100'): ?>
                      <option></option>
                      <option value="0">提问</option>
                      <option value="99">分享</option>
                      <option value="100" selected="selected">讨论</option>
                      <option value="101">建议</option>
                      <option value="168">公告</option>
                      <option value="169">动态</option>
                      <?php endif; if($message['class'] == '101'): ?>
                      <option></option>
                      <option value="0">提问</option>
                      <option value="99">分享</option>
                      <option value="100">讨论</option>
                      <option value="101" selected="selected">建议</option>
                      <option value="168">公告</option>
                      <option value="169">动态</option>
                      <?php endif; if($message['class'] == '168'): ?>
                      <option></option>
                      <option value="0">提问</option>
                      <option value="99">分享</option>
                      <option value="100">讨论</option>
                      <option value="101">建议</option>
                      <option value="168" selected="selected">公告</option>
                      <option value="169">动态</option>
                      <?php endif; if($message['class'] == '169'): ?>
                      <option></option>
                      <option value="0">提问</option>
                      <option value="99">分享</option>
                      <option value="100">讨论</option>
                      <option value="101">建议</option>
                      <option value="168">公告</option>
                      <option value="169" selected="selected">动态</option>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>
                <div class="layui-col-md9">
                  <label for="L_title" class="layui-form-label">标题</label>
                  <div class="layui-input-block">
                    <input type="text" id="L_title" name="title" value="<?php echo $message['title']; ?>" lay-verify="required" autocomplete="off" class="layui-input">
                     <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                     <input type="hidden" name="id" value="<?php echo $message['id']; ?>">
                  </div>
                </div>
              </div>

              <div class="layui-form-item layui-form-text">
                <div class="layui-input-block">
                  <textarea id="L_content" name="content" lay-verify="required" placeholder="详细描述" class="layui-textarea fly-editor" style="height: 260px;"><?php echo $message['content']; ?></textarea>
                </div>


              </div>
              <div class="layui-form-item">
                <div class="layui-inline">
                  <label class="layui-form-label">悬赏飞吻</label>
                  <div class="layui-input-inline" style="width: 190px;">
                    <select name="experience">
                      <?php if($message['experience'] == ''): ?>
                      <option value="20">20</option>
                      <option value="30">30</option>
                      <option value="50">50</option>
                      <option value="60">60</option>
                      <option value="80">80</option>
                      <?php endif; if($message['experience'] == '20'): ?>
                      <option value="20" selected="selected">20</option>
                      <option value="30">30</option>
                      <option value="50">50</option>
                      <option value="60">60</option>
                      <option value="80">80</option>
                      <?php endif; if($message['experience'] == '30'): ?>
                      <option value="20">20</option>
                      <option value="30" selected="selected">30</option>
                      <option value="50">50</option>
                      <option value="60">60</option>
                      <option value="80">80</option>
                      <?php endif; if($message['experience'] == '50'): ?>
                      <option value="20">20</option>
                      <option value="30">30</option>
                      <option value="50" selected="selected">50</option>
                      <option value="60">60</option>
                      <option value="80">80</option>
                      <?php endif; if($message['experience'] == '60'): ?>
                      <option value="20">20</option>
                      <option value="30">30</option>
                      <option value="50">50</option>
                      <option value="60" selected="selected">60</option>
                      <option value="80">80</option>
                      <?php endif; if($message['experience'] == '80'): ?>
                      <option value="20">20</option>
                      <option value="30">30</option>
                      <option value="50">50</option>
                      <option value="60">60</option>
                      <option value="80" selected="selected">80</option>
                      <?php endif; ?>
                    </select>
                  </div>
                  <div class="layui-form-mid layui-word-aux">发表后无法更改飞吻</div>
                </div>
              </div>
              <div class="layui-form-item">
                <label for="L_vercode" class="layui-form-label">人类验证</label>
                <div class="layui-input-inline">
                  <input type="text" id="L_vercode" name="vercode" lay-verify="required" placeholder="请回答后面的问题" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid">
                  <span style="color: #c00;"><?php echo $d_vercode; ?></span>
                </div>
              </div>
              <div class="layui-form-item">
                <button class="layui-btn" lay-filter="*">立即发布</button>
              </div>
            </form>
          </div>
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