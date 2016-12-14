<?php
namespace app\admin\controller\api;
use \think\Controller;
class CategoryApi extends Controller
{
    public function access(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }
    //添加或编辑分类
    public function edit($name,$is_nav,$sort,$parent_id,$category_id){
        $this->access();
        $data = [
            'name'=>$name,
            'is_nav'=>$is_nav,
            'sort'=>$sort,
            'parent_id'=>$parent_id
        ];
        if($category_id){
            //更新
            $res=db('category')->where('pid',$category_id)->update($data);
            if($res){
                return ['success'=>true,'msg'=>'保存成功'];
            }
            return ['fail'=>true,'msg'=>'保存失败，请稍候再试'];

        }else{
            //添加
            if(db('category')->where('name',$name)->find()){
                return ['fail'=>true,'msg'=>'分类名已存在'];
            }
            if(db('category')->insert($data)){
                return ['success'=>true,'msg'=>'添加成功'];
            }
            return ['fail'=>true,'msg'=>'添加失败，请稍候再试'];
        }
    }

    //删除分类
    public function delete($pid){
        $this->access();


        //查看是否有子分类
        $child=db('category')->where('parent_id',$pid)->find();
        if($child){
            return ['fail'=>true,'msg'=>'请删除此分类下所有子分类'];
        }
        $res=db('category')->where('pid',$pid)->delete();
        if($res){
            return ['success'=>true,'msg'=>'删除成功'];
        }
        return ['fail'=>true,'msg'=>'删除失败，请稍候再试'];
    }

}
