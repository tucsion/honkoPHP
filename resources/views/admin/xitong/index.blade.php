@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='系统消息';
</script> 
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>
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
</style>
   <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                消息列表
                <small>列表页</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{ url('/admin/xitong')}}">系统消息</a></li>
                <li class="active">推送列表</li>
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
                        <div style=''>
                        	<div class='col-md-8'>
                             <div class="input-group input-group-sm">
                            <a href="{{ url('/admin/xitong/create') }}" id='lunbo'>发布新消息</a>
                            </div>   
                            </div>
                        </div>


                            <table id="example2" class="table table-bordered table-hover">
                                <thead>

                             
                                <tr>
                                    <th>ID</th>
                                    <th>系统消息名称</th> 
                                    <th>发布时间</th>
                                    <th>发布状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                               @foreach($data as $xitong)
                                <tr>
                                    <td>{{ $xitong->id }}</td>
                                    <td>{{ $xitong -> wname}}</td>
                                    <td>{{ date('Y-m-d H:i:s',$xitong -> wtime) }} 
                                    </td>
                                    <td>
                                        @if($xitong -> wstate == 0)
                                        发布中
                                        @elseif($xitong -> wstate == 1)
                                        已结束
                                        @endif
                                    </td>
                                    <td>
                                    <form action="{{ url('/admin/xitong')}}/{{ $xitong ->id }}" method='post'>
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}
                                    <button class='btn btn-primary btn-sm btn-flat' type='submit'>删除</button>
                                    <a href="{{url('/admin/xitong/edit')}}/{{$xitong -> id}}">修改</a>
                                    </form>
                                    
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