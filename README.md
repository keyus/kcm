# kcm 简单内容管理系统 
基于thinkphp5.0.3版本（基本，没有做权限管理模块）
<p>前台演示：采用金融网站 sypme com 进行演示</p>
<p>后台演示：</p>
<p>自行安装配置 数据库默认用户名:admin 密码: hkwooo</p>
<p>后台访问路径：xxx.com/admin </p>
<blockquote>
<p>ThinkPHP5的运行环境要求PHP5.4以上。</p>
</blockquote>

<h2>目录结构</h2>

<pre><code>www  WEB部署目录（或者子目录）
├─app                   应用目录
│  ├─admin              公共模块目录（可以更改）
│  │  ├─controller      后台控制 
│  │  ├─model           后台模型层，用于查询数据  
│  │  └─view            后台视图文件夹
|  |
│  ├─web                模块目录
│  │  ├─controller      前台页面控制器  
│  │  ├─view            前台视图
│  │  └─common.php      前台公用函数
│  │
│  ├─command.php        没使用
│  ├─common.php         后台公共函数
│  └─tags.php           没用到
│
├─config                网站配置目录
│  ├─config.php         配置
│  ├─database.php       数据库配置
│  └─route.php          路由配置（全站基于路由）
│
├─extend                扩展目录
│  └─com                组件目录
│     └─Tree.php        树形类
│
├─public                资源目录
|  ├─asset              后台资源目录
│  ├─ueditor            UE编辑器库
│  ├─upload             上传目录
│  └─web                前台资源目录
│
├─runtime               缓存目录
├─think                 thinkphp框架
└─vendor                ....包
└─kcm.sql               mysql数据库

</code></pre>

<h2>使用配置</h2>
<ul>
<li>  虚拟机网站根目录，定位到public目录</li>
<li>  自行建创数据库，导入kcm.sql</li>
<li>  修改/config/database.php 数据库配置;默认：数据库kcms 用户名：root 密码root 表前缀ke_</li>
</ul>

<h2>功能模块</h2>
<ul>
<li>  分类模块
        <p>1.支持三级分类</p>
</li>
<li>  文章列表
        <p>1.文章列表缩略图，支持大图预览</p>
</li>
<li>  栏目管理（单页）</li>
<li>  轮播管理</li>
<li>  咨询日志
        <p>1.前台点击咨询QQ时，记录用户IP，并转换为城市,记录到后台咨询日志</p>
        <p>2.实时邮件通知,在/app/common.php sendMail函数中配置邮件服务器，及收件人</p>
</li>
<li>  友情链接
        <p>1.支持分类管理</p>
        <p>2.支持上传图片</p>
        <p>3.列表图片大图预览</p>
</li>
<li>  网站配置</li>
</ul>

<h2>注意事项</h2>

<ul>
<li>  后台弹出提示组件使用到了layer</li>
<li>  删除，以及其它路由，采用API方式调用。一般每个页面对应相同的JS文件</li>
<li>  图片上传，实时预览用到了es5的API，实时显示上传图片。请使用支持html5的浏览器</li>
</ul>

