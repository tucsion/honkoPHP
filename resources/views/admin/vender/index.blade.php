@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='生产厂家信息管理';
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
</style>
   <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                生产厂家信息
                <small>列表页</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{ url('/admin/vender')}}">生产厂家</a></li>
                <li class="active">列表</li>
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
                        <form action="{{ url('/admin/scope') }}" method='get'>
                        <div style=''>
                            <div class='col-md-8'>
                             <div class="input-group input-group-sm">
                            <a href="{{ url('/admin/vender/create') }}" id='lunbo'>添加生产厂家</a>
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
                                    <th>分类名</th> 
                                    <th>父分类名称</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                               @foreach($data as $vender)
                                <tr>
                                    <td>{{ $vender->id }}</td>
                                    <td>{{ $vender->name }}</td>
                                    <td>{{ $vender->parentName }} 
                                    </td>  
                                    <td><a class='btn btn-primary btn-sm btn-flat' href="{{ url('/admin/vender')}}/{{ $vender -> id }}/edit">编辑</a>
                                    <form action="{{ url('/admin/vender')}}/{{ $vender ->id }}" method='post'>
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}
                                    <button class='btn btn-primary btn-sm btn-flat' type='submit'>删除</button>
 

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