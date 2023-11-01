<?php
include_once 'conn.php';
$username = $_POST['username'];

$a = array();
if (empty($username)) { 
    $a['code'] = 1;
    $a['msg'] = '用户名不能为空';
}

else{
    $sql = "select 1 from info where username = '$username'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)){
        //找到了此用户名，则说明此用户名不可用
        $a['code'] = 0;
        $a['msg'] = '此用户名不可用';
    }
    else{
        $a['code'] = 2;
        $a['msg'] = '此用户名可用';
    }
}
echo json_encode($a);