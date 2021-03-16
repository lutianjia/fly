<?php


namespace app\admin\controller;


use think\Db;

class Article extends Base
{
    public function index(){
        $data = input('param.');
//           halt($data);
        if(empty($data['from'])){
            $data['class'] = '';
        }
        $whereData = [];
        //转换查询条件
        if (!empty($data['start_time']) && !empty($data['end_time']) && $data['end_time'] > $data['start_time']) {
            $whereData['a.create_time'] = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])],
            ];
        }
        if ($data['class'] === '') {
            $class = 1;
        }elseif($data['class'] == 0){
            $class = 0;
            $whereData['class'] = intval($data['class']);
        }else{
            $class = $data['class'];
            $whereData['class'] = intval($data['class']);
        }
        if (!empty($data['title'])) {
            $whereData['title'] = ['like', '%' . $data['title'] . '%'];
        }
        //获取表里的数据
        $detail = show(model('Allowance')->getArticlesByCondition($whereData));
        if (!empty($data['start_time']) && !empty($data['end_time']) && $data['end_time'] > $data['start_time']) {
            $whereData['create_time'] = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])],
            ];
        }
        unset($whereData['a.create_time']);
        $count = show(model('Allowance')->getArticlesCountByCondition($whereData));

        return $this->fetch('article/article-list', [
            'detail' => $detail,
            'cats' => config('cat.lists'),
            'start_time' => empty($data['start_time']) ? '' : $data['start_time'],
            'end_time' => empty($data['end_time']) ? '' : $data['end_time'],
            'class' => $class,
            'title' => empty($data['title']) ? '' : $data['title'],
            'count' => $count,
        ]);
    }
}