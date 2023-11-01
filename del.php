<?php
include_once 'checkAdmin.php';
include_once 'conn.php';
$id = $_GET['id'];
$username = $_GET['username'];
if(is_numeric($id)) {
    $sql = "delete from info where id =$id";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo "<script>alert('delete successlly');location.href = 'admin.php'</script>";
    }
    else{
        echo "<script>alert('delete failed');history.back();</script>";
    }
  
}else{
    echo "<script>alert('参数错误');history.back();</script>";
}