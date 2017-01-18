@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='留言信息';
</script>  
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>  
   <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                评论列表
                <small>列表页</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{ url('/admin/comment/index')}}">评论</a></li>
                <li class="active">评论列表</li>
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
                        <form action="{{ url('/admin/comment/index') }}" method='get'>
                        <div style=''>
                            <div class='col-md-8'></div>
                            <div class='col-md-4'>
                                <div class="input-group input-group-sm">
                                    <input class="form-control" type="text" name='keyword' value="{{ $request['keyword'] or '' }}" placeholder="请搜索用户昵称">
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
                                    <th>商品ID</th>
                                    <th>用户姓名</th>
                                    <th>评论时间</th>
                                    <th>评论内容</th>
                                    <th>评论类型</th>    
                                    <th>操作</th>                           
                                </tr>
                                </thead>
                               @foreach($data as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    
                                    <td>{{ $comment->  gid}}</td>
                                    
                                    <td> {{ $comment -> uid }}</td>
                                    <td>{{ date('Y-m-d H:i:s',$comment -> comtime )}} </td>
                                    <td>{{ $comment -> comment }}</td>
                                    <td>@if($comment -> comtype == 0)
                                        商品 
                                        @elseif($comment -> comtype == 1)
                                        专家 
                                       
                                        @endif
                                    </td>
                                    <td><a onclick="javascript:if(!confirm('确定要删除选择的信息吗？\n此操作不可以恢复！')) { return false; }"   href="{{ url('/admin/comment/delete')}}/{{ $comment -> id }}"><font color="green">删除</font></a></td>
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