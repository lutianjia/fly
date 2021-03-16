<?php


namespace app\index\validate;


use think\Validate;

class Reg extends Validate
{
    protected $rule = [
        ['email' , 'require|email','请输入邮箱|邮箱格式错误'],
        ['username' , 'require|max:15','请输入名称|名称最多15位'],
        ['password' , 'require|min:6|max:25|confirm','请输入密码|密码最少6位|密码最多25位|密码输入不一致'],
        ['password_confirm' , 'require','请输入确认密码'],
    ];
}