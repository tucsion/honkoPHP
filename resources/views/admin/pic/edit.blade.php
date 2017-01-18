@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='轮播图编辑';
</script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                轮播图管理
                <small>编辑</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index') }}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="">轮播图管理</a></li>
                <li class="active">编辑页面</li>
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
                            <h3 class="box-title">编辑页面</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('info'))
                        <div class="alert alert-danger">
                                <ul>
                                   
                                        <li>{{ session('info') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif
                        @if(session('update'))
                        <div class="alert alert-danger">
                                <ul>
                                   
                                        <li>{{ session('update') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif

                        <form class="form-horizontal" action="{{ url('/admin/pic/update') }}" method='post'  ENCTYPE= 'MULTIPART/FORM-DATA'>
                            {{ csrf_field() }}
                          <input type='hidden' name='id' value="{{ $data -> id }}"></input>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">标题</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='name' value="{{ $data -> name }}" class="form-control" id="inputEmail3" placeholder="请输入图片的标题">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">原始图片</label> &nbsp; &nbsp; 
                                    <img src="{{ url('/updates/') }}/{{ $data -> pic }}" width='150px'>
                                    &nbsp; &nbsp; <a href="{{ url('/updates') }}/{{ $data -> pic }}" target="_blank"><img name='img' src="{{ url('/updates/picsee.png') }}"></a>
                                </div>
                                  <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">轮播图片</label>
                                    <div class="col-sm-10">
                                    <input type="file" name='pic' id="exampleInputFile">
                                    <p class="help-block">Please choose to upload the picture.</p>
                                  </div>
                                </div>
                                <div class="form-group">
                                 <label for="inputPassword3" class="col-sm-2 control-label">状态</label>
                                      <div class="col-sm-10">
                               
                                      <select name='state' class='form-control'>
                                    
                                       <option
                                       @if($data->state == 0)
                                       selected='selected'
                                   
                                        @endif
                                        value='0'>启用</option>
                                       <option 
                                       @if($data->state == 1)
                                       selected='selected'
                                   
                                        @endif
                                       value="1">禁用</option>   
                                      </select>
                                    
                                      </div>
                                  
                                </div>
                                
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">路径</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='link' value="{{ $data -> link }}" class="form-control" id="inputEmail3" placeholder="请输入图片要跳转的路径; 例如: http://www.baidu.com">
                                    </div>
                                </div>
                              
                            <!-- /.box-body -->
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