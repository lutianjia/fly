<?php


namespace app\index\validate;


use think\Validate;

class Forget  extends Validate
{
    protected $rule = [
        ['email' , 'require|email','请输入邮箱|邮箱格式错误'],
        ['vercode' , 'require|eq:15','请输入验证问题|问题回答错误'],
    ];
}