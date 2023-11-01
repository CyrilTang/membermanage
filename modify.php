<?php
session_start();
$source = $_GET['source'] ?? '';
$page = $_GET['page'] ?? '';
if(!$source or ($source <> 'admin') and ($source <> 'member')){
    echo "<script>alert('页面来源错误')；location.href = 'index.php'</script>";
    exit;
}
if($page){
    if(!is_numeric($page)){
        echo "<script>alert('参数错误')；location.href = 'index.php'</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会员注册管理系统</title>
    <style>
        .main{margin:0 auto; text-align:center;}
        h2{fontsize:16px}
        h2 a {color:navy;text-decoration:none;margin-right:15px;}
        h2 a:last-child {margin-right:0}
        h2 a:hover {color:brown;text-decoration:underline}
        .current {color: #000;}
        .red{color:red;}
    </style>
</head>
<body>
    <div class="main">
        <?php
        include_once 'nav.php';
        include_once 'conn.php';
        $username = $_GET['username'] ?? '';
        if ($username){//说明有username参数，说明是管理员修改
            $sql = "select * from info where username = '$username'";
        }
        else{//会员登录修改
            $sql = "select * from info where username = '".$_SESSION['LoggedUsername']."'";
        }
       
      
        $result = mysqli_query($conn, $sql);
    
        if(mysqli_num_rows($result)){
            $info = mysqli_fetch_array($result);
            $fav = explode(",",$info['fav']);
            // print_r($fav);
        }else{
            die("未找到有效用户");
        }
        ?>
        <form action="postModify.php" method="post" onsubmit="return check()">
            <table align="center" border="1" style="border-collapse:collapse" cellpadding="10" cellspacing="0">
                <tr>
                    <td>用户名</td>
                    <td ><input name="username" readonly value="<?php echo $info['username'];?>"></td>
                </tr>
                <tr>
                    <td>密码</td>
                    <td ><input type="password" name="pw" placeholder="不修改密码请留空"></span></td>
                </tr>
                <tr>
                    <td>确认密码</td>
                    <td ><input type="password" name="cpw" placeholder="不修改密码请留空"></td>
                </tr>
                <tr>
                    <td>性别</td>
                    <td >
                        <input name="sex" type="radio" <?php if($info['sex']){ ?> checked <?php } ?> value="1">男
                        <input name="sex" type="radio" <?php if(!$info['sex']){ echo "checked"; } ?> value="0">女
                    </td>
                </tr>
                <tr>
                    <td>信箱</td>
                    <td ><input name="email" value="<?php echo $info['email'];?>"></td>
                </tr>
                <tr>
                    <td>爱好</td>
                    <td >
                        <input name="fav[]" type="checkbox" <?php if(in_array('听音乐',$fav)){echo "checked"; } ?> value="听音乐">听音乐
                        <input name="fav[]" type="checkbox" <?php if(in_array('玩游戏',$fav)){echo "checked"; } ?> value="玩游戏">玩游戏
                        <input name="fav[]" type="checkbox" <?php if(in_array('踢足球',$fav)){echo "checked"; } ?> value="踢足球">踢足球
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="提交">
                    </td>
                    <td>    
                        <input type="reset" value="重置">
                        <input type="hidden" name="source" value="<?php echo $source; ?>"></input>
                        <input type="hidden" name="page" value="<?php echo $page; ?>"></input>
                    </td>
                    
                </tr>
            </table>
        </form>
    </div>
    <script>
        function check(){
         
       
            let pw = document.getElementsByName("pw")[0].value.trim();
            let cpw = document.getElementsByName("cpw")[0].value.trim();
            let email = document.getElementsByName("email")[0].value.trim();
        
            //密码验证
            let pwReg = /^[a-zA-Z0-9_*]{6,10}$/;
            // 判断是否更改密码
            if(pw.length > 0){
                if(!pwReg.test(pw)){
                alert('密码必填，且智能大小写字符和数字、下划线、*号构成，长度为6-10个字符！');
                return false;
            }
            else{
                if(pw != cpw){
                    alert('密码与确认密码必须相同');
                    return false;
                }
      
            }
            }
           
            //确认邮箱

            let emailReg = /^[A-Za-z0-9]+([-._][A-Za-z0-9]+)*@[A-Za-z0-9]+(-[A-Za-z0-9]+)*(\.[A-Za-z]{2,6}|[A-Za-z]{2,4}\.[A-Za-z]{2,3})$/;

            if(email.length > 0){
                if(!emailReg.test(email)){
                    console.log('1');
                    alert('信箱格式不正确');
                    return false;
                }
            }
            return true;
         }
    </script>
</body>
</html>