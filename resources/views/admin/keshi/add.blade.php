@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='科室添加';
</script> 
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                康复科管理
                <small>添加</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{ url('/admin/keshi')}}">康复科</a></li>
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
						@if(session('info'))
						<div class="alert alert-danger">
						        <ul>
						           
						                <li>{{ session('info') }}</li>
						            
						        </ul>
						    </div>
						    
						@endif

                        <form class="form-horizontal" action="{{ url('/admin/keshi') }}" method='post'>
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">康复科</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='name' value="" class="form-control" id="inputEmail3" placeholder="请输入科室名">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">描述</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='describe' value="" class="form-control" id="inputEmail3" placeholder="不填则与科室名相同">
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                 <label for="inputPassword3"  class="col-sm-2 control-label">父分类</label>
                                <div class="col-sm-10">
                                 <select name='pid' class='form-control'>
                                       <option value='0'>根分类</option>
                                 @foreach($data as $cate)

                                       <option value="{{ $cate -> id }}">{{ $cate->name }}</option>
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