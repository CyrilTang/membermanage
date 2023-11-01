<?php
// 判断是否为管理员
session_start();
if (!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"]){
    echo"<script>alert('You are not allowed to');location.href='login.php';</script>";
    exit;
}
?>