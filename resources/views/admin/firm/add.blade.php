
@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='企业信息添加';
</script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                企业管理
                <small>添加</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index') }}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{url('/admin/firm/index')}}">企业信息管理</a></li>
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
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                         @if(session('user3add'))
                        <div class="callout callout-info">
                                <ul>
                                   
                                        <li>{{ session('user3add') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif
                      

                        <form class="form-horizontal" action="{{ url('/admin/firm/insert') }}" method='post' >
                            {{ csrf_field() }}
                           
                            <div class="box-body">
                             <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='uname' value="{{ old('uname') }}" class="form-control" id="inputEmail3" placeholder="请输入用户名">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">公司名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='gsname' value="{{ old('gsname') }}" class="form-control" id="inputEmail3" placeholder="请输入4到15位的公司名">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">手机号码</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='phone' value="{{ old('phone') }}" class="form-control" id="inputEmail3" placeholder="请输入手机号码">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='email' value="{{ old('email') }}" class="form-control" id="inputEmail3" placeholder="请输入您的常用邮箱">
                                    </div>
                                </div> 
                              <div class="form-group">

                                  <label for="inputEmail3" class="col-sm-2 control-label">邮编</label>
                                    <div class="col-sm-4">
                                        <input type="text" name='code' value="{{ old('code') }}" class="form-control" id="inputEmail3" placeholder="请输入正确的邮编">
                                    </div>
                                    </div>

                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='address' value="{{ old('address') }}" class="form-control" id="inputEmail3" placeholder="请输入您的详细地址">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">营业执照</label>
                                    <div class="col-sm-4">
                                    <input type="file" name='cardpic1' id="exampleInputFile">
                                    <p class="help-block">Please choose to upload the picture.正面照</p>
                                   </div>
                                   
                                  
                                    
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">营业执照</label>
                                    <div class="col-sm-4">
                                    <input type="file" name='cardpic2' id="exampleInputFile">
                                    <p class="help-block">Please choose to upload the picture.反面照</p>
                                   </div>
                                   
                                   
                                    
                                </div>
                     
                                <div class="form-group">
                                 <label for="inputPassword3"  class="col-sm-2 control-label">是否认证通过？</label>
                                <div class="col-sm-4">
                                 <select name='isrz' class='form-control'>
                                       <option value='0'>未认证</option>
                                       <option value="1">已认证</option>   
                                   </select>
                                    
                                </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">密码</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='upwd' value="" class="form-control" id="inputEmail3" placeholder="请输入6到18位密码">

                                    
                                    
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