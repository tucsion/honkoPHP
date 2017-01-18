@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='分类修改';
</script> 
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                分类管理
                <small>编辑</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="#">分类管理</a></li>
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

                        <form class="form-horizontal" action="{{ url('/admin/cate') }}/{{ $data->id}}" method='post'>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <input type='hidden' name='id' value="{{ $data ->id}}">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">分类名</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='cate' value="{{ $data->cate }}" class="form-control" id="inputEmail3" placeholder="请输入分类名">
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                 <label for="inputPassword3"  class="col-sm-2 control-label">父分类
                                 </label>
                                <div class="col-sm-10">
                                 <select name='pid' class='form-control'>
                                 @foreach($alldata as $cate)

                                       <option
                                       @if($cate->id == $data ->pid)
                                         selected='selected'
                                       @endif
                                       @if( $cate->id == $data->id)
                                        disabled='disabled'
                                       @endif
                                      
                                        value="{{ $cate->id }}" >{{ $cate->cate }}</option>
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