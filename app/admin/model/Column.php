<?php
namespace app\admin\model;
use think\Model;

class Column extends Model{

    public function getCol($id=null){
        if(intval($id)){
            return $this->find($id);
        }
        return $this->order('id desc')->select();
    }

}