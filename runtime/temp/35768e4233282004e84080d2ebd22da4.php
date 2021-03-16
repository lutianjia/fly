<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"/var/www/html/fly/public/../application/index/view/chat/chat.html";i:1590587557;}*/ ?>

<html>
<head>
    <title>chat UI</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="author" content="https://blog.csdn.net/q475254344">
    <link href="/fly/public/static/css/chat.css" rel="stylesheet">
    <script type="text/javascript" src="/fly/public/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="/fly/public/static/js/jquery.validate.js"></script>
    <script src="/fly/public/static/res/layui/layui.js"></script>
    <script type="text/javascript" src="/fly/public/static/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/fly/public/static/js/jquery.json-2.4.min.js"></script>
</head>
<script>
    document.getElementsByTagName('body').height=window.innerHeight;
</script>
<body class="box">
<div class="container">
    <div class="chatbox">
        <div class="chatleft">
            <div class="top">
                    <i class="fas fa-bars" style="font-size: 1.4em"></i>
                <form method="post" id="myform">
                    <input type="text" placeholder="search" id="" name="search" style="width: 140px; height: 36px; margin-left: 25px;">
                    <button class="searchbtn" type="button" onclick="ajaxPost()"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <div class="center">
                <ul>
                    <?php if($tidUser['id'] == $user_id): ?>
                    <li onclick="check(<?php echo $tidUser['id']; ?>)" id="<?php echo $tidUser['id']; ?>" style="background: #D0D0D0;">
                        <?php else: ?>
                    <li onclick="check(<?php echo $tidUser['id']; ?>)" id="<?php echo $tidUser['id']; ?>" style="background: #ffffff;">
                        <?php endif; ?>
                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: middle;" src="<?php echo $tidUser['image']; ?>">
                        <span style="margin-left: 10px;"><?php echo $tidUser['username']; ?></span>
                    </li>
                    <?php if(is_array($list_array) || $list_array instanceof \think\Collection || $list_array instanceof \think\Paginator): $i = 0; $__LIST__ = $list_array;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['id'] == $user_id): ?>
                    <li onclick="check(<?php echo $vo['id']; ?>)" id="<?php echo $vo['id']; ?>" style="background: #D0D0D0;">
                    <?php else: ?>
                    <li onclick="check(<?php echo $vo['id']; ?>)" id="<?php echo $vo['id']; ?>" style="background: #ffffff;">
                    <?php endif; ?>
                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: middle;" src="<?php echo $vo['image']; ?>">
                        <span style="margin-left: 10px;"><?php echo $vo['username']; ?></span>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
        <div class="chatright">
            <div class="top">
                <img style="width: 30px;height: 30px; border-radius: 20px; vertical-align: middle;" id="top_image" src="<?php echo $top_message['image']; ?>">
                <span style="margin-left: 20px;" id="top_username"><?php echo $top_message['username']; ?></span>
                <i class="fas fa-ellipsis-v" style="font-size: 1.4em; position: absolute; right: 20px; color: gray;"></i>
            </div>
            <div class="center" id="talkplace">
                <i id="load"></i>
                <ul id="history">

                </ul>
            </div>
            <div class="footer">
                <textarea id="content" name="content" maxlength="800" rows="5" cols="40" style="width: 100%; resize: none; border: none; " placeholder="请在此输入要发送的内容..."></textarea>
                <i id="send_id"><button class="sendbtn" onclick="sendMsg('<?php echo $top_message['id']; ?>')">发送</button></i>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var fid = '<?php echo json_encode($fid) ?>';//发送者uid
    var tid = '<?php echo json_encode($tid) ?>';//接收者uid
    var fidUser = '<?php echo json_encode($fidUser) ?>';//接收者uid
    var tidUser = '<?php echo json_encode($tidUser) ?>';//接收者uid

    var fidUser = eval('(' + fidUser + ')');
    var tidUser = eval('(' + tidUser + ')');
    function ajaxPost(){
        var formData = $("#myform").serialize();
        //serialize() 方法通过序列化表单值，创建 URL 编码文本字符串,这个是jquery提供的方法
        // alert(formData);
        $.ajax({
            type: 'POST',
            url: "<?php echo url('Chat/index'); ?>",
            dataType: 'json',
            data:formData,
            success: function(data) {
                // console.log(data.data);
                if(data.code == 0){
                    layer.msg(data.msg, {icon:7, time:2000});
                }else if(data.code == 1){
                    document.getElementById(data.data.noid.replace(/\"/g, "")).style.background = "#ffffff";
                    document.getElementById(data.data.id).style.background = "#D0D0D0";
                    document.getElementById('top_image').src = data.data.image;
                    document.getElementById('top_username').innerHTML = data.data.username;
                    document.getElementById('history').innerHTML = '';
                    document.getElementById('send_id').innerHTML = '<button class="sendbtn" onclick="sendMsg(\''+data.data.id+'\')">发送</button>';
                    var fid = '<?php echo json_encode($fid) ?>';//发送者uid
                    var tid = data.data.id;//接收者uid
                    var exampleSocket = new WebSocket("ws://121.36.3.37:9502");
                    $(function () {
                        exampleSocket.onopen = function (event) {
                            console.log(event.data);
                            initData(); //加载历史记录
                        };
                        exampleSocket.onmessage = function (event) {
                            console.log(event.data);
                            loadData($.parseJSON(event.data)); //导入消息记录，加载新的消息

                            scrollBottom();
                        }
                    });

                    function initData() {
                        var pData = {
                            fid: fid,
                            tid: tid,
                        };
                        exampleSocket.send($.toJSON(pData)); //获取消息记录，绑定fd
                    }
                    function loadData(data) {
                        console.log(data);
                        var time = 1;
                        var limit = 1;
                        if(data.length>5){
                            window.data = data;
                            var limit = 5*time;
                            time = time+1;
                            var content = '<div  style="width: 100%;text-align:center;" onclick="limit(\''+time+'\')">点击查看更多消息记录</div>';
                            document.getElementById("load").innerHTML = content;
                        }
                        for (var i = (data.length-limit); i < data.length; i++) {
                            // console.log(i);
			    fid = fid.replace(/\"/g, "");
                            if(data[i].fid == fid){
                                var html = '<li class="msgright">\n' +
                                    '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top; float: right;max-width: 100%; cursor: crosshair;" src="' + fidUser['image'] + ' ">\n' +
                                    '                        <p class="msgcard" style="float: right">' + data[i].content + ' </p>\n' +
                                    '                    </li>';
                                $("#history").append(html);
                            }else{
                                var html = '<li class="msgleft">\n' +
                                    '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top;" src="' + tidUser['image'] + ' ">\n' +
                                    '                        <p class="msgcard">' + data[i].content + ' </p>\n' +
                                    '                    </li>';
                                $("#history").append(html);
                            }
                        }
                    }

                    function limit(time) {
                        var a=0;
                        if(data.length>5*time){
                            var limit = 5*time;
                            time = time*1+1;
                            var content = '<div  style="width: 100%;text-align:center;" onclick="limit(\''+time+'\')">点击查看更多消息记录</div>';
                            document.getElementById("load").innerHTML = content;
                            document.getElementById("history").innerHTML = '';
                            var a=1;
                            for (var i = (data.length-limit); i < data.length; i++) {
                                if(data[i].fid == fid){
                                    var html = '<li class="msgright">\n' +
                                        '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top; float: right;max-width: 100%; cursor: crosshair;" src="' + fidUser['image'] + ' ">\n' +
                                        '                        <p class="msgcard" style="float: right">' + data[i].content + ' </p>\n' +
                                        '                    </li>';
                                    $("#history").append(html);
                                }else{
                                    var html = '<li class="msgleft">\n' +
                                        '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top;" src="' + tidUser['image'] + ' ">\n' +
                                        '                        <p class="msgcard">' + data[i].content + ' </p>\n' +
                                        '                    </li>';
                                    $("#history").append(html);
                                }
                            }
                        }
                        if((data.length<5*time) && (data.length>5*(time-1)) && a==0){
                            document.getElementById("load").innerHTML = '';
                            document.getElementById("history").innerHTML = '';

                            for (var i = 0; i < data.length; i++) {
                                if(data[i].fid == fid){
                                    var html = '<li class="msgright">\n' +
                                        '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top; float: right;max-width: 100%; cursor: crosshair;" src="' + fidUser['image'] + ' ">\n' +
                                        '                        <p class="msgcard" style="float: right">' + data[i].content + ' </p>\n' +
                                        '                    </li>';
                                    $("#history").append(html);
                                }else{
                                    var html = '<li class="msgleft">\n' +
                                        '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top;" src="' + tidUser['image'] + ' ">\n' +
                                        '                        <p class="msgcard">' + data[i].content + ' </p>\n' +
                                        '                    </li>';
                                    $("#history").append(html);
                                }
                            }

                        }
                    }

                    function scrollBottom(){
                        var a= $('#talkplace')[0].scrollHeight;
                        $(document).ready(function () {
                            $('#talkplace').scrollTop(a);
                        });
                    }
                }
                }

        });
    }
    function check(id) {
        console.log(id);
        $.ajax({
            type: 'POST',
            url: "<?php echo url('Chat/index'); ?>",
            dataType: 'json',
            data:{
                id:id,
                tid:tid,
            },success: function(data) {
                console.log(data.data.noid);
                document.getElementById(data.data.noid.replace(/\"/g, "")).style.background = "#ffffff";
                document.getElementById(data.data.id).style.background = "#D0D0D0";
                document.getElementById('top_image').src = data.data.image;
                document.getElementById('top_username').innerHTML = data.data.username;
                document.getElementById('history').innerHTML = '';
                document.getElementById('send_id').innerHTML = '<button class="sendbtn" onclick="sendMsg(\''+data.data.id+'\')">发送</button>';
                var fid = '<?php echo json_encode($fid) ?>';//发送者uid
                var tid = data.data.id;//接收者uid
                var exampleSocket = new WebSocket("ws://121.36.3.37:9502");
                $(function () {
                    exampleSocket.onopen = function (event) {
                        console.log(event.data);
                        initData(); //加载历史记录
                    };
                    exampleSocket.onmessage = function (event) {
                        console.log(event.data);
                        loadData($.parseJSON(event.data)); //导入消息记录，加载新的消息

                        scrollBottom();
                    }
                });

                function initData() {
                    var pData = {
                        fid: fid,
                        tid: tid,
                    };
                    exampleSocket.send($.toJSON(pData)); //获取消息记录，绑定fd
                }
                function loadData(data) {
                    console.log(data);
                    var time = 1;
                    var limit = 1;
                    if(data.length>5){
                        window.data = data;
                        var limit = 5*time;
                        time = time+1;
                        var content = '<div  style="width: 100%;text-align:center;" onclick="limit(\''+time+'\')">点击查看更多消息记录</div>';
                        document.getElementById("load").innerHTML = content;
                    }
                    for (var i = (data.length-limit); i < data.length; i++) {
                         //console.log(data[i].fid);
			 //console.log(fid);
			fid = fid.replace(/\"/g, "");
                        if(data[i].fid == fid){
                            var html = '<li class="msgright">\n' +
                                '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top; float: right;max-width: 100%; cursor: crosshair;" src="' + fidUser['image'] + ' ">\n' +
                                '                        <p class="msgcard" style="float: right">' + data[i].content + ' </p>\n' +
                                '                    </li>';
                            $("#history").append(html);
                        }else{
                            var html = '<li class="msgleft">\n' +
                                '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top;" src="' + tidUser['image'] + ' ">\n' +
                                '                        <p class="msgcard">' + data[i].content + ' </p>\n' +
                                '                    </li>';
                            $("#history").append(html);
                        }
                    }
                }

                function limit(time) {
                    var a=0;
                    if(data.length>5*time){
                        var limit = 5*time;
                        time = time*1+1;
                        var content = '<div  style="width: 100%;text-align:center;" onclick="limit(\''+time+'\')">点击查看更多消息记录</div>';
                        document.getElementById("load").innerHTML = content;
                        document.getElementById("history").innerHTML = '';
                        var a=1;
                        for (var i = (data.length-limit); i < data.length; i++) {
                            if(data[i].fid == fid){
                                var html = '<li class="msgright">\n' +
                                    '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top; float: right;max-width: 100%; cursor: crosshair;" src="' + fidUser['image'] + ' ">\n' +
                                    '                        <p class="msgcard" style="float: right">' + data[i].content + ' </p>\n' +
                                    '                    </li>';
                                $("#history").append(html);
                            }else{
                                var html = '<li class="msgleft">\n' +
                                    '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top;" src="' + tidUser['image'] + ' ">\n' +
                                    '                        <p class="msgcard">' + data[i].content + ' </p>\n' +
                                    '                    </li>';
                                $("#history").append(html);
                            }
                        }
                    }
                    if((data.length<5*time) && (data.length>5*(time-1)) && a==0){
                        document.getElementById("load").innerHTML = '';
                        document.getElementById("history").innerHTML = '';

                        for (var i = 0; i < data.length; i++) {
                            if(data[i].fid == fid){
                                var html = '<li class="msgright">\n' +
                                    '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top; float: right;max-width: 100%; cursor: crosshair;" src="' + fidUser['image'] + ' ">\n' +
                                    '                        <p class="msgcard" style="float: right">' + data[i].content + ' </p>\n' +
                                    '                    </li>';
                                $("#history").append(html);
                            }else{
                                var html = '<li class="msgleft">\n' +
                                    '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top;" src="' + tidUser['image'] + ' ">\n' +
                                    '                        <p class="msgcard">' + data[i].content + ' </p>\n' +
                                    '                    </li>';
                                $("#history").append(html);
                            }
                        }

                    }
                }

                function scrollBottom(){
                    var a= $('#talkplace')[0].scrollHeight;
                    $(document).ready(function () {
                        $('#talkplace').scrollTop(a);
                    });
                }
            }
        });
    }

    window.onload= function () {
        scrollBottom();
    };


    // console.log(fidUser['image']);
    // console.log(tidUser);
    var exampleSocket = new WebSocket("ws://121.36.3.37:9502");
    $(function () {
        exampleSocket.onopen = function (event) {
            console.log(event.data);
            initData(); //加载历史记录
        };
        exampleSocket.onmessage = function (event) {
            console.log(event.data);
            loadData($.parseJSON(event.data)); //导入消息记录，加载新的消息

            scrollBottom();
        }
    });
    function sendMsg(id) {
        // alert(id);
        var pData = {
            content: document.getElementById('content').value,
            fid: fid,
            tid: id,
        };
        console.log(pData);
        if(pData.content == ''){
            layer.msg('消息不能为空', {icon:7, time:2000});
            return;
        }
        document.getElementById("content").value = '';
        exampleSocket.send($.toJSON(pData)); //发送消息
    }
    function initData() {
        var pData = {
            fid: fid,
            tid: tid,
        };
        exampleSocket.send($.toJSON(pData)); //获取消息记录，绑定fd
    }
    function loadData(data) {
        console.log(data);
        var time = 1;
        var limit = 1;
        if(data.length>5){
            window.data = data;
            var limit = 5*time;
            time = time+1;
            var content = '<div  style="width: 100%;text-align:center;" onclick="limit(\''+time+'\')">点击查看更多消息记录</div>';
            document.getElementById("load").innerHTML = content;
        }
        for (var i = (data.length-limit); i < data.length; i++) {
            //console.log(fid);
	    //console.log(data[i].fid);
            fid = fid.replace(/\"/g, "");
	    //console.log(fid);
	    if(data[i].fid == fid){
                var html = '<li class="msgright">\n' +
                    '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top; float: right;max-width: 100%; cursor: crosshair;" src="' + fidUser['image'] + ' ">\n' +
                    '                        <p class="msgcard" style="float: right">' + data[i].content + ' </p>\n' +
                    '                    </li>';
                $("#history").append(html);
            }else{
                var html = '<li class="msgleft">\n' +
                    '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top;" src="' + tidUser['image'] + ' ">\n' +
                    '                        <p class="msgcard">' + data[i].content + ' </p>\n' +
                    '                    </li>';
                $("#history").append(html);
            }
        }
    }

    function limit(time) {
        var a=0;
        if(data.length>5*time){
            var limit = 5*time;
            time = time*1+1;
            var content = '<div  style="width: 100%;text-align:center;" onclick="limit(\''+time+'\')">点击查看更多消息记录</div>';
            document.getElementById("load").innerHTML = content;
            document.getElementById("history").innerHTML = '';
            var a=1;
            for (var i = (data.length-limit); i < data.length; i++) {
                if(data[i].fid == fid){
                    var html = '<li class="msgright">\n' +
                        '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top; float: right;max-width: 100%; cursor: crosshair;" src="' + fidUser['image'] + ' ">\n' +
                        '                        <p class="msgcard" style="float: right">' + data[i].content + ' </p>\n' +
                        '                    </li>';
                    $("#history").append(html);
                }else{
                    var html = '<li class="msgleft">\n' +
                        '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top;" src="' + tidUser['image'] + ' ">\n' +
                        '                        <p class="msgcard">' + data[i].content + ' </p>\n' +
                        '                    </li>';
                    $("#history").append(html);
                }
            }
        }
        if((data.length<5*time) && (data.length>5*(time-1)) && a==0){
            document.getElementById("load").innerHTML = '';
            document.getElementById("history").innerHTML = '';

            for (var i = 0; i < data.length; i++) {
                if(data[i].fid == fid){
                    var html = '<li class="msgright">\n' +
                        '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top; float: right;max-width: 100%; cursor: crosshair;" src="' + fidUser['image'] + ' ">\n' +
                        '                        <p class="msgcard" style="float: right">' + data[i].content + ' </p>\n' +
                        '                    </li>';
                    $("#history").append(html);
                }else{
                    var html = '<li class="msgleft">\n' +
                        '                        <img style="width: 40px;height: 40px; border-radius: 20px; vertical-align: top;" src="' + tidUser['image'] + ' ">\n' +
                        '                        <p class="msgcard">' + data[i].content + ' </p>\n' +
                        '                    </li>';
                    $("#history").append(html);
                }
            }

        }
    }

    function scrollBottom(){
        var a= $('#talkplace')[0].scrollHeight;
        $(document).ready(function () {
            $('#talkplace').scrollTop(a);
        });
    }
</script>

</body>
</html>