<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"/var/www/html/fly/public/../application/admin/view/admin/admin-add.html";i:1589879466;s:58:"/var/www/html/fly/application/admin/view/public/_meta.html";i:1589178985;s:60:"/var/www/html/fly/application/admin/view/public/_footer.html";i:1589360206;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/fly/public/static/lib/html5shiv.js"></script>
<script type="text/javascript" src="/fly/public/static/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/fly/public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/fly/public/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/fly/public/static/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/fly/public/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/fly/public/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/fly/public/static/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加管理员 - 管理员管理 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="myform" url="<?php echo url('Admin/adminAdd'); ?>">
	<div class="row cl">
		<input type="hidden" class="input-text" value="<?php echo $user['id']; ?>" placeholder="" id="id" name="id">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理员：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="<?php echo $user['account']; ?>" placeholder="" id="adminName" name="account">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>初始密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off" value="" placeholder="密码" id="password" name="password">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off"  placeholder="确认新密码" id="password_confirm" name="password_confirm">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="sex" type="radio" id="sex-1" value="1" checked>
				<label for="sex-1">男</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="sex-2" name="sex" value="0">
				<label for="sex-2">女</label>
			</div>
		</div>
	</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">角色：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="role" size="1">
				<?php if($user['role'] == '资讯管理员'): ?>
				<option value="超级管理员">超级管理员</option>
				<option value="资讯管理员" selected>资讯管理员</option>
				<?php endif; if($user['role'] == '超级管理员'): ?>
				<option value="超级管理员">超级管理员</option>
				<option value="资讯管理员">资讯管理员</option>
				<?php endif; ?>
			</select>
			</span> </div>
		</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">备注：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true" onKeyUp="$.Huitextarealength(this,100)"></textarea>
			<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/fly/public/static/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/fly/public/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/fly/public/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/fly/public/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/fly/public/static/js/common.js"></script>
<script type="text/javascript" src="/fly/public/static/js/jquery.validate.js"></script>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/fly/public/static/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/fly/public/static/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/fly/public/static/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
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
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>
