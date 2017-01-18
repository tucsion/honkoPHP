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
                留言列表
                <small>列表页</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index') }}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{ url('/admin/message/index') }}">留言信息</a></li>
                <li class="active">留言列表</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">留言列表页</h3>
                        </div><!-- /.box-header -->
                     
                         @if(session('message'))
                        <div class="callout callout-info">
                                <ul>
                                   
                                        <li>{{ session('message') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif
                         
                        
                        <form action="{{ url('/admin/message/index') }}" method='get'>
                        <div >
                            <div class='col-md-6'>
                            <div class="input-group input-group-sm">
                            
                            </div>
                            </div>
                            <div class= 'col-md-2' style="text-align:right;"><small>按姓名检索</small></div>
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
                                    <th>姓名</th>
                                    <th>手机</th>
                                    <th>邮箱</th>
                                    <th>创建时间</th>
                                    
                                    <th>操作</th>
                                </tr>
                                </thead>
                                
                                 @foreach($data as $message )
                                <tr>
                                
                                    <td class="ids">{{ $message ->id }}</td>
                                    <td>{{ $message -> mname }}</td>
                                    <td> {{ $message -> phone}}</td>
                                    <td> {{ $message -> email }}</td>
                                    <td>{{ date("Y-m-d h:i:s",$message -> messtime) }}</td>
                                    <td><a href="{{ url('/admin/message/detail')}}/{{ $message-> id }}">查看</a> | <a onclick="javascript:if(!confirm('确定要删除选择的信息吗？\n此操作不可以恢复！')) { return false; }"   href="{{ url('/admin/message/delete')}}/{{ $message -> id }}"><font color="green">删除</font></a></td>
                                </tr>
                               @endforeach

                            </table>
                          
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                   
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    
@endsection