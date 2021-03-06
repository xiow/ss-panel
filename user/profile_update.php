<?php
//引入配置文件
require_once 'user_check.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>ShadowX</title>
    <?php include_once 'lib/header.inc.php'; ?>
</head>
<body class="skin-blue">
<?php include_once 'lib/nav.inc.php';
include_once 'lib/slidebar_left.inc.php';
//get post value
if(!empty($_POST)){
    $now_pwd = mysqli_real_escape_string($dbc,trim($_POST['nowpassword']));
    $pwd = mysqli_real_escape_string($dbc,trim($_POST['password']));
    $email = mysqli_real_escape_string($dbc,trim($_POST['email']));
    //验证当前密码
    if(!pwd_verify($uid,$now_pwd)){
        echo ' <script>alert("当前密码错误!")</script> ';
        echo " <script>window.location='profile_update.php';</script> " ;
    }else{
        //更新密码
        if(!empty($_POST['password'])){
            if(change_pwd($uid,$pwd)){
                echo ' <script>alert("修改成功!")</script> ';
                echo " <script>window.location='profile_update.php';</script> " ;
            }else{
                echo ' <script>alert("出错了!")</script> ';
                echo " <script>window.location='profile_update.php';</script> " ;
            }
        }
        //更新邮箱
        if(!empty($_POST['email'])){
            if(change_email($uid,$email)){
                echo ' <script>alert("修改成功!")</script> ';
                echo " <script>window.location='profile_update.php';</script> " ;
            }else{
                echo ' <script>alert("出错了!")</script> ';
                echo " <script>window.location='profile_update.php';</script> " ;
            }
        }
    }
}
?>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            用户中心
            <small>User Panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i>ShadowX</a></li>
            <li class="active">UserCenter</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">编辑</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" name="edit" method="post" action="profile_update.php" onsubmit="return check()">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputPassword">当前密码</label>
                                <input type="password" class="form-control" name="nowpassword">
                            </div>

                            <div class="form-group">
                                <label class="pull-right" >*留空则不修改密码</label>
                                <label for="inputPassword">密码</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="form-group">
                                <label for="inputPassword">确认密码</label>
                                <input type="password" class="form-control" name="repassword">
                            </div>

                            <div class="form-group">
                                <label for="inputPassword">邮箱</label>
                                <label class="pull-right" >*留空则不修改</label>
                                <input type="text" class="form-control" name="email">
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" name="action" value="add" class="btn btn-primary">修改</button>
                        </div>

                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->
</aside><!-- /.right-side -->
<?php include_once 'lib/footer.inc.php'; ?>
<script LANGUAGE="javascript">

    function check()
    {

        if(document.edit.nowpassword.value.length==0){
            alert("请输入当前密码!");
            document.edit.nowpassword.focus();
            return false;
        }
        if(document.edit.password.value.length != 0){
            if(document.edit.password.value.length < 8){
                alert("密码至少8位");
                document.edit.password.focus();
                return false;
            }
            if(document.edit.repassword.value != document.edit.password.value ){
                alert("两次密码输入不符!");
                document.edit.repassword.focus();
                return false;
            }
        }
        if(document.edit.email.length != 0){
            //对电子邮件的验证
            //定义email正则表达式
            var email_reg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;

            if(!email_reg.test(document.reg.email.value)) {
                alert('提示\n\n请输入有效的E-mail！');
                document.reg.email.focus();
                return false;
            }
        }

    }

</script>
</body>
</html>
