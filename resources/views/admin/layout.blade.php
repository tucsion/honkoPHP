<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ url('/admin/moban/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/admin/moban/bootstrap/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('/admin/moban/bootstrap/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/admin/moban/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ url('/admin/moban/dist/css/skins/_all-skins.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('/admin/moban/plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ url('/admin/moban/plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ url('/admin/moban/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ url('/admin/moban/plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('/admin/moban/plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ url('/admin/moban/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    
    <style type="text/css">
      
     {{ date_default_timezone_set('PRC') }} 


    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ url('/admin/moban/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}"></script>
    <script src="{{ url('/admin/moban/https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a  class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
           康复社
            <!-- logo for regular state and mobile devices -->
           
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <!-- Notifications: style can be found in dropdown.less -->

                    <!-- Tasks: style can be found in dropdown.less -->
                   
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ url('/admin/moban/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
                            <span class="hidden-xs"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ url('/admin/moban/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                                <p>
                                    Web Developer
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ url('/admin/admin/index') }}" class="btn btn-default btn-flat">管理员</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/admin/logout') }}" class="btn btn-default btn-flat">退出</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ url('/admin/moban/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>管理员：{{ session('admin') -> username }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                        class="fa fa-search"></i></button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
               
                <li class="treeview">
                    <a href="{{ url('/admin/set')}}">
                        <i class="fa  fa-user"></i>
                        <span>首页基本信息</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>图片管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/pic/index')}}"><i class="fa fa-circle-o"></i> 轮播图列表</a></li>
                        <li><a href="{{ url('/admin/banner/index')}}"><i class="fa fa-circle-o"></i> banner图列表</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>分类管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/cate') }}"><i class="fa fa-circle-o"></i> 分类列表</a></li>
                        <li><a href="{{ url('/admin/cate/create')}}"><i class="fa fa-circle-o"></i> 分类添加</a>
                        </li>
                        
                    </ul>
                </li>
                 <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i> <span>信息管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/keshi') }}"><i class="fa fa-circle-o"></i> 科室管理</a></li>
                        
                        
                        
                    </ul>
                </li>
                 <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file-image-o"></i> <span>商品管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/goods/index') }}"><i class="fa fa-circle-o"></i> 商品列表</a></li>
                        <li><a href="{{ url('/admin/hickey/index')}}"><i class="fa fa-circle-o"></i> 器械列表</a>
                       <li><a href="{{ url('/admin/vender')}}"><i class="fa fa-circle-o"></i> 生产厂家</a>
                        </li>
                        <li><a href="{{ url('/admin/agent')}}"><i class="fa fa-circle-o"></i> 代理商</a>
                        </li>
                        <li><a href="{{ url('/admin/scope')}}"><i class="fa fa-circle-o"></i> 商品适用范围</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file-image-o"></i> <span>文章管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/train/index') }}"><i class="fa fa-circle-o"></i> 教育与培训</a></li>
                        <li><a href="{{ url('/admin/health/index')}}"><i class="fa fa-circle-o"></i> 养生养老</a>
                       <li><a href="{{ url('/admin/procure/index')}}"><i class="fa fa-circle-o"></i> 企业采购</a>
                        </li>
                        <li><a href="{{ url('/admin/info/index')}}"><i class="fa fa-circle-o"></i> 康复资讯</a>
                        </li>
                        <li><a href="{{ url('/admin/lianxi/index')}}"><i class="fa fa-circle-o"></i> 联系我们</a>
                        <li><a href="{{ url('/admin/doctor/index')}}"><i class="fa fa-circle-o"></i> 医生文章管理</a>
                        </li>
                    </ul>
                </li>
               <li class="treeview">
                    <a href="#">
                        <i class="fa fa-table"></i> <span>会员信息管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/patient/index')}}"><i class="fa fa-circle-o"></i>患者管理</a></li>
                        <li><a href="{{ url('/admin/expert/index') }}"><i class="fa fa-circle-o"></i>专家管理</a></li>
                        <li><a href="{{ url('/admin/firm/index')}}"><i class="fa fa-circle-o"></i>企业管理</a></li>
                        <li><a href="{{ url('/admin/member/message')}}"><i class="fa fa-circle-o"></i>权限管理</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-plug"></i> <span>订单管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/myorder/index')}}"><i class="fa fa-circle-o"></i>商品订单</a></li>
                        <li><a href="{{ url('/admin/myserve/index')}}"><i class="fa fa-circle-o"></i>服务订单</a></li>
                        <li><a href="{{ url('/admin/mydeal/index')}}"><i class="fa fa-circle-o"></i>提现订单</a></li>
                    </ul>
                   
                </li>
                  <li class="treeview">
                    <a href="#">
                        <i class="fa  fa-pencil-square-o"></i> <span>消息管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/comment/index')}}"><i class="fa fa-circle-o"></i>评论管理</a></li>
                         <li><a href="{{ url('/admin/message/index')}}"><i class="fa fa-circle-o"></i>留言管理</a></li>
                    </ul>
                </li>
                 <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file-image-o"></i> <span>数据统计</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('http://tongji.baidu.com/web/welcome/login') }}" target="_blank"><i class="fa fa-circle-o"></i> 百度统计</a></li>
                        <li><a href="{{ url('/admin/tongji/users')}}"><i class="fa fa-circle-o"></i> 会员统计</a></li>
                        <li><a href="{{ url('/admin/tongji/orders')}}"><i class="fa fa-circle-o"></i> 订单统计</a></li>
                        <li><a href="{{ url('/admin/tongji/goods ')}}"><i class="fa fa-circle-o"></i> 产品统计</a></li>
                        
                    </ul>
                </li>
                @if(session('admin') -> type = '1') 
                <li class="treeview" >
                    <a href="#">
                        <i class="fa fa-folder"></i> <span>管理员管理</span>
                       
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/admin/index')}}"><i class="fa fa-circle-o"></i> 管理员列表</a></li>
                        <li><a href="{{ url('/admin/admin/add')}}"><i class="fa fa-circle-o"></i> 添加管理员</a></li>
                    </ul>
                </li>
                @endif
                 <li class="treeview">
                    <a href="#">
                        <i class="fa fa-plug"></i> <span>友链管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/admin/link/index')}}"><i class="fa fa-circle-o"></i>友链列表</a></li>
                        <li><a href="{{ url('/admin/link/add')}}"><i class="fa fa-circle-o"></i>友链添加</a></li>
                    </ul>
                </li>
               
                 
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

   @yield('content')
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
<!-- /.control-sidebar-menu -->

                
<!-- /.control-sidebar-menu -->

            </div><!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>
                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                            Some information about this general settings option
                        </p>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Allow mail redirect
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                            Other sets of options are available
                        </p>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Expose author name in posts
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                        <p>
                            Allow the user to show his name in blog posts
                        </p>
                    </div><!-- /.form-group -->

                    <h3 class="control-sidebar-heading">Chat Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Show me as online
                            <input type="checkbox" class="pull-right" checked>
                        </label>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Turn off notifications
                            <input type="checkbox" class="pull-right">
                        </label>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Delete chat history
                            <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                        </label>
                    </div><!-- /.form-group -->
                </form>
            </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-


    "></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src="{{ url('/admin/moban/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('/admin/moban/bootstrap/js/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ url('/admin/moban/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ url('/admin/moban/bootstrap/js/raphael-min.js') }}"></script>
<script src="{{ url('/admin/moban/plugins/morris/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('/admin/moban/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ url('/admin/moban/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ url('/admin/moban/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('/admin/moban/plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('/admin/moban/bootstrap/js/moment.min.js') }}"></script>
<script src="{{ url('/admin/moban/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ url('/admin/moban/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ url('/admin/moban/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ url('/admin/moban/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('/admin/moban/plugins/fastclick/fastclick.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('/admin/moban/dist/js/app.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('/admin/moban/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/admin/moban/dist/js/demo.js') }}"></script>
</body>
</html>
