<?php
session_start();

$username = trim($_POST['username']);
$pw = trim($_POST['pw']);
$code = $_POST['code'];
//判断验证码是否正确
if(strtolower($_SESSION['captcha']) == strtolower($code)){
    $_SESSION['captcha'] = '';
}
else{
    $_SESSION['captcha'] = '';
    echo "<script>alert('验证码错误');location.href='login.php?id=3';</script>";
    exit;
}
// 进行必要的验证
if(!strlen($username) || !strlen($pw)){
    echo "<script>alert('用户名和密码必填');history.back();</script>";
    exit;
}
else{
    if(!preg_match('/^[a-zA-Z0-9]{3,10}$/',$username)){
        echo"<script>alert('用户名必填，且智能大小写字符和数字构成，长度为3-10个字符！');history.back();</script>";
        exit;
    }
    if(!preg_match('/^[a-zA-Z0-9_*]{6,10}$/',$pw)){
        echo"<script>alert('密码必填，且智能大小写字符和数字、下划线、*号构成，长度为6-10个字符！');history.back();</script>";
        exit;
    }
}
// 判断是否登录成功
include_once "conn.php";
$sql = "SELECT * FROM info where username = '$username' and pw='".md5($pw)."'";

$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
if($num){
    $_SESSION['LoggedUsername'] = $username;
    // 判断是否是管理员
    $info = mysqli_fetch_array($result);
    if($info['admin']){
        $_SESSION['isAdmin'] = 1;
    }
    else{
        $_SESSION['isAdmin'] = 0;
    }
    echo "<script> alert('login successfully');location.href = 'index.php';</script>";
}
else{
    unset($_SESSION["isAdmin"]);
    unset($_SESSION['LoggedUsername']);
    
    echo "<script> alert('login failed');history.back();</script>";
}
