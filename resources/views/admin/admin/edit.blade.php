@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='管理员信息修改';
</script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                用户管理
                <small>编辑</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index') }}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="#">用户管理</a></li>
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
                        @if(session('false'))
                        <div class="callout callout-info">
                                <ul>
                                   
                                        <li>{{ session('false') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif

                        <form class="form-horizontal" action="{{ url('/admin/admin/update') }}" method='post'>
                            {{ csrf_field() }}
                            <input type='hidden' name='id' value="{{ $data ->id}}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">昵称</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='username' value="{{ $data->username }}" class="form-control" id="inputEmail3" placeholder="请输入4到10位用户名">
                                    </div>
                                </div>
                                 
                               
                              <div class="form-group">
                                 <label for="inputPassword3"  class="col-sm-2 control-label">管理员权限</label>
                               


                                <div class="col-sm-10">
                                 <select name='status' class='form-control'>
                                       <option
                                       @if($data->type ==0) 
                                         selected='selected'
                                        @endif
                                       value='0'>普通管理员</option>
                                       <option
                                        @if($data->type ==1) 
                                         selected='selected'
                                        @endif
                                        value='1'>超级管理员</option>
                                   </select>
                                    
                                </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">原密码</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='password' value="" class="form-control" id="inputEmail3" placeholder="请输入原密码">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">新密码</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='newpassword' value="" class="form-control" id="inputEmail3" placeholder="请输入6到18位密码">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">确认密码</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='repassword' value="" class="form-control" id="inputEmail3" placeholder="请再次输入新密码">
                                    </div>
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