@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='消息修改';
</script> 
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                消息管理
                <small>修改</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{ url('/admin/xitong')}}">系统消息</a></li>
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
                        <div class="box-header with-border">
                            <h3 class="box-title">修改页面</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
						@if(session('info'))
						<div class="alert alert-danger">
						        <ul>
						           
						                <li>{{ session('info') }}</li>
						            
						        </ul>
						    </div>
						    
						@endif

                        <form class="form-horizontal" action="{{ url('/admin/xitong/updatext') }}" method='post'>
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">消息名</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='wname' value="{{$tuisong -> wname}}" class="form-control" id="inputEmail3" placeholder="请输入消息名称">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">消息内容</label>
                                    <div class="col-sm-10">
                                        <textarea name="wcontent" value='' placeholder="请输入消息内容"  class="col-sm-10">{{$tuisong -> wcontent}}</textarea>
                                    </div>
                                </div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">消息状态</label>
                                 <div class="col-sm-10">
                                    <select name='wstate' class='form-control'>
                                       <option value='0'>发布中</option>
                                       <option value="1">已结束</option>
                                   </select>
                                   </div>
                                <div>
                                    
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