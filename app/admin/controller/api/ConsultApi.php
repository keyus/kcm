<?php
namespace app\admin\controller\api;
use think\Controller;
use think\Request;

class ConsultApi extends Controller
{
    public function access(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }

    //添加咨询日志
    public function index(Request $request){
        $data=$request->param();
        db('consult')->insert($data);

        //获取IP地址
        $url='http://api.map.baidu.com/location/ip?ak=iVkjtqXl8kZhWzckddNkX1oUPHfTkTUI&ip='.getip().'&coor=bd09ll';
        $url='http://api.map.baidu.com/location/ip?ak=iVkjtqXl8kZhWzckddNkX1oUPHfTkTUI&ip='.'182.150.27.221'.'&coor=bd09ll';
        $ip = json_decode(file_get_contents($url));
        $address='客户位置:'.$ip->address;
        sendMail(['6325610@qq.com'=>'可是','381508990@qq.com'=>'刘皮'],'兴蜀大宗sypme',$address);
    }

}
