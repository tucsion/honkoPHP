@extends('admin.layout')
@section('content')
<style type="text/css">
      
     {{ date_default_timezone_set('PRC') }} 


    </style>
<script type="text/javascript">
    document.title='banner图添加';
</script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                banner图管理
                <small>添加</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index') }}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{ url('/admin/banner/index') }}">banner图管理</a></li>
                <li class="active">添加页面</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
 
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">添加页面</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        @if(session('bname'))
                          <div class="alert alert-danger">
                              <ul>
                                     
                                <li>{{ session('bname') }}</li>
                                      
                                </ul>
                          </div>
                              
                        @endif
                        
                        @if(session('img'))
                          <div class="alert alert-danger">
                              <ul>
                                     
                                <li>{{ session('img') }}</li>
                                      
                                </ul>
                          </div>
                              
                        @endif
   

                        <form class="form-horizontal" action="{{ url('/admin/banner/insert') }}" method='post'  ENCTYPE= 'MULTIPART/FORM-DATA'>
                            {{ csrf_field() }}
                                <div class="form-group">
                                 <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='bname' value="{{ old('bname') }}" class="form-control" id="inputEmail3" placeholder="请输入banner图标题">
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                  <label for="inputPassword3" class="col-sm-2 control-label">banner图片</label>
                                    <div class="col-sm-10">
                                    <input type="file" name='img' id="exampleInputFile">
                                    <p class="help-block">Please choose to upload the picture.</p>
                                    </div>
                                </div>
                                
                               
                              
                                <div class="form-group">
                                 <label for="inputEmail3" class="col-sm-2 control-label">发布日期</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='addtime' value="{{ date('Y-m-d H:i:s', time()) }}" class="form-control" id="inputEmail3" placeholder="请输入标题">
                                    </div>
                                    
                                </div>
                              
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="reset" class="btn btn-default">重置</button>
                                <button type="submit" class="btn btn-info pull-right">提交</button>
                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                 
                </div><!--/.col (right) -->
            </div>   <!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection