@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='代理商信息修改';
</script> 
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                代理商信息
                <small>编辑</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="#">代理商信息管理</a></li>
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

                        <form class="form-horizontal" action="{{ url('/admin/agent') }}/{{ $data->id}}" method='post'>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type='hidden' name='id' value="{{ $data ->id}}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">代理商名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='name' value="{{ $data -> name }}" class="form-control" id="inputEmail3" placeholder="请输入代理商名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='address' value="{{ $data -> address }}" class="form-control" id="inputEmail3" placeholder="请输入代理商的地址">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">网址</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='link' value="{{ $data->link }}" class="form-control" id="inputEmail3" placeholder="请输入代理商网址">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='email' value="{{ $data -> email }}" class="form-control" id="inputEmail3" placeholder="请输入代理商的邮箱">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">联系人</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='linkman' value="{{ $data->linkman }}" class="form-control" id="inputEmail3" placeholder="请输入代理商联系人">
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
                                        <input type="text" name='fax' value="{{ $data->fax }}" class="form-control" id="inputEmail3" placeholder="请输入代理商的传真">
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