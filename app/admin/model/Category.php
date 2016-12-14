<?php
namespace app\admin\model;
use think\Model;
use think\Session;

class Category extends Model{

   //获取分类树
   public function getTree(){
       $res=db('category')->order('sort')->select();
       if($res){
           $tree=new \com\Tree("pid","parent_id","child");
           $tree->load($res);
           return  $tree->DeepTree();
       }
       return false;
   }

   //获取单个分类
   public function getOneCate($id){
       $res=db('category')->find($id);
       return $res;
   }




}