<?php
$username = trim($_POST['username']);
$pw = trim($_POST['pw']);
$cpw = trim($_POST['cpw']);
$sex = $_POST['sex'];
$email = $_POST['email'];
$fav = @implode(',', $_POST['fav']);
$source = $_POST['source'];
$page = $_POST['page'];

// 进行必要的验证
if(!strlen($username)){
    echo "<script>alert('用户名必填');history.back();</script>";
    exit;
}
else{
    if(!preg_match('/^[a-zA-Z0-9]{3,10}$/',$username)){
        echo"<script>alert('用户名必填，且智能大小写字符和数字构成，长度为3-10个字符！');history.back();</script>";
        exit;
    }
}
// 判断用户名和密码是否为空,如果为空，终止执行
// if(!strlen($username) || !strlen($pw)){
//     echo "<script> alert('username or password null'); history.back()</script>";
//     exit;
// }
if(!empty($pw)){
    //判断用户输入的密码是否相同
    if($pw <> $cpw){
        echo "<script> alert('Please confirm if the passwords entered are the same'); history.back()</script>";
        exit;
    }
    else{
        if(!preg_match('/^[a-zA-Z0-9_*]{6,10}$/',$pw)){
            echo"<script>alert('密码必填，且智能大小写字符和数字、下划线、*号构成，长度为6-10个字符！');history.back();</script>";
            exit;
        }
}
}

//判断邮箱
if(!empty($email)){
    if(!preg_match('/^[A-Za-z0-9]+([-._][A-Za-z0-9]+)*@[A-Za-z0-9]+(-[A-Za-z0-9]+)*(\.[A-Za-z]{2,6}|[A-Za-z]{2,4}\.[A-Za-z]{2,3})$/',$email)){
        echo"<script>alert('信箱格式不正确！');history.back();</script>";
        exit;
    }

}
include_once 'conn.php';

if($pw){//说明有填写密码，要更新密码
    $sql = "update info set pw ='".md5($pw)."',email='$email',sex='$sex',fav='$fav' where username ='$username' ";
    $url = 'Logout.php';
}
else{
    $sql = "update info set email='$email',sex='$sex',fav='$fav' where username ='$username' ";
    $url = 'index.php';
}
if($source == 'admin'){
    $url='admin.php?id=5&page='. $page;
}

$result = mysqli_query($conn, $sql);
if($result){
    echo "<script>alert('更新个人资料成功');location.href ='$url';</script>";
}
else{
    echo "<script>alert('更新失败');history.back();</script>";
}