<?php

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    //admin router
    '[admin]' =>[
        'login' => [ 'admin/login/index' , [ 'method'=>'get' ] ],
        'logout' => [ 'admin/login/logout' , [ 'method'=>'get' ] ],
        'user/add' => [ 'admin/users/add' , [ 'method'=>'get' ] ],
        'user/edit' => [ 'admin/users/edit' , [ 'method'=>'get' ] ],
        'user' => [ 'admin/users/entry' , [ 'method'=>'get' ] ],

        //文章路由
        'category/edit'=> 'admin/categorys/edit',
        'category'=> 'admin/categorys/listing',
        'article/edit'=> 'admin/articles/edit',
        'article'=> 'admin/articles/listing',
        'site'=> 'admin/sites/index',
        'links/edit'=> 'admin/links/edit',
        'links/type'=> 'admin/links/type',
        'links/edit_type'=> 'admin/links/edit_type',
        'links'=> 'admin/links/index',
        //栏目
        'column/edit'=> 'admin/columns/edit',
        'column'=> 'admin/columns/index',

        //轮播图
        'slider/edit'=> 'admin/sliders/edit',
        'slider'=> 'admin/sliders/index',
        'consult'=> 'admin/consults/index',

        ''     => ['admin/index/index',  [ 'method'=>'get' ] ],
    ],

    /**
     * web路由
     * web router front
     */
    //列表 router
    'list/:id'=>'web/webs/listing',
    //文章 router
    'view/:id'=>'web/webs/view',
    //栏目 router
    'col/:name'=>'web/webs/column',
    //下载 router
    'down'=>'web/webs/down',
    //主页 router
    ''=>'web/webs/index',

    //api router
    '[api]'=>[
        'login_check'=>[ 'admin/api.UserApi/check' , [ 'method'=>'post' ]  ],
        'add_user'=>[ 'admin/api.UserApi/add_user' ,[ 'method'=>'post'] ] ,
        'get_user'=>[ 'admin/api.UserApi/get_user' ,[ 'method'=>'get'] ] ,
        'delete_user'=>[ 'admin/api.UserApi/delete_user' ,[ 'method'=>'post'] ] ,
        'update_user'=>[ 'admin/api.UserApi/update_user' ,[ 'method'=>'post'] ] ,
        //分类
        'edit_category'=>[ 'admin/api.CategoryApi/edit' ,[ 'method'=>'post'] ] ,
        'delete_category'=>[ 'admin/api.CategoryApi/delete' ,[ 'method'=>'post']] ,
        //内容
        'edit_article'=>[ 'admin/api.ArticleApi/edit' ,[ 'method'=>'post'] ] ,
        'delte_article'=>[ 'admin/api.ArticleApi/delete' ,[ 'method'=>'post'] ] ,
        //链接
        'edit_link'=>[ 'admin/api.LinksApi/edit' ,[ 'method'=>'post'] ] ,
        'delte_link'=>[ 'admin/api.LinksApi/delete' ,[ 'method'=>'post'] ] ,
        'edit_link_type'=>[ 'admin/api.LinksApi/edit_type' ,[ 'method'=>'post'] ] ,
        'delete_link_type'=>[ 'admin/api.LinksApi/delete_link_type' ,[ 'method'=>'post'] ] ,
        //轮播图
        'edit_slider'=>[ 'admin/api.SliderApi/edit' ,[ 'method'=>'post'] ] ,
        'delete_slider'=>[ 'admin/api.SliderApi/delete' ,[ 'method'=>'post'] ] ,
        //栏目
        'edit_column'=>[ 'admin/api.ColumnApi/edit' ,[ 'method'=>'post'] ] ,
        'delete_column'=>[ 'admin/api.ColumnApi/delete' ,[ 'method'=>'post'] ] ,
        //用户咨询日志
        'consult'=>[ 'admin/api.ConsultApi/index' ,[ 'method'=>'post'] ] ,
    ]
];
