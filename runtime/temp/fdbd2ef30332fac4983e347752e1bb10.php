<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"/var/www/html/fly/public/../application/admin/view/welcome/welcome.html";i:1589288864;s:58:"/var/www/html/fly/application/admin/view/public/_meta.html";i:1589178985;}*/ ?>
﻿<!DOCTYPE HTML>
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
<title>我的桌面</title>
</head>
<body>
<div class="page-container">
	<p class="f-20 text-success">欢迎使用H-ui.admin <span class="f-14">v3.1</span>后台模版！</p>
	<p>登录次数：<?php echo $user['login_count']; ?> </p>
	<p>上次登录IP：<?php echo $last_login_ip; ?>  上次登录时间：<?php echo timeFormat($last_login_time); ?></p>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th colspan="7" scope="col">信息统计</th>
			</tr>
			<tr class="text-c">
				<th>统计</th>
				<th>资讯库</th>

				<th>用户</th>
				<th>管理员</th>
			</tr>
		</thead>
		<tbody>
			<tr class="text-c">
				<td>总数</td>
				<td><?php echo $data['0']['0']; ?></td>
				<td><?php echo $data['1']['0']; ?></td>
				<td><?php echo $data['2']['0']; ?></td>
			</tr>
			<tr class="text-c">
				<td>今日</td>
				<td><?php echo $data['0']['1']; ?></td>
				<td><?php echo $data['1']['1']; ?></td>
				<td><?php echo $data['2']['1']; ?></td>
			</tr>
			<tr class="text-c">
				<td>昨日</td>
				<td><?php echo $data['0']['2']; ?></td>
				<td><?php echo $data['1']['2']; ?></td>
				<td><?php echo $data['2']['2']; ?></td>
			</tr>
			<tr class="text-c">
				<td>本周</td>
				<td><?php echo $data['0']['3']; ?></td>
				<td><?php echo $data['1']['3']; ?></td>
				<td><?php echo $data['2']['3']; ?></td>
			</tr>
			<tr class="text-c">
				<td>本月</td>
				<td><?php echo $data['0']['4']; ?></td>
				<td><?php echo $data['1']['4']; ?></td>
				<td><?php echo $data['2']['4']; ?></td>
			</tr>
		</tbody>
	</table>
</div>
<footer class="footer mt-20">
	<div class="container">
		<p>感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br>
			Copyright &copy;2015-2017 H-ui.admin v3.1 All Rights Reserved.<br>
			本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
	</div>
</footer>
<script type="text/javascript" src="/fly/public/static/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/fly/public/static/h-ui/js/H-ui.min.js"></script>

</body>
</html>