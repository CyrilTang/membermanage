<?php
session_start();
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
        .none{width: 20px;display:none}
    </style>
</head>
<body>
    <div class="main">
    <?php
        include_once 'nav.php';
        ?>
        <form action="postLogin.php" method="post" onsubmit="return check()">
            <table align="center" border="1" style="..." cellpadding="10" cellspacing="0">
                <tr>
                    <td>用户名</td>
                    <td ><input name="username" id="username" onblur="checkUsername()"><span class="red">*</span>
                    <img src="img/no.png" id="no" class="none">
                    <img src="img/ok.png" id="ok" class="none">
                </td>
                </tr>
                <tr>
                    <td>密码</td>
                    <td ><input type="password" name="pw"><span class="red">*</span>
                  
                </td>
                </tr>
                <tr>
                    <td>验证码</td>
                    <td ><input name="code"  placeholder="请输入验证码"  onblur="checkUsername()"><img style="cursor:pointer" src="code.php" onclick="this.src='code.php?'+ new Date().getTime()" width="200" height="70"><span class="red">*</span>
                  
                </td>
                </tr>
           
                <tr>
                    <td>
                        <input type="submit" value="提交">
                    </td>
                    <td>    
                        <input type="reset" value="重置">
                    </td>
                    
                </tr>
            </table>
        </form>
    </div>
    <script src="https://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
    <script>
        function checkUsername(){
            let username = $('#username').val().trim();
            if(username.length == 0){
                $("#no").hide();
                $("#ok").hide();
                return;
            }else{
            let usernameReg = /^[a-zA-Z0-9]{3,10}$/;
            if(!usernameReg.test(username)){
                alert('用户只能由大小写字符和数字构成，长度为3-10个字符！');
                return;
            }
            $.ajax({
                url:'checkUsername.php',
                type:'post',
                dataType:'json',
                data:{username:username},
                success:function(d){
                    if(d.code == 0){
                        //用户名正确
                        $("#no").hide();
                        $("#ok").show();
                    }else if(d.code == 2){
                        //用户名不正确
                        $("#no").show();
                        $("#ok").hide();
                    }
                },
                error:function(){
                    $("#no").hide();
                    $("#ok").hide();
                }

            })

        }}
        function check(){
            let username = document.getElementsByName("username")[0].value.trim();
            console.log(username);
            let pw = document.getElementsByName("pw")[0].value.trim();
          
            // 用户名验证
            let usernameReg = /^[a-zA-Z0-9]{3,10}$/;
            if(!usernameReg.test(username)){
                alert('用户名必填，且只能大小写字符和数字构成，长度为3-10个字符！');
                return false;
            }
            //密码验证
            let pwReg = /^[a-zA-Z0-9_*]{6,10}$/;
            if(!pwReg.test(pw)){
                alert('密码必填，且智能大小写字符和数字、下划线、*号构成，长度为6-10个字符！');
                return false;
            }
            let code = document.getElementsByName('code')[0].value.trim();
            let codeReg = /^[a-zA-Z0-9]{4}$/;
            if(!codeReg.test(code)){
            alert('验证码必填，且只能由大小写字符和数字构成，长度为4个字符！');
       
        
            return true;
         }
    </script>
</body>
</html>