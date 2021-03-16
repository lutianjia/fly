<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"/var/www/html/fly/public/../application/admin/view/admin/admin-list.html";i:1589879344;s:58:"/var/www/html/fly/application/admin/view/public/_meta.html";i:1589178985;s:60:"/var/www/html/fly/application/admin/view/public/_footer.html";i:1589360206;}*/ ?>
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
<title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<form action="<?php echo url('Admin/adminList'); ?>" method="get">
	<div class="text-c"> 日期范围：
		<input type="text" name="start_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="<?php echo $start_time; ?>" style="width:120px;" >
		-
		<input type="text" name="end_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="<?php echo $end_time; ?>"  style="width:120px;">
		<input type="text" class="input-text" style="width:250px" value="<?php echo $title; ?>"  placeholder="输入管理员名称" id="" name="title">
		<button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="admin_add('添加管理员','/admin/Admin/adminAdd','800','600')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加管理员</a></span> <span class="r">共有数据：<strong><?php echo $count; ?></strong> 条</span> </div>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="9">员工列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="150">登录名</th>
				<th width="150">角色</th>
				<th width="130">加入时间</th>
				<th width="100">是否已启用</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($detail) || $detail instanceof \think\Collection || $detail instanceof \think\Paginator): $i = 0; $__LIST__ = $detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<tr class="text-c" id="<?php echo $vo['id']; ?>">
				<td><input type="checkbox" value="<?php echo $vo['id']; ?>" name="id"></td>
				<td><?php echo $vo['id']; ?></td>
				<td><?php echo $vo['account']; ?></td>
				<td><?php echo $vo['role']; ?></td>
				<td><?php echo date("Y-m-d H:i:s",$vo['create_time']); ?></td>
				<?php if($vo['status'] == '1'): ?>
				<td class="td-status"><span class="label label-success radius">已启用</span></td>
				<?php elseif($vo['status'] == '2'): ?>
				<td class="td-status"><span class="label label-defaunt radius">已停用</span></td>
				<?php endif; ?>
				<td class="td-manage">
					<?php if($vo['role'] != '超级管理员'): if($vo['status'] == '1'): ?>
					<a style="text-decoration:none" onClick="admin_stop(this,'<?php echo $vo['id']; ?>')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>
					<?php elseif($vo['status'] == '2'): ?>
					<a style="text-decoration:none" onClick="admin_start(this,'<?php echo $vo['id']; ?>')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>
					<?php endif; ?>
					<a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','http://121.36.3.37/fly/public/index.php/admin/Admin/adminAdd','<?php echo $vo['id']; ?>','800','600')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
					<a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo $vo['id']; ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
					<?php endif; if($vo['status'] != '1'): if($vo['status'] == '2'): ?>
					<a style="text-decoration:none" onClick="admin_start(this,'<?php echo $vo['id']; ?>')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>
					<?php endif; ?>
					<a title="编辑" href="javascript:;" onclick="admin_edit('管理员编辑','http://121.36.3.37/fly/public/index.php/admin/Admin/adminAdd','<?php echo $vo['id']; ?>','800','600')" class="ml-5" s;tyle="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
					<a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo $vo['id']; ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/fly/public/static/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/fly/public/static/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/fly/public/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/fly/public/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/fly/public/static/js/common.js"></script>
<script type="text/javascript" src="/fly/public/static/js/jquery.validate.js"></script>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/fly/public/static/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/fly/public/static/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/fly/public/static/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
/*管理员-增加*/
function admin_add(title,url,w,h){
	layer_show(title,url,w,h,'list');
}
/*管理员-删除*/
function admin_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: "<?php echo url('SetStatus/del'); ?>",
			dataType: 'json',
			data:{
				id:id,
				table:'Admin'
			},
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}

function datadel() {
	layer.confirm('确定要执行批量删除吗？',function(index) {
		var id = new Array();
		$('input[name="id"]:checked').each(function () {
			id.push($(this).val());
		});
		$.ajax({
			type: 'POST',
			url: "<?php echo url('SetStatus/delete'); ?>",
			dataType: 'json',
			data:{
				id:id,
				table:'Admin'
			},
			success: function(data){
				// console.log(data.data);
				// console.log(data.data.length);
				for(var i=0; i<data.data.length; i++){
					document.getElementById(data.data[i]).remove();
				}
				console.log(data);
				if(data.msg == '至少选择一篇文章'){
					layer.msg('至少选择一位用户',{icon:2,time:1000});
				}
				if(data.code == '1'){
					layer.msg('已删除!',{icon:1,time:1000});
				}
			},
			error:function(data) {
				layer.closeAll('dialog');
			},
		});
	});
}


/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url,w,h,id);
}
/*管理员-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			type: 'POST',
			url: "<?php echo url('SetStatus/down'); ?>",
			dataType: 'json',
			data:{
				id:id,
				table:'Admin'
			},
			success: function(data){
				$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
				$(obj).remove();
				layer.msg('已停用!',{icon: 5,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});
	});
}

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		$.ajax({
			type: 'POST',
			url: "<?php echo url('SetStatus/up'); ?>",
			dataType: 'json',
			data:{
				id:id,
				table:'Admin'
			},
			success: function(data){
				$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
				$(obj).remove();
				layer.msg('已启用!', {icon: 6,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});
	});
}
</script>
</body>
</html>
