<?php


namespace app\index\validate;


use think\Validate;

class Reviset extends Validate
{
    protected $rule = [
        ['nowpass' , 'require|min:6|max:25','请输入旧密码|旧密码最少6位|旧密码最多25位'],
        ['password' , 'require|min:6|max:25|confirm','请输入密码|密码最少6位|密码最多25位|密码与确认密码不一致'],
        ['password_confirm' , 'require','请输入确认密码'],
    ];
}