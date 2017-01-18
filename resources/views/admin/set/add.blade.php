@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='基本信息管理';
</script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              基本信息管理
               
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="#">信息管理</a></li>
                <li class="active">修改页面</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
 
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        
                        <!-- form start -->
                       
						@if(session('info'))
						<div class="alert alert-danger">
						        <ul>
						           
						                <li>{{ session('info') }}</li>
						            
						        </ul>
						    </div>
						    
						@endif

                        <form class="form-horizontal" action="{{ url('/admin/set/update') }}" method='post' ENCTYPE= 'MULTIPART/FORM-DATA'>
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">网站标题</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='title' value="{{ $data ->title }}" class="form-control" id="inputEmail3" placeholder="请输入网站标题">
                                    </div>
                                </div>
                               
                              <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">网站描述</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='depict' value="{{ $data ->depict }}" class="form-control" id="inputEmail3" placeholder="请输入描述">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">网站关键字</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='keywords' value="{{ $data ->keywords }}" class="form-control" id="inputEmail3" placeholder="请输入关键字">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">网站网址</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='link' value="{{ $data -> link }}" class="form-control" id="inputEmail3" placeholder="请输入网址">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">人数</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='number' value="{{ $data -> number }}" class="form-control" id="inputEmail3" placeholder="本平台已连续帮助   例患者实现康复">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">电话</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='tel' value="{{ $data -> tel }}" class="form-control" id="inputEmail3" placeholder="请输入公司电话">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">公司地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='address' value="{{ $data -> address }}" class="form-control" id="inputEmail3" placeholder="请输入地址">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">公司邮箱</label>
                                    <div class="col-sm-4">
                                        <input type="text" name='email' value="{{ $data -> email }}" class="form-control" id="inputEmail3" placeholder="请输入邮箱">
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 control-label">传真</label>
                                    <div class="col-sm-4">
                                        <input type="text" name='faxes' value="{{ $data -> faxes }}" class="form-control" id="inputEmail3" placeholder="请输入公司传真">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">qq</label>
                                    <div class="col-sm-4">
                                        <input type="text" name='qq' value="{{ $data -> qq }}" class="form-control" id="inputEmail3" placeholder="请输入联系qq">
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 control-label">404电话</label>
                                    <div class="col-sm-4">
                                        <input type="text" name='phone' value="{{ $data -> phone }}" class="form-control" id="inputEmail3" placeholder="请输入联系电话">
                                    </div>
                                </div>
                                <div class="form-group">
                                    
                                    <label for="inputEmail3" class="col-sm-2 control-label">腾讯微博</label>
                                    <div class="col-sm-4">
                                        <input type="text" name='blog1' value="{{ $data -> blog1 }}" class="form-control" id="inputEmail3" placeholder="请输入腾讯微博链接">
                                    </div>
                                    <label for="inputEmail3" class="col-sm-1 control-label">新浪微博</label>
                                    <div class="col-sm-4">
                                        <input type="text" name='blog2' value="{{ $data -> blog2 }}" class="form-control" id="inputEmail3" placeholder="请输入新浪微博链接">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">网站logo</label>
                                    <div class="col-sm-2">
                                    <input type="file" name='logo1' id="exampleInputFile">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name='pic1' value="{{ $data -> logo1 }}" class="form-control" id="inputEmail3" placeholder="">
                                    </div>
                                    <div class="col-sm-1">
                                    <a href="{{ url('/updates')}}/{{$data -> logo1}}" target="_blank"><img name='pic' src="{{ url('/updates/picsee.png') }}">
                                    </a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">底部logo</label>
                                    <div class="col-sm-2">
                                    <input type="file" name='logo2' id="exampleInputFile">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name='pic2' value="{{ $data -> logo2 }}" class="form-control" id="inputEmail3" placeholder="">
                                    </div>
                                    <div class="col-sm-1">
                                    <a href="{{ url('/updates')}}/{{$data -> logo2}}" target="_blank"><img name='pic' src="{{ url('/updates/picsee.png') }}">
                                    </a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">联系我们地图</label>
                                    <div class="col-sm-2">
                                    <input type="file" name='map' id="exampleInputFile">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name='map2' value="{{ $data -> map }}" class="form-control" id="inputEmail3" placeholder="">
                                    </div>
                                    <div class="col-sm-1">
                                    <a href="{{ url('/updates')}}/{{$data -> map}}" target="_blank"><img name='pic' src="{{ url('/updates/picsee.png') }}">
                                    </a>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">版权信息</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='news' value="{{ $data -> news }}" class="form-control" id="inputEmail3" placeholder="请输入版权信息">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">首页关于</label>
                                      <div class="col-sm-10">
                                        <!-- 加载编辑器的容器 -->
                                        <script id="container" name="intro" type="text/plain">{{$data -> intro}}
                                        </script>
                                        <!-- 配置文件 -->
                                        <script type="text/javascript" src="{{ url('/admin/ue/ueditor.config.js') }}"></script>
                                        <!-- 编辑器源码文件 -->
                                        <script type="text/javascript" src="{{ url('/admin/ue/ueditor.all.js') }}"></script>
                                        <!-- 实例化编辑器 -->
                                        <script type="text/javascript">
                                            var ue = UE.getEditor('container');
                                        </script>
                                </div>
                                </div>

                                

                                
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                
                                <button type="submit" class="btn btn-info pull-right">完成确认</button>
                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                 
                </div><!--/.col (right) -->
            </div>   <!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection