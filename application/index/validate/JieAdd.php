<?php


namespace app\index\validate;


use think\Validate;

class JieAdd extends Validate
{
    protected $rule = [
        ['class' , 'require','请选择专栏'],
        ['title' , 'require|max:50','请输入标题|标题最多50位'],
        ['content' , 'require','请输入内容'],
        ['experience' , 'require','请选择悬赏飞吻'],
        ['vercode' , 'require|eq:15','请输入验证问题|问题回答错误'],
    ];
}