<?php
namespace app\admin\model;
use think\Model;

class Consult extends Model{

    //获取所有轮播图片
    public function getPage(){
        return $this->order('id desc')->paginate(50);
    }

}