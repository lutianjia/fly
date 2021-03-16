<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:74:"/var/www/html/fly/public/../application/admin/view/member/member-list.html";i:1589958854;s:58:"/var/www/html/fly/application/admin/view/public/_meta.html";i:1589178985;s:60:"/var/www/html/fly/application/admin/view/public/_footer.html";i:1589360206;}*/ ?>
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
<title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<form action="<?php echo url('Member/member'); ?>" method="get">
	<input id="file_upload_image" name="from" type="hidden" multiple="true" value="123">
	<div class="text-c"> 日期范围：
		<input type="text" name="start_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="<?php echo $start_time; ?>" style="width:120px;" >
		-
		<input type="text" name="end_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="<?php echo $end_time; ?>"  style="width:120px;">
		<input type="text" class="input-text" style="width:250px" value="<?php echo $title; ?>" placeholder="输入会员名称、昵称、邮箱" id="" name="title">
		<button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
	</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"></span> <span class="r">共有数据：<strong><?php echo $count; ?></strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="40">性别</th>
				<th width="150">邮箱</th>
				<th width="">地址</th>
				<th width="130">加入时间</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($detail) || $detail instanceof \think\Collection || $detail instanceof \think\Paginator): $i = 0; $__LIST__ = $detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
			<tr class="text-c" id="<?php echo $vo['id']; ?>">
				<td><input type="checkbox" value="<?php echo $vo['id']; ?>" name="id"></td>
				<td><?php echo $vo['id']; ?></td>
				<td><a href="javascript:openUrl('http://121.36.3.37:89/fly/public/index.php/index/Adminuse/home/id/<?php echo $vo['id']; ?>.html')"><u style="cursor:pointer" class="text-primary"><?php echo $vo['username']; ?></u></a></td>
				<td><?php echo $vo['sex']; ?></td>
				<td><?php echo $vo['email']; ?></td>
				<?php if($vo['city'] == ''): ?>
				<td class="text-l">火星</td>
				<?php else: ?>
				<td class="text-l"><?php echo $vo['city']; ?></td>
				<?php endif; ?>
				<td><?php echo date("Y-m-d H:i:s",$vo['create_time']); ?></td>
				<?php if($vo['status'] == '1'): ?>
				<td class="td-status"><span class="label label-success radius">已启用</span></td>
				<?php elseif($vo['status'] == '2'): ?>
				<td class="td-status"><span class="label label-defaunt radius">已停用</span></td>
				<?php endif; ?>
				<td class="td-manage">
					<?php if($vo['status'] == '1'): ?>
						<a style="text-decoration:none" onClick="member_stop(this,'<?php echo $vo['id']; ?>')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>
					<?php elseif($vo['status'] == '2'): ?>
					<a style="text-decoration:none" onClick="member_start(this,'<?php echo $vo['id']; ?>')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>
					<?php endif; ?>
					<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo $vo['id']; ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
				</td>
			</tr>
		<?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	</div>
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
$(function(){
	$('.table-sort').dataTable({
		"aaSorting": [[ 1, "desc" ]],//默认第几个排序
		"bStateSave": true,//状态保存
		"aoColumnDefs": [
		  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		  {"orderable":false,"aTargets":[0,7,8]}// 制定列不参与排序
		]
	});
	
});

function openUrl(url){
	window.open(url);
}
/*用户-添加*/
function member_add(title,url,w,h){
	layer_show(title,url,w,h);
}

/*用户-停用*/
function member_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		$.ajax({
			type: 'POST',
			url: "<?php echo url('SetStatus/down'); ?>",
			dataType: 'json',
			data:{
				id:id,
				table:'User'
			},
			success: function(data){
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
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

/*用户-启用*/
function member_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$.ajax({
			type: 'POST',
			url: "<?php echo url('SetStatus/up'); ?>",
			dataType: 'json',
			data:{
				id:id,
				table:'User'
			},
			success: function(data){
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
				$(obj).remove();
				layer.msg('已启用!',{icon: 6,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});
	});
}

/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: "<?php echo url('SetStatus/del'); ?>",
			dataType: 'json',
			data:{
				id:id,
				table:'User'
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
				table:'User'
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
</script> 
</body>
</html>
