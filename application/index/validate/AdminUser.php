<?php


namespace app\index\validate;


use think\Validate;

class AdminUser extends Validate
{
    protected $rule = [
        ['email' , 'require|email','请输入邮箱|邮箱格式错误'],
        ['password' , 'require|min:6|max:25','请输入密码|密码最少6位|密码最多25位'],
        ['vercode' , 'require|eq:15','请输入验证问题|问题回答错误'],
    ];
}