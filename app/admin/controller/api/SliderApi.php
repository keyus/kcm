<?php
namespace app\admin\controller\api;
use think\Controller;
use think\Cookie;
use think\Request;

class SliderApi extends Controller
{
    public function access(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }

    //添加或编辑轮播图
    public function edit(Request $request){
        $this->access();
        $img=null;
        $slider_id=$request->param('slider_id');
        $data=$request->param();
        unset($data['slider_id']);

//        halt($data);

        //上传图片
        $file=$request->file('img');
        if($file){
            $info = $file->move(ROOT_PATH.'public' . DS . 'upload/slider');
            if($info){
                $img='/upload/slider/'.str_replace('\\','/',$info->getSaveName());
                $data['img']=$img;
            }else{
                $this->redirect(ADMIN_ROUTE.'slider/edit');
            }
        }

        //判断是否有轮播图id
        if($slider_id){
            //更新
            if(!$request->param("is_use")){ $data['is_use']=0; }
            db('slider')->where('id',$slider_id)->update($data);
            Cookie::set('save_slider','1');
            $this->redirect(ADMIN_ROUTE.'slider/edit');
        }else{
            //添加
            $res=db('slider')->insert($data);
            if($res){
                Cookie::set('save_slider','1');
            }else{
                Cookie::set('save_slider','0');
            }
            $this->redirect(ADMIN_ROUTE.'slider/edit');
        }
    }

    //删除
    public function delete($id){
        if($id){
            if(db('slider')->delete($id)){
                return ['success'=>true,'msg'=>'删除成功'];
            }
            return ['fail'=>true,'msg'=>'删除失败'];
        }
    }

}
