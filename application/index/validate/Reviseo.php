<?php


namespace app\index\validate;


use think\Validate;

class Reviseo extends Validate
{
    protected $rule = [
        ['email' , 'require|email','请输入邮箱|邮箱格式错误'],
        ['nickname' , 'require|max:15','请输入昵称|昵称最多15位'],
        ['sex' , 'in:女,男','性别提交错误'],
        ['sign' , 'max:100','签名最多100位'],
    ];
}