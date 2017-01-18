@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='医生文章信息';
</script> 
<style type="text/css">
#lunbo {
display: block; 
    height: 34px; 
    width: 107px; 
    line-height: 2; 
    text-align: center; 
    background: blue; 
    color: white; 
    font-size: 14px; 
    font-weight: bold; 
    text-decoration: none; 
    padding-top: 3px;
}
#lunbo:hover{
    background: black;
}
{{ date_default_timezone_set('PRC') }} 
</style>
   <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                医生文章列表
                <small>列表页</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="#">医生文章</a></li>
                <li class="active">文章列表</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">列表页</h3>
                        </div><!-- /.box-header -->
                       @if(session('info'))
                        <div class="callout callout-info">
                                <ul>
                                   
                                        <li>{{ session('info') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif
                        <div class="box-body">
                        <form action="{{ url('/admin/doctor/index') }}" method='get'>
                        <div style=''>
                            <div class='col-md-8'>
                             <div class="input-group input-group-sm">
                            
                            </div>   
                            </div>
                            <div class='col-md-4'>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" name='keyword' value="{{ $request['keyword'] or '' }}">
                                    <span class="input-group-btn">
                                      <button class="btn btn-info btn-flat" type="submit">Go!</button>
                                    </span>
                                </div>
                                <br>
                            </div>
                        </div>
                        </form>


                            <table id="example2" class="table table-bordered table-hover">
                                <thead>

                             
                                <tr>
                                    <th>ID</th>
                                    <th>文章标题</th>
                                    <th>发表时间</th>
                                    
                                    <th>操作</th>
                                </tr>
                                </thead>
                               @foreach($data as $doctor)
                                <tr>
                                    <td>{{ $doctor->id }}</td>
                                    
                                    <td>{{ $doctor-> name }}</td>
                                    
                                    <td>{{ date('Y-m-d H:i:s',$doctor -> dtime ) }}</td>
                                    
                                    <td><a  href="{{ url('/admin/doctor/delete')}}/{{ $doctor -> id }}">删除</a>
                                    </td>
                                </tr>
                               @endforeach

                            </table>
                            {!! $data->appends($request)->render() !!}
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                   
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
   


@endsection