<?php

class Server
{
    private $serv;
    private $conn = null;
    private static $fd = null;

    public function __construct()
    {
        $this->initDb();
        $this->serv = new swoole_websocket_server("0.0.0.0", 9502);
        $this->serv->set(array(
            'worker_num' => 8,
            'daemonize' => false,
            'max_request' => 10000,
            'dispatch_mode' => 2,
            'debug_mode' => 1
        ));

        $this->serv->on('Open', array($this, 'onOpen'));
        $this->serv->on('Message', array($this, 'onMessage'));
        $this->serv->on('Close', array($this, 'onClose'));

        $this->serv->start();

    }

    function onOpen($server, $req)
    {
        // $server->push($req->fd, json_encode(33));
    }

    public function onMessage($server, $frame)
    {
        //$server->push($frame->fd, json_encode(["hello", "world"]));
        $pData = json_decode($frame->data);        
	$data = array();
        if (isset($pData->content)) {
            $tfd = $this->getFd($pData->tid); //获取绑定的fd
//var_dump($tfd);        
    	    $data = $this->add($pData->fid, $pData->tid, $pData->content); //保存消息
	    $this->message_add($pData->fid, $pData->tid, $pData->content);//提醒信息
//var_dump($tfd);     
       $server->push($tfd, json_encode($data)); //推送到接收者
        } else {
//var_dump($pData);var_dump($frame);
            $this->unBind(null,$pData->fid); //首次接入，清除绑定数据            
	    if ($this->bind($pData->fid, $frame->fd)) {  //绑定fd
                $data = $this->loadHistory($pData->fid, $pData->tid); //加载历史记录
            } else {
                $data = array("content" => "无法绑定fd");
            }
        }
        $server->push($frame->fd, json_encode($data)); //推送到发送者

    }


    public function onClose($server, $fd)
    {
        $this->unBind($fd);
        echo "connection close: " . $fd;
    }


    /*******************/
    function initDb()
    {
        $conn = mysqli_connect("121.36.3.37", "root", "13939525831",'fly','33306');
        if (!$conn) {
            die('Could not connect: ' . mysql_error());
        } else {
            mysqli_select_db($conn, "fly");
        }
        $this->conn = $conn;
    }

    public function add($fid, $tid, $content)
    {
        $sql = "insert into ent_msg (fid,tid,content) values ($fid,$tid,'$content')";
        if ($this->conn->query($sql)) {
            $id = $this->conn->insert_id;
            $data = $this->loadHistory($fid, $tid, $id);
            return $data;
        }
    }
    
    public function message_add($fid, $tid, $content){
//var_dump($fid);
//var_dump($tid);
//var_dump($content);
 	$time = time();
//var_dump($time);	
	$sql = "insert into ent_message (shenqing_id,article_id,from_id,uid,content,item,create_time) values ('0','0',$fid,$tid,'$content','chat','$time')";
var_dump($sql);  	
	$this->conn->query($sql);
    }

    public function bind($uid, $fd)
    {
//var_dump($uid);
//var_dump($fd);
        $sql = "insert into ent_fd (uid,fd) values ($uid,$fd)";
//var_dump($this->conn->query($sql));        
if ($this->conn->query($sql)) {
            return true;
        }
    }

    public function getFd($uid)
    {
//var_dump($uid);
        $sql = "select * from ent_fd where uid=$uid limit 1";
        $row = "";
        if ($query = $this->conn->query($sql)) {
            $data = mysqli_fetch_assoc($query);
            $row = $data['fd'];
        }
        return $row;
    }

    public function unBind($fd, $uid = null)
    {
        if ($uid) {
            $sql = "delete from ent_fd where uid=$uid";
        } else {
            $sql = "delete from ent_fd where fd=$fd";
        }
        if ($this->conn->query($sql)) {
            return true;
        }
    }

    public function loadHistory($fid, $tid, $id = null)
    {
        $and = $id ? " and id=$id" : '';
        $sql = "select * from ent_msg where ((fid=$fid and tid = $tid) or (tid=$fid and fid = $tid))" . $and;
        $data = [];
        if ($query = $this->conn->query($sql)) {
            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        }
        return $data;
    }
}

// 启动服务器
$server = new Server();
