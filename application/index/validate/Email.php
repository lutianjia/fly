<?php


namespace app\index\validate;


use think\Validate;

class Email extends Validate
{
    protected $rule = [
        ['email' , 'require|email','请输入邮箱|邮箱格式错误'],
    ];
}