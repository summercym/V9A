<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>V9A 主页</title>
    <meta name="keywords" content="V9A后台主题,后台bootstrap框架,会员中心主题,后台HTML,响应式后台">
    <meta name="description" content="V9A是一个完全响应式，基于Bootstrap3最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术">
    <link href="./V9A/css/bootstrap.min.css?v=3.4.0" rel="stylesheet">
    <!-- Morris -->
   <!-- <link href="./V9A/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">-->
    <!-- Gritter -->
 <!--   <link href="./V9A/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">-->
    <link href="./V9A/css/style.css?v=2.2.0" rel="stylesheet">
</head>
<body>
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="./V9A/img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo @$_COOKIE['uname']?></strong>
                             </span> <span class="text-muted text-xs block">超级管理员 <b class="caret"></b></span> </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="">修改头像</a>
                            </li>
                            <li><a href="">个人资料</a>
                            </li>
                            <li><a href="">联系我们</a>
                            </li>
                            <li><a href="">信箱</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="index.php?r=login/out">安全退出</a>
                            </li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        V9A
                    </div>

                </li>
                <li>
                    <a href="index.php?r=index/layouts"><i class="fa fa-columns"></i> <span class="nav-label">欢迎界面</span><span class="label label-danger pull-right">2.0</span></a>
                </li>
                <li class="active">
                    <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">功能</span> <span class="label label-danger pull-right">2.0</span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="index.php?r=num/insert">添加公众号</a>
                        </li>
                        <li><a href="index.php?r=num/show">管理公众号</a>
                        </li>
                        <li><a href="index_3.html">自定义回复</a>
                        </li>
                        <li><a href="index_4.html">自定义菜单</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="index.php?r=index/end"><i class="fa fa-columns"></i> <span class="nav-label">END</span><span class="label label-danger pull-right">2.0</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">

                    <form role="search" class="navbar-form-custom" method="post" >
                        <div class="form-group">
                            <input type="text" placeholder="请输入您需要查找的内容 …" class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message"><a href="" title="返回首页"><i class="fa fa-home"></i></a>欢迎使用V9A后台主题</span>
                    </li>

                    <li>
                        <a href="index.php?r=login/out">
                            <i class="fa fa-sign-out"></i> 退出
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
        <?=$content?>
    </div>
</div>

<!-- Mainly scripts -->
<script src="./V9A/js/jquery-2.1.1.min.js"></script>
<script src="./V9A/js/bootstrap.min.js?v=3.4.0"></script>
<script src="./V9A/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="./V9A/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="./V9A/js/hplus.js?v=2.2.0"></script>
<script src="./V9A/js/plugins/pace/pace.min.js"></script>

<!--统计代码，可删除-->
</body>

</html>