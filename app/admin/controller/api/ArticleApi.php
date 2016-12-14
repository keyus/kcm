<?php
namespace app\admin\controller\api;
use think\Controller;
use think\Cookie;
use think\Request;

class ArticleApi extends Controller
{
    public function access(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }

    //添加或编辑文章
    public function edit(Request $request){
        $this->access();
        $img=null;
        $article_id=$request->param('article_id');
        $data=$request->param();
        unset($data['article_id']);

        //上传图片
        $file=$request->file('thumb');
        if($file){
            $info = $file->move(ROOT_PATH.'public' . DS . 'upload/thumb');
            if($info){
                $img='/upload/thumb/'.str_replace('\\','/',$info->getSaveName());
                $data['thumb']=$img;
            }else{
                Cookie::set('upload_article','0');   //上传失败
                $this->redirect(ADMIN_ROUTE.'article/edit');
            }
        }

        //判断是否有文章id
        if($article_id){
            //修正时间，如果新的时间错误则不更新
            if(empty($request->param('created_time')) || isDateTime($request->param('created_time')) ){
                unset($data['created_time']);
            }
            if(empty($request->param('updated_time'))  || isDateTime($request->param('created_time')) ){
                unset($data['updated_time']);
            }
            //更新
            if(!$request->param('top')){ $data['top']=0; }
            if(!$request->param('hot')){ $data['hot']=0; }
            db('article')->where('id',$article_id)->update($data);
            Cookie::set('upload_article','1');
            $this->redirect(ADMIN_ROUTE.'article/edit');
        }else{
            //修正时间
            if(empty($request->param('created_time')) || isDateTime($request->param('created_time')) ){
                $data['created_time']=date("Y-m-d H:i:s",time());
            }
            if(empty($request->param('updated_time'))  || isDateTime($request->param('created_time')) ){
                $data['updated_time']=date("Y-m-d H:i:s",time());
            }
            //添加
            $res=db('article')->insert($data);
            if($res){
                Cookie::set('upload_article','1');
            }else{
                Cookie::set('upload_article','0');
            }
            $this->redirect(ADMIN_ROUTE.'article/edit');
        }
    }

    //删除文章
    public function delete(Request $request){
        $id=$request->param('id');
        $id=explode(",",$id);
        if($id){
            if(db('article')->delete($id)){
                return ['success'=>true,'msg'=>'删除成功'];
            }
            return ['fail'=>true,'msg'=>'删除失败'];
        }
    }

}
