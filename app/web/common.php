<?php
// web应用公共文件

//获取文章内容及条数
/**
 *$catid  分类ID
 *$count  数量 默认5条
 */
function getC($catid=0,$count=5){
    return db('article')
        ->field('id,title,title_color,author,fromto,inputer,created_time')
        ->where('pid',$catid)
        ->order('id desc')
        ->limit($count)
        ->select();
}

/**
 * @param $time
 * @return false|string格式化日期
 */
function format($time){
    $str = strtotime($time);
    return date('Y-m-d',$str);
}

/**
 * 获取指定id文章  id为表主键
 * @param $id
 * @return array|false|PDOStatement|string|\think\Model
 */
function getA($id){
    return db("article")->alias('a')
        ->field('a.id,title,title_color,body,summary,author,fromto,inputer,a.pid,thumb,a.hot,a.top,a.keyword,read_count,a.created_time,a.updated_time,b.name as cate_name,b.parent_id as cate_parentid')
        ->join('category b','a.pid = b.pid','left')
        ->find($id);
}

function getACate($id){
//    $pid=db('article')->where('id',$id)->value('pid');
//
//    dump( db('category')
//        ->alias('a')
//        ->field('a.pid,a.name,b.pid as cat_id,b.name as cat_name')
//        ->where('pid',$pid)
//        ->join('category b','a.parent_id = b.pid','left')
//        ->find()
//    );
}

/**
 * 获取分类树
 * @return array|bool
 */
function cateTree(){
    $res=db('category')->order('sort')->select();
    if($res){
        $tree=new \com\Tree("pid","parent_id","child");
        $tree->load($res);
        return  $tree->DeepTree();
    }
    return false;
}


/**
 * 获取指定分类及子分类的文章
 * @param int $pid
 * @param int $limit
 * @return \think\paginator\Collection
 */
function getPA($pid=0,$limit=10){
    $cat_array=[$pid];
    foreach (cateTree() as $k=>$v){
        if($v['pid']==$pid && array_key_exists('child',$v)){
            foreach ($v['child'] as $fk=>$fv){
                array_push($cat_array,$fv['pid']);
                if(array_key_exists('child',$fv)){
                    foreach ($fv['child'] as $sk=>$sv){
                        array_push($cat_array,$sv['pid']);
                    }
                }
            }
        }
    }
    return db('article')
        ->where(['pid'=>['in',$cat_array]])
        ->order('id desc')
        ->paginate($limit);
}

function getCName($pid){
    return db('category')->field('pid,name')->find($pid);
}

/**
 * 获取站点配置
 * @return array|false|PDOStatement|string|\think\Model
 */
function getSite(){
    return db('site')->find(1);
}

/**金融网站链接
 * @param $pid  分类ID
 * @param int $num  条数
 * @return false|PDOStatement|string|\think\Collection
 */
function getlinks($pid,$num=6){
    return db('link')->where('pid',$pid)->limit($num)->select();
}


/**
 * 获取轮播图列表
 * @param int $num
 * @return false|PDOStatement|string|\think\Collection
 */
function getSlider($num=4){
    return db('slider')->limit($num)->select();
}

/**
 * 获取单个栏目
 * @param $id
 */
function getColumn($url=null){
    $res=db('column')->where('url',$url)->find();
    if(intval($res['is_vist'])){
        return $res;
    }
    return false;
}


