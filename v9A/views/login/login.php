<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><meta name="renderer" content="webkit">
    <title>V9A登陆系统</title>
    <meta name="keywords" content="V9A后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="V9A是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <link href="./V9A/css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <link href="./V9A/css/style.css?v=2.2.0" rel="stylesheet">
</head>
<body class="gray-bg">
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name">H+</h1>
        </div>
        <h3>欢迎使用 V9A</h3>
        <form class="m-t" role="form" action="">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="用户名" required="" name="uname">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="密码" required="" name="pwd">
            </div>
            <button type="button" class="btn btn-primary block full-width m-b">登 录</button>
            <p class="text-muted text-center"> <a href="#"><small>忘记密码了？</small></a> | <a href="javascript: void (0)" class="zhu">注册一个新账号</a>
            </p>
        </form>
    </div>
</div>
<!-- Mainly scripts -->
<script src="./V9A/js/jquery-2.1.1.min.js"></script>
<script src="./V9A/js/bootstrap.min.js?v=3.4.0"></script>
<!--注册和登陆界面-->
<script src="./jq.js"></script>
<script>
    $(document).ready(function(){
         $(".zhu").click(function(){
             $.post("index.php?r=login/zhu",function(msg){
                 location.href="index.php?r=login/zhu";
             });
         });
        $(":button").click(function(){
            var uname=$("input[name=uname]").val();
            var pwd=$("input[name=pwd]").val();
            $.post("index.php?r=login/login",{uname:uname,pwd:pwd},function(msg){
                if(msg==0){
                    alert("用户名或者密码错误");
                }else if(msg==1){
                    location.href="index.php?r=index/index";
                }
            });
        });
    });
</script>
</body>
</html>
