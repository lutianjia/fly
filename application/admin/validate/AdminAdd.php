<?php


namespace app\admin\validate;


use think\Validate;



class AdminAdd extends Validate
{
    protected $rule = [
        ['account' , 'require|min:4','请输入账号|账号最少4位'],
        ['password' , 'require|min:6|max:25|confirm','请输入密码|密码最少6位|密码最多25位|密码与确认密码不一致'],
        ['password_confirm' , 'require','请输入确认密码'],
    ];
}