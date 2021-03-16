<?php


namespace app\Tool;


class Rand
{
    public function rand(){
        $i = rand(1000,9999);
        return $i;
    }
}