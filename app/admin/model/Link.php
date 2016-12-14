<?php
namespace app\admin\model;
use think\Model;

class Link extends Model{

    //获取所有链接
    public function getLinks($id=null){
        if($id){
            return $this->where('id',$id)->find();
        }
        return db('link')->alias('a')
            ->field('a.id,a.name,url,a.sort,img,img_url,is_remote,nofollow,b.name as pid')
            ->join('__LINK_TYPE__ b','a.pid = b.pid ','left')
            ->order('id desc')
            ->paginate();
    }

    //获取链接分类
    public function getLinksType($pid=null){
        if($pid){
            return db('link_type')->where('pid',$pid)->find();
        }
        return db('link_type')->order('pid desc')->select();
    }

    //筛选分类
    public function getSearch($pid){
        if(intval($pid)){
            return $this->where('pid',$pid)->order('id desc')->paginate();
        }
        return $this->order('id desc')->paginate();
    }

}