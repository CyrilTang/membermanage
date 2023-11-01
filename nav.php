<style>
        
        .current {color: #000;}
        .Logged{font-size:16px;color:green}
        .Logout{margin-left:20px;margin-bottom:20px}
        .Logout a {color:blue;text-decoration:none}
        .Logout a:hover{text-decoration:underline}
    </style>
<h1>会员注册管理系统</h1>
        <?php
            if(isset($_SESSION['LoggedUsername']) && $_SESSION['LoggedUsername']<>''){
        ?>
                <div class="Logged">当前登录者：<?php echo $_SESSION['LoggedUsername']; ?><?php if($_SESSION['isAdmin']) {?> <span style="color:red;">欢迎管理员登录</span> <?php }?> <span class="Logout"><a href="Logout.php">注销登录</a></span></div>
        <?php    
            }
        // $id = isset($_GET['id']) ? $_GET['id']: 1;
        $id = $_GET['id'] ?? 1;
        ?>
        
        <h2>
            <a href="index.php?id=1" <?php if($id == 1){?>class="current"<?php } ?>>首页</a>
            <a href="singup.php?id=2" <?php if($id == 2){?>class="current"<?php } ?>>会员注册</a>
            <a href="login.php?id=3" <?php if($id == 3){?>class="current"<?php } ?>>会员登录</a>
            <a href="modify.php?id=4&source=member" <?php if($id == 4){?>class="current"<?php } ?>>个人资料修改</a>
            <a href="admin.php?id=5" <?php if($id == 5){?>class="current"<?php } ?>>后台管理</a>
        </h2>