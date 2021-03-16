<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:76:"/var/www/html/fly/public/../application/admin/view/article/article-list.html";i:1589958648;s:58:"/var/www/html/fly/application/admin/view/public/_meta.html";i:1589178985;s:60:"/var/www/html/fly/application/admin/view/public/_footer.html";i:1589360206;}*/ ?>
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
<title>资讯列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 资讯管理 <span class="c-gray en">&gt;</span> 资讯列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="text-c">
		<form action="<?php echo url('Article/index'); ?>" method="get">
	 <span class="select-box inline">
		 <input id="file_upload_image" name="from" type="hidden" multiple="true" value="123">
		<select name="class" class="select">
			<option value="1">全部分类</option>
			<?php if(is_array($cats) || $cats instanceof \think\Collection || $cats instanceof \think\Paginator): $i = 0; $__LIST__ = $cats;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $key; ?>" <?php if($key == $class): ?> selected = "selected"<?php endif; ?> > <?php echo $vo; ?></option>
			<?php endforeach; endif; else: echo "" ;endif; ?>
		</select>
		</span> 日期范围：
		<input type="text" name="start_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="<?php echo $start_time; ?>" style="width:120px;" >
		-
		<input type="text" name="end_time" class="input-text" id="countTimestart" onfocus="selecttime(1)" value="<?php echo $end_time; ?>"  style="width:120px;">

		<input type="text" name="title" id="" value="<?php echo $title; ?>" placeholder=" 资讯名称" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜资讯</button>
		</form>
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> </span> <span class="r">共有数据：<strong><?php echo $count; ?></strong> 条</span> </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
					<th>标题</th>
					<th width="80">分类</th>
					<th width="80">来源</th>
					<th width="120">更新时间</th>
					<th width="75">浏览次数</th>
					<th width="60">发布状态</th>
					<th width="120">操作</th>
				</tr>
			</thead>
			<tbody>
			<?php if(is_array($detail) || $detail instanceof \think\Collection || $detail instanceof \think\Paginator): $i = 0; $__LIST__ = $detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<tr class="text-c" id="<?php echo $vo['id']; ?>">
					<td><input type="checkbox" value="<?php echo $vo['id']; ?>" name="id"></td>
					<td><?php echo $vo['id']; ?></td>
					<td class="text-l"><a href="javascript:openUrl('http://121.36.3.37:89/fly/public/index.php/index/Adminuse/detail/id/<?php echo $vo['id']; ?>.html')"><u style="cursor:pointer" class="text-primary" title="查看"><?php echo $vo['title']; ?></u></a></td>
					<?php if($vo['class'] == '0'): ?>
					<td>提问</td>
					<?php elseif($vo['class'] == '99'): ?>
					<td>分享</td>
					<?php elseif($vo['class'] == '100'): ?>
					<td>讨论</td>
					<?php elseif($vo['class'] == '101'): ?>
					<td>建议</td>
					<?php elseif($vo['class'] == '168'): ?>
					<td>公告</td>
					<?php elseif($vo['class'] == '169'): ?>
					<td>动态</td>
					<?php endif; ?>
					<td><?php echo $vo['username']; ?></td>
					<td><?php echo date("Y-m-d H:i:s",$vo['create_time']); ?></td>
					<td><?php echo $vo['read_count']; ?></td>
					<?php if($vo['status'] == '0'): ?>
						<td class="td-status"><span class="label label-success radius">草稿</span></td>
					<?php elseif($vo['status'] == '1'): ?>
						<td class="td-status"><span class="label label-success radius">已发布</span></td>
					<?php elseif($vo['status'] == '2'): ?>
						<td class="td-status"><span class="label label-defaunt radius">已下架</span></td>
					<?php endif; ?>
					<td class="f-14 td-manage">
						<?php if($vo['status'] == '0'): ?>
						<a style="text-decoration:none" onClick="article_shenhe(this,'<?php echo $vo['id']; ?>')" href="javascript:;" title="审核">审核</a>
						<?php endif; if($vo['status'] == '1'): ?>
						<a style="text-decoration:none" onClick="article_stop(this,'<?php echo $vo['id']; ?>')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>
						<?php endif; if($vo['status'] == '2'): ?>
						<a style="text-decoration:none" onClick="article_start(this,'<?php echo $vo['id']; ?>')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>
						<?php endif; ?>
						<a style="text-decoration:none" class="ml-5" onClick="article_del(this,'<?php echo $vo['id']; ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
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

function openUrl(url){
	window.open(url);
}

$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"pading":false,
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,8]}// 不参与排序的列
	]
});

/*资讯-添加*/
function article_add(title,url,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}

/*资讯-删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: "<?php echo url('SetStatus/del'); ?>",
			dataType: 'json',
			data:{
				id:id,
				table:'Allowance'
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

/*资讯-审核*/
function article_shenhe(obj,id){
	layer.confirm('审核文章？', {
		btn: ['通过','不通过','取消'], 
		shade: false,
		closeBtn: 0
	},
	function(){
		$.ajax({
			type: 'POST',
			url: "<?php echo url('SetStatus/agree'); ?>",
			dataType: 'json',
			data:{
				id:id,
				table:'Allowance'
			},
			success: function(data){
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
				$(obj).remove();
				layer.msg('已发布', {icon:6,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
				layer.closeAll('dialog');
			},
		});
	},
	function(){
		$.ajax({
			type: 'POST',
			url: "<?php echo url('SetStatus/del'); ?>",
			dataType: 'json',
			data:{
				id:id,
				table:'Allowance'
			},
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('未通过，已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
				layer.closeAll('dialog');
			},
		});
	});	
}
/*资讯-下架*/
function article_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		$.ajax({
			type: 'POST',
			url: "<?php echo url('SetStatus/down'); ?>",
			dataType: 'json',
			data:{
				id:id,
				table:'Allowance'
			},
			success: function(data){
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_start(this,id)" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
				$(obj).remove();
				layer.msg('已下架!',{icon: 5,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
				layer.closeAll('dialog');
			},
		});
	});
}

/*资讯-发布*/
function article_start(obj,id){
	layer.confirm('确认要发布吗？',function(index){
		$.ajax({
			type: 'POST',
			url: "<?php echo url('SetStatus/up'); ?>",
			dataType: 'json',
			data:{
				id:id,
				table:'Allowance'
			},
			success: function(data){
				$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,id)" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
				$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
				$(obj).remove();
				layer.msg('已发布!',{icon: 6,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
				layer.closeAll('dialog');
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
				table:'Allowance'
			},
			success: function(data){
				// console.log(data.data);
				// console.log(data.data.length);
				for(var i=0; i<data.data.length; i++){
					document.getElementById(data.data[i]).remove();
				}
				console.log(data);
				if(data.msg == '至少选择一篇文章'){
					layer.msg('至少选择一篇文章',{icon:2,time:1000});
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
