<?php
use think\Session;
// 应用公共文件

//检查日期
function isDateTime($dateTime){
    $ret = strtotime($dateTime);
    return $ret !== FALSE && $ret != -1;
}

function isLogin(){
    if(Session::has('trade_user') && Session::has('trade_user_id') ){
//        if(time() - Session::get('login_time') > 1800){
//            return false;
//        }
        return true;
    }
    return false;
}

function logout(){
    Session::clear();
}

function checkPaths($path)
{
    if (is_dir($path)) {
        return true;
    }

    if (mkdir($path, 0755, true)) {
        return true;
    } else {
        $this->error = "目录 {$path} 创建失败！";
        return false;
    }
}


function sendMail($address,$title,$message='')
{
    $mail=new \PHPMailer;

    $mail->IsSMTP();
    $mail->CharSet='UTF-8';
    foreach ($address as $k => $v){
        $mail->AddAddress($k,$v);
    }
    $mail->Body=$message;
    // 发件人邮件。postmaster@sypme.com
    $mail->From='postmaster@sypme.com';
    // 设置发件人名字
    $mail->FromName='QQ咨询通知';
    // 设置邮件标题
    $mail->Subject=$title;
    $mail->Host='smtp.mxhichina.com';
    $mail->Port=25;
    // 设置为"需要验证"
    $mail->SMTPAuth=true;
    // 设置用户名和密码。
    $mail->Username= '';
    $mail->Password= '';
    // 发送邮件。
    return($mail->Send());
}

/**
 * 获取真实IP
 * @return bool
 */
function getip() {
    if (getenv ( "http_client_ip" ) && strcasecmp ( getenv ( "http_client_ip" ), "unknown" ))
        $ip = getenv ( "http_client_ip" );
    else if (getenv ( "http_x_forwared_for" ) && strcasecmp ( getenv ( "http_x_forwared_for" ), "unknown" ))
        $ip = getenv ( "http_x_forwared_for" );
    else if (getenv ( "remote_addr" ) && strcasecmp ( getenv ( "remote_addr" ), "unknown" ))
        $ip = getenv ( "remote_addr" );
    else if (isset ( $_SERVER ["REMOTE_ADDR"] ) && $_SERVER ["REMOTE_ADDR"] && strcasecmp ( $_SERVER ["REMOTE_ADDR"], "unknown" ))
        $ip = $_SERVER ["REMOTE_ADDR"];
    else
        $ip = "unknown";
    return $ip;
}