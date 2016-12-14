<?php
namespace app\admin\controller\api;
use think\Controller;
use think\Cookie;
use think\Request;

class ColumnApi extends Controller
{
    public function access(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }

    //添加或编辑栏目
    public function edit(Request $request){
        $this->access();

        $column_id=$request->param('column_id');
        $data=$request->param();
        unset($data['column_id']);

        //判断是否有id
        if($column_id){
            //更新
            if(!$request->param('is_vist')){ $data['is_vist']=0; }
            db('column')->where('id',$column_id)->update($data);
            Cookie::set('add_column','1');
            $this->redirect(ADMIN_ROUTE.'column/edit');
        }else{
            //添加
            if(!$request->param('is_vist')){ $data['is_vist']=0; }
            $res=db('column')->insert($data);
            if($res){
                Cookie::set('add_column','1');
            }else{
                Cookie::set('add_column','0');
            }
            $this->redirect(ADMIN_ROUTE.'column/edit');
        }
    }

    //删除栏目
    public function delete(Request $request){
        $id=$request->param('id');
        $id=explode(",",$id);
        if($id){
            if(db('column')->delete($id)){
                return ['success'=>true,'msg'=>'删除成功'];
            }
            return ['fail'=>true,'msg'=>'删除失败'];
        }
    }

}
