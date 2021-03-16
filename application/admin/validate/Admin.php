<?php


namespace app\admin\validate;


use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        ['account' , 'require|min:4|max:20','请输入账号|账号最少4位|账号最多20位'],
        ['password' , 'require|min:6|max:20','请输入密码|密码最少6位|密码最多20位'],
        ['code' , 'require','请输入验证码'],
    ];
}