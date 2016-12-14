<?php
namespace app\admin\controller\api;
use \think\Controller;
use think\Cookie;
use think\Request;

class LinksApi extends Controller
{
    public function access(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }

    //添加或编辑分类
    public function edit(Request $request){
        $this->access();
        $data=$request->param();
        $links_id=$request->param('links_id');
        unset($data['links_id']);

        //上传链接图片,如果超过300px宽，会做缩放裁剪
        $file=$request->file('img');
//        halt($file);
        if($file){
            $file_name=sha1($file->getFilename());
            $image = \think\Image::open($file);
            $width = $image->width();
            $type = $image->type();
            if($width>300){
                $path=ROOT_PATH.'public';
                if(checkPaths($path)){
                    $img_path='/upload/links/'.date('Y').'/'.$file_name.'.'.$type;
                    $image->thumb(300, 300)->save($path.$img_path);
                    $data['img']=$img_path;
                }
            }
        }

        //判断友情链接id是否值为真
        if($links_id){
            //更新
            if(!$request->param('is_remote')){ $data['is_remote']=0; }
            if(!$request->param('nofollow')){ $data['nofollow']=0; }
            db('link')->where('id',$links_id)->update($data);
            Cookie::set('links_save','1');
            $this->redirect(ADMIN_ROUTE.'links/edit');
        }else{
            //添加
            $res=db('link')->insert($data);
            if($res){
                Cookie::set('links_save','1');
            }else{
                Cookie::set('links_save','0');
            }
            $this->redirect(ADMIN_ROUTE.'links/edit');
        }

    }

    //删除链接
    public function delete($id){
        $this->access();
        if(intval($id)) {
            db('link')->where('id', $id)->delete();
            return ['success'=>true,'msg'=>'删除成功'];
        }
        return ['fail'=>true,'msg'=>'删除失败,请稍候再试'];
    }

    //添加编辑链接分类
    public function edit_type($name,$sort,$links_type_id){

        if(intval($links_type_id)){
            //更新分类
            $res=db('link_type')->where('pid',intval($links_type_id))->update(['name'=>$name,'sort'=>$sort]);
            if($res){
                return ['success'=>true,'msg'=>'保存成功'];
            }
            return ['fail'=>true,'msg'=>'保存失败'];
        }else{
            //添加分类
            $has=db('link_type')->where('name',$name)->find();
            if($has){
                //已存在此分类
                return ['fail'=>true,'msg'=>'分类名称已存在'];
            }
            $res=db('link_type')->insert(['name'=>$name,'sort'=>$sort]);
            if($res){
                return ['success'=>true,'msg'=>'添加成功'];
            }
            return ['fail'=>true,'msg'=>'添加失败'];
        }


    }

    //删除链接分类
    public function delete_link_type($pid){
        if(intval($pid)){
            $res=db('link_type')->delete(intval($pid));
            if($res){
                return ['success'=>true,'msg'=>'添加成功'];
            }
            return ['fail'=>true,'msg'=>'删除失败，请稍候再试'];
        }
    }

}
