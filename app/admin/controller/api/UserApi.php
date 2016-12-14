<?php
namespace app\admin\controller\api;
use \app\admin\model\User;
use \think\Session;
use \think\Controller;
class UserApi extends Controller
{
    public function access(){
        if(!isLogin()){
            $this->redirect(ADMIN_ROUTE.'login');
        }
    }
    //检查用户名密码，验证码
    public function check($user,$password,$check)
    {
        if(!captcha_check($check)){
            return ['code'=>1];
        }
        $User= new User;
        if($User->checkUser($user,$password)){
            return ['success'=>true];
        }
        return ['pass'=>false];
    }
    //添加用户
    public function add_user($user,$password,$name,$company,$address,$tel,$pid,$note){
        $this->access();
        $User= new User;
        $res= $User->addUser($user,$password,$name,$company,$address,$tel,$pid,$note);
        if( $res==0 ){
            return ['fail'=>0];
        }
        if( $res==1 ){
            return ['success'=>1];
        }
        if( $res==2 ){
            return ['fail'=>2];
        }

    }
    //获取抓取数据用户
    public function get_user($id=false){
        $this->access();
        if($id){
            $res=db('user')->where('id',$id)->field(['id','user','name','company','address','tel','pid','note'])->select();
            return json($res);
        }
        $res=db('user')->alias('a')
            ->field('a.id,a.user,a.name,a.note,a.company,a.address,a.tel,b.company as pid_company')
            ->join('__USER__ b','a.pid = b.id','left')->order('id')->select();
        return json($res) ;
    }


    //删除手动添加的客户
    public function delete_custom($nid){
        $this->access();
        if( db('add_name')->where('nid',$nid)->delete() ){
            return ['success'=>true,'msg'=>'删除成功'];
        }
        return ['fail'=>true,'msg'=>'删除失败，请稍候再试'];
    }

    //删除用户
    public function delete_user($id){
        $this->access();
        //不允许删除超级管理员admin
        if($id==1){
            return ['fail'=>'不允许删除超级管理员'];
        }
        $self=false;
        if($id == Session::get('trade_user_id')){
            $self=true;
        }
        if( db('user')->where('id',$id)->delete() ){
            if($self){ logout() ;}
            return ['success'=>true,'self'=>$self];
        }
        return ['fail'=>'删除失败，请稍候再试'];
    }

    //更新用户信息
    public function update_user($id,$name,$company,$address,$tel,$pid,$note,$password){
        $this->access();
        if(Session::get('session_update_userid') != $id ){
            return ['fail'=>'服务器拒绝访问'];
        }
        $data=[
            'name'=>$name,
            'company'=>$company,
            'address'=>$address,
            'tel'=>$tel,
            'note'=>$note,
            'pid'=>$pid,
        ];
        if(!empty($password)){
            $data['password']=md5($password);
        }
        $res=db('user')->where('id',$id)
            ->update($data);
        if($res){
            return ['success'=>true];
        }
        return ['fail'=>'更新失败，请稍后再试'];
    }

    //添加一个客户.
    public function add_custom($custom_name,$account,$phone,$custom_address,$reg_time,$pid,$update){
        $this->access();
        $data=[
            'custom_name'=>$custom_name,
            'account'=>$account,
            'id'=>$pid,
            'phone'=>$phone,
            'reg_time'=>$reg_time,
            'custom_address'=>$custom_address
        ];

        //新增
        if($update=='0'){
            $repeat=db('add_name')->where('account',$account)->find();
            if($repeat) {
                return ['fail'=>true,'msg'=>'账号已存在'];
            }else{
                $res=db('add_name')->insert($data);
                if($res){
                    return ['success'=>true,'msg'=>'添加成功'];
                }
                return ['fail'=>true,'msg'=>'添加失败，请稍候再试'];
            }
        }
        //更新
        else{
            $res=db('add_name')->where('nid',$update)->update($data);
            if($res){
                return ['success'=>true,'msg'=>'保存成功'];
            }
        }


    }

}
