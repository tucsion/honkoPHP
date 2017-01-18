@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='厂家信息修改';
</script> 
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                生产厂家信息
                <small>编辑</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="#">厂家信息管理</a></li>
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
                      
						@if(session('info'))
						<div class="alert alert-danger">
						        <ul>
						           
						                <li>{{ session('info') }}</li>
						            
						        </ul>
						    </div>
						    
						@endif

                        <form class="form-horizontal" action="{{ url('/admin/vender') }}/{{ $data->id}}" method='post'>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type='hidden' name='id' value="{{ $data ->id}}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">厂家名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='name' value="{{ $data->name }}" class="form-control" id="inputEmail3" placeholder="请输入厂家名称">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">网址</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='url' value="{{ $data->url }}" class="form-control" id="inputEmail3" placeholder="请输入厂家网址">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='email' value="{{ $data->email }}" class="form-control" id="inputEmail3" placeholder="请输入厂家邮箱">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">联系人</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='linkman' value="{{ $data->linkman }}" class="form-control" id="inputEmail3" placeholder="请输入厂家联系人">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">电话</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='phone' value="{{ $data->phone }}" class="form-control" id="inputEmail3" placeholder="请输入联系人电话">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">传真</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='fax' value="{{ $data->fax }}" class="form-control" id="inputEmail3" placeholder="请输入厂家传真">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">维修人</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='service' value="{{ $data->service }}" class="form-control" id="inputEmail3" placeholder="请输入厂家名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">维修人联系方式</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='serphone' value="{{ $data->serphone }}" class="form-control" id="inputEmail3" placeholder="请输入厂家维修人联系电话">
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