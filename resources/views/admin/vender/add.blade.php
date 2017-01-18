@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='生产厂家信息添加';
</script> 
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                生产厂家管理
                <small>添加</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="#">生产厂家信息</a></li>
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
						@if(session('info'))
						<div class="alert alert-danger">
						        <ul>
						           
						                <li>{{ session('info') }}</li>
						            
						        </ul>
						    </div>
						    
						@endif

                        <form class="form-horizontal" action="{{ url('/admin/vender') }}" method='post'>
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">厂家名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='name' value="" class="form-control" id="inputEmail3" placeholder="请输入厂家名称">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">网址</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='url' value="" class="form-control" id="inputEmail3" placeholder="请输入厂家网址">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='email' value="" class="form-control" id="inputEmail3" placeholder="请邮箱地址">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">联系人</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='linkman' value="" class="form-control" id="inputEmail3" placeholder="请输入厂家联系人">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">电话</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='phone' value="" class="form-control" id="inputEmail3" placeholder="请输入厂家联系人电话">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">传真</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='fax' value="" class="form-control" id="inputEmail3" placeholder="请输入厂家传真">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">维修人</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='service' value="" class="form-control" id="inputEmail3" placeholder="请输入维修人姓名">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">维修人联系电话</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='serphone' value="" class="form-control" id="inputEmail3" placeholder="请输入维修人联系方式">
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                 <label for="inputPassword3"  class="col-sm-2 control-label">父分类</label>
                                <div class="col-sm-10">
                                 <select name='pid' class='form-control'>
                                       <option value='0'>根分类</option>
                                 @foreach($data as $vender)

                                       <option value="{{ $vender ->id }}">{{ $vender -> name }}</option>
                                 @endforeach     
                                   </select>
                                    
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