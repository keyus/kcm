<?php
namespace app\admin\model;
use think\Model;

class Article extends Model{

   //获取分页列表
   public function getPage(){
       $res=db('article')->alias('a')
           ->field('a.id,a.title,a.title_color,a.author,a.fromto,a.inputer,a.pid,b.name as pid_name,a.thumb,hot,top,a.sort,read_count,created_time,updated_time')
           ->join('__CATEGORY__ b','a.pid = b.pid','left')
           ->order('id desc')
           ->paginate();
       return $res;
   }

   //获取单个文章
   public function getOneArticle($id){
       $res=$this->where('id',$id)->find();
       return $res;
   }

    //搜索
    public function search($filter,$category,$tree){
        //input为空
        if(empty($filter)){
            //只筛选分类文章
            if($category){
                //不等0，

                //获取所有子分类的主键id键
                $cat_array=[$category];
                foreach ($tree as $k=>$v){
                    if($v['pid']==$category && array_key_exists('child',$v)){
                        foreach ($v['child'] as $fk=>$fv){
                            array_push($cat_array,$fv['pid']);
                            if(array_key_exists('child',$fv)){
                                foreach ($fv['child'] as $sk=>$sv){
                                    array_push($cat_array,$sv['pid']);
                                }
                            }
                        }
                    }
                }

                //查询分类及子分类文章
                $res=db('article')->alias('a')
                    ->field('a.id,a.title,a.title_color,a.author,a.fromto,a.inputer,a.pid,b.name as pid_name,a.thumb,hot,top,a.sort,read_count,created_time,updated_time')
                    ->where(['a.pid'=>['in',$cat_array]])
                    ->join('__CATEGORY__ b','a.pid = b.pid','left')
                    ->order('id desc')
                    ->paginate();

            }else{
                //$category=0; 查询所有文章
                $res=db('article')->alias('a')
                    ->field('a.id,a.title,a.title_color,a.author,a.fromto,a.inputer,a.pid,b.name as pid_name,a.thumb,hot,top,a.sort,read_count,created_time,updated_time')
                    ->join('__CATEGORY__ b','a.pid = b.pid','left')
                    ->order('id desc')
                    ->paginate();
            }

        }else{
            //查询input搜索结果
            $filter_res=intval($filter);
            if($filter_res){
                //转换id整型成功

                $res=db('article')->alias('a')
                    ->field('a.id,a.title,a.title_color,a.author,a.fromto,a.inputer,a.pid,b.name as pid_name,a.thumb,hot,top,a.sort,read_count,created_time,updated_time')
                    ->where('id',$filter)
                    ->join('__CATEGORY__ b','a.pid = b.pid','left')
                    ->paginate();

            }else{
                //$filter为一个字符串，即搜索标题
                $filter='%'.$filter.'%';

                $res=db('article')->alias('a')
                    ->field('a.id,a.title,a.title_color,a.author,a.fromto,a.inputer,a.pid,b.name as pid_name,a.thumb,hot,top,a.sort,read_count,created_time,updated_time')
                    ->where('title','like',$filter)
                    ->join('__CATEGORY__ b','a.pid = b.pid','left')
                    ->order('id desc')
                    ->paginate();

            }

        }

        return $res;

    }

}