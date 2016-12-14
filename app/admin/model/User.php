<?php
namespace app\admin\model;
use think\Model;
use think\Session;

class User extends Model{

    //校验用户方法
    public function checkUser($user,$passwrod){
        $res=$this::get(['user' => $user]);
        if($res && $res->password == md5($passwrod) ){
            Session::set('trade_user',$user);
            Session::set('trade_user_id',$res->id);
            //Session::set('login_time',time());
            session_regenerate_id();
            return true;
        }
        return false;
    }

    //添加用户方法 Request request
    public function addUser($user,$password,$name,$company,$address,$tel,$pid,$note){
        $sql_user=$this->get(['user' => $user]);
        if($sql_user && $user == $sql_user->user  ){
            return 2;    //重名
        };

        $this->data([
            'user'=>$user,
            'password'=>md5($password),
            'name'=>$name,
            'company'=>$company,
            'address'=>$address,
            'tel' => $tel,
            'pid' =>$pid,
            'note' =>$note,
        ]);

        if($this->save()){
            return 1;
        };
        return 0;

    }

    //获取用户
    public function getUser(){
        return  db('user')->order('id')->select();
    }

    //获取所有客户
    public function getCustom($id=false){
        if($id){
            $res=db('add_name')->where('nid',$id)->find();
            return $res;
        }else{
            $res=db('add_name')->alias('a')->join('__USER__ b','a.id = b.id','left')->paginate();
            return $res;
        }
    }


}