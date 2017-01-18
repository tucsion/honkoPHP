@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='留言信息详情';
</script>
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              留言详情
               
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{ url('/admin/message/index')}}">留言信息</a></li>
                <li class="active">详情页面</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
 
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        
                        <!-- form start -->
                       
                        @if(session('info'))
                        <div class="alert alert-danger">
                                <ul>
                                   
                                        <li>{{ session('info') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif

                       
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-10">
                                       <p>{{ $user -> relname }}</p>
                                    </div>
                                </div>
                               
                              <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">昵称</label>
                                    <div class="col-sm-10">
                                       <p>{{$user -> uname}}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">电话</label>
                                    <div class="col-sm-10">
                                       <p>{{$user -> phone}}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">留言内容</label>
                                    <div class="col-sm-10">
                                        <p>{{ $data -> message }}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">留言时间</label>
                                    <div class="col-sm-10">
                                        <p>{{ date("Y-m-d h:i:s",$data -> messtime) }}</p>
                                    </div>
                                </div>
                               
                               

                                

                                
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                
                               
                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                 
                </div><!--/.col (right) -->
            </div>   <!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection