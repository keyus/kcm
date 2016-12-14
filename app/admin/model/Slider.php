<?php
namespace app\admin\model;
use think\Model;

class Slider extends Model{

    //获取所有轮播图片
    public function getSlider($id=null){
        if($id){
            return $this->where('id',$id)->find();
        }
        return $this->order('id desc')->select();
    }

}