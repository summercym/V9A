<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="renderer" content="webkit">

    <title> V9A 注册</title>
    <meta name="keywords" content="H+后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="H+是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">

    <link href="./V9A/css/bootstrap.min.css?v=3.4.0" rel="stylesheet">

    <link href="./V9A/css/style.css?v=2.2.0" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">H+</h1>

        </div>
        <h3>欢迎注册 V9A</h3>
        <p>创建一个V9A新账户</p>
        <form class="m-t" role="form" action="index.php?r=login/zhu" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="uname" placeholder="请输入用户名" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pwd" placeholder="请输入密码" required="">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="psw" placeholder="请再次输入密码" required="">
            </div>

            <button  class="btn btn-primary block full-width m-b">注 册</button>

            <p class="text-muted text-center"><small>已经有账户了？</small><a href="index.php?r=login/login">点此登录</a>
            </p>

        </form>
    </div>
</div>

<!-- Mainly scripts -->
<script src="./V9A/js/jquery-2.1.1.min.js"></script>

<!-- iCheck -->
<script src="./V9A/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>


</body>

</html>
