@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='用户统计列表';
</script>  
   <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                用户统计列表
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
                            <h3 class="box-title">统计列表页</h3>
                        </div><!-- /.box-header -->
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>

                             
                                <tr>
                                    
                                    <th align='center'>用户总数</th>
                                    <th align='center'>近三天新增数</th>
                                    
                                    
                                    <th align='center'>近一周新增数</th>
                                    <th align='center'>近一月新增数</th>
                                   
                                </tr>
                                </thead>
                                
                                
                                <tr>
                                
                                    <td class='did' align='center'>{{$data['count']}}位</td>
                                    <td align='center'>{{$data['count3']}}位</td>
                                    <td align='center'>
                                      
                                   {{$data['count7']}}位
                                    </td>
                                    
                                    
                                    <td align='center'>{{$data['count30']}}位</td>
                                    
                                </tr>
                             

                            </table>
                          
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                   
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    


@endsection