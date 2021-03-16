<?php
namespace app\index\controller;

use think\Controller;
use think\Session;
class Index extends Controller
{
    public function index(){
        $email = Session::get('fly.email') ;

        $result = model('User')->where('email', $email)->find();
        $data = $this->in($result);
        $isData = $this->inData($result);

        //置顶数据
        $whereData['a.status'] = 1;
        $whereData['is_head_figure'] = 1;
        $order = ['a.create_time' => 'desc'];
        $top = search('Allowance', 'User', $whereData,$order);

        $condition = input('condition');
        if($condition == '' || $condition == 'new'){
            $order = ['a.create_time' => 'desc'];
        }elseif ($condition == 're'){
            $order = ['comment_count' => 'desc'];
        }

        $from = input('from');
        $start = 0;
        $size = 12;
        if($from == '' || $from == 'zong'){
            //综合数据
            $whereData['is_head_figure'] = 0;
            $composite = search('Allowance', 'User', $whereData, $order, $start, $size);
        }elseif ($from == 'wei'){
            //未结数据
            $whereData['jie'] = 0;
            $whereData['is_head_figure'] = 0;
            $composite = search('Allowance', 'User', $whereData, $order, $start, $size);
//            halt($composite);
        }elseif ($from == 'yi'){
            //已结数据
            $whereData['jie'] = 1;
            $whereData['is_head_figure'] = 0;
            $composite = search('Allowance', 'User', $whereData, $order, $start, $size);
        }elseif ($from == 'jing'){
            //精华数据
            $whereData['read_count'] = ['egt', 200];
            $whereData['is_head_figure'] = 0;
            $composite = search('Allowance', 'User', $whereData, $order, $start, $size);
        }

        //热议数据
        $newData = newData();

        //回帖周榜
        $huiData = show(model('User')->order('comment_count','desc')->limit(0,12)->select());
//        halt($huiData);

        return $this->fetch('',[
            'user' => $result,
            'data' => $data,
            'isData' => $isData,
            'top' => $top,
            'composite' => $composite,
            'from' => $from,
            'condition' => $condition,
            'type' => '',
            'newData' => $newData,
            'huiData' => $huiData,
        ]);
    }

    public function in($result){
        if($result['experience_count'] == 0){
            return 0;
        }else{
            $experience_time = $result['experience_time'];
            $experience_time = strtotime($experience_time);
            //echo $sign_time;
            $int = date('Y-m-d');
            //echo $int;
            $int = strtotime($int);
            $ints = $int + 86400;
            $int_s = $int - 86400;
            //当天已签到
            if ($int < $experience_time && $experience_time < $ints) {
                return $result['experience_count'];
            }
            //昨天未签到，积分，天数在签到修改为1
            if ($experience_time < $int_s) {
                return 0;
            }
            //请签到
            if ($int_s < $experience_time && $experience_time < $int) {
                return $result['experience_count'];
            }
        }
    }

    public function inData($result){
        if($result['experience_count'] == 0){
            return 0;
        }else{
            $experience_time = $result['experience_time'];
            $experience_time = strtotime($experience_time);
            //echo $sign_time;
            $int = date('Y-m-d');
            //echo $int;
            $int = strtotime($int);
            $ints = $int + 86400;
            $int_s = $int - 86400;
            //当天已签到
            if ($int < $experience_time && $experience_time < $ints) {
                return 1;
            }else{
                return 0;
            }
        }
    }
}