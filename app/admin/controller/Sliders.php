<?php
namespace app\admin\controller;
use \think\Controller;
use \app\admin\model\Slider;
use think\Cookie;
use think\Request;

class Sliders extends Controller
{
    public function _initialize(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }
    public function model(){
        return new Slider;
    }

    //主页
    public function index(){
        $this->assign('list',$this->model()->getSlider());
        return $this->fetch();
    }

    //添加与更新
    public function edit(){
        $slider=false;
        $id=intval(Cookie::get('slider_id'));
        if($id){
            $slider=$this->model()->getSlider($id);
        }
        $this->assign('slider',$slider);
        return $this->fetch();
    }



}
