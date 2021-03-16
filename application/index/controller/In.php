<?php


namespace app\index\controller;




use think\Controller;
use think\Session;

class In extends Controller
{
    /*
     * 签到
     */
    public function index(){
            $result = $this::message();
            if(!$result){
                return $this->result('', 0, '请先登录');
            }
            if($result['experience_count'] == 0){
                $data['experience_count'] = 1;
                $data['experience_time'] = date('Y-m-d H:s:i',time());
                $data['experience'] = $result['experience'] + 5;
                $data['time'] = time();
                $udata = $data;
                $udata['num'] = 5;
                try{
                    model('User')->where('email' , $result['email'])->update($data);
                }catch (\Exception $e){
                    return $this->error($e->getMessage());
                }
                return $this->result($udata, 1, '签到成功！请记得再来哦！');
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
                    return $this->result('', 0, '今天您已经签过到了，请明天再来！');
                }
                //昨天未签到，积分，天数在签到修改为1
                if ($experience_time < $int_s) {
                    $data['experience_count'] = 1;
                    $data['experience_time'] = date('Y-m-d H:s:i');
                    $data['experience'] = $result['experience'] + 5;
                    $data['time'] = time();
                    $udata = $data;
                    $udata['num'] = 5;
                    try{
                        model('User')->where('email' , $result['email'])->update($data);
                    }catch (\Exception $e){
                        return $this->error($e->getMessage());
                    }
                    return $this->result($udata, 1, '签到成功！请记得再来哦！');
                }
                //请签到
                if ($int_s < $experience_time && $experience_time < $int) {
                    $data['experience_count']= $result['experience_count'] + 1;
                    $data['experience_time'] = date('Y-m-d H:s:i');
                    if($result['experience_count'] <= 4){
                        $num = 5;
                    }elseif ($result['experience_count'] <= 14){
                        $num = 10;
                    }elseif ($result['experience_count'] <= 29){
                        $num = 15;
                    }elseif ($result['experience_count'] >= 30){
                        $num = 20;
                    }
                    $data['experience'] = $result['experience'] + $num;
                    $data['time'] = time();
                    try{
                        model('User')->where('email' , $result['email'])->update($data);
                    }catch (\Exception $e){
                        return $this->error($e->getMessage());
                    }
                    $udata = $data;
                    $udata['num'] = $num;
                    return $this->result($udata, 1, '签到成功！请记得再来哦！');
                }
            }
    }

    /*
     * 签到榜
     */
    public function signin(){
        $start = strtotime(date("Y-m-d"),time());
        $end = $start+60*60*24;

        $udata['time'] = [
            ['gt', $start],
            ['lt', $end],
        ];
        $order = ['time' => 'desc'];
        $newIn = model('User')->getInsbyCondition($udata,$order);

        $order = ['time' => 'asc'];
        $speedIn = model('User')->getInsbyCondition($udata,$order);

        $udata='';
        $order = ['experience_count' => 'desc'];
        $totleIn = model('User')->getInsbyCondition($udata,$order);

        $data['0'] = $newIn;
        $data['1'] = $speedIn;
        $data['2'] = $totleIn;

        return showIn(0, $data, 200);
    }

    /*
     * 获取用户信息
     */
    public function message(){
        $email = Session::get('fly.email');

        $result = model('User')->where('email', $email)->find();
        return $result;
    }
}