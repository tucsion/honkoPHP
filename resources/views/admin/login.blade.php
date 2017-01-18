<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>后台登录</title>
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
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('/admin/moban/plugins/iCheck/square/blue.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>康复社后台管理系统</b>V1.0</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">登陆</p>
         @if(session('info'))
        <div class="alert alert-danger">
                <ul>
                   
                        <li>{{ session('info') }}</li>
                    
                </ul>
            </div>
            
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('/admin/dologin') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input name='username' type="text" class="form-control" placeholder="请输入您的用户名">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input name='password' type="password" class="form-control" placeholder="请输入您的密码">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
               <div class="row">
                
                <div class="col-xs-7">
                    <input type="text" name="captcha" class="form-control" placeholder="请输入验证码">
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <a onclick="javascript:re_captcha();" >
                        <img src="{{ URL('kit/captcha/1') }}"  alt="验证码" title="刷新图片" width="115" height="40" id="c2c98f0de5a04167a9e427d883690ff6" border="0">
                    </a>
                    <script>  
                        function re_captcha()
                        {
                            $url = "{{ URL('kit/captcha') }}";
                            $url = $url + "/" + Math.random();
                            document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
                        }
                    </script>
                </div><!-- /.col -->
            
            </div>
            <br/>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">登陆</button>
                </div><!-- /.col -->
            </div>
        </form>

        

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="{{ url('/admin/moban/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ url('/admin/moban/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ url('/admin/moban/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
