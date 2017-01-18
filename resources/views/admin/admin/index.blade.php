@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='管理员信息';
</script>
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>  
   <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                用户列表
                <small>列表页</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index') }}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="#">用户</a></li>
                <li class="active">用户列表</li>
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
                         @if(session('uppass'))
                        <div class="callout callout-info">
                                <ul>
                                   
                                        <li>{{ session('uppass') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif
                         
                        


                            <table id="example2" class="table table-bordered table-hover">
                                <thead>

                             
                                <tr>
                                    <th>ID</th>
                                    <th>用户名</th>
                                    <th>类型</th>
                                    
                                    
                                    <th>登录ip</th>
                                    <th>最近登录时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                
                                 @foreach($data as $user)
                                <tr>
                                
                                    <td class='did'>{{ $user->id }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>
                                      
                                    @if($user->type == 0)
                                       普通管理员
                                    @elseif($user->type ==1)
                                       超级管理员
                                    @endif
                                    </td>
                                    
                                    
                                    <td>{{ $user->loginip }}</td>
                                    <td>{{ date("Y-m-d h:i:s",$user -> datetime) }}</td>
                                    <td><a href="{{ url('/admin/admin/edit')}}/{{ $user->id }}">编辑</a> | <a href="{{ url('/admin/admin/delete')}}/{{ $user->id }}">删除</a></td>
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