<?php
namespace app\admin\model;
use think\Model;

class Site extends Model{

  public function getSite(){
      return $this->find();
  }

  //保存site数据
  public function savaData($data){
      return $this->where('site_id','1')->update($data);
  }

}