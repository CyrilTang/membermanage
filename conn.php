<?php
// connect database
// 第一步 连接数据库
$conn = mysqli_connect("localhost", "member", "123456", "member");
// 判断是否连接成功
// 如果成功则返回true，失败返回false

if(!$conn){
    die("Error connecting");
}


// set utf-8 encoding
mysqli_query($conn,"set names utf8");