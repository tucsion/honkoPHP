@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='提现订单';
</script>  
   <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                提现订单
                <small>列表页</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index') }}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{ url('/admin/myserve/index') }}">提现订单</a></li>
                <li class="active">订单列表</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">订单列表页</h3>
                        </div><!-- /.box-header -->
                     
                         @if(session('mydeal'))
                        <div class="callout callout-info">
                                <ul>
                                   
                                        <li>{{ session('mydeal') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif
                         
                        


                            <table id="example2" class="table table-bordered table-hover">
                                <thead>

                             
                                <tr>
                                    <th>ID</th>
                                    <th>提现编号</th>
                                    <th>姓名</th>
                                    <th>手机</th>
                                    <th>金额</th>
                                    <th>创建时间</th>
                                    <th>提现备注</th>
                                    <th>订单状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                
                                 @foreach($data as $mydeal)
                                <tr>
                                
                                    <td class="ids">{{ $mydeal ->id }}</td>
                                    <td>{{ $mydeal -> dnumber }}</td>
                                    <td>{{ $mydeal -> dname }}</td>
                                    <td> {{ $mydeal -> phone}}</td>
                                    <td>{{ $mydeal -> dprice }}</td>
                                    <td>{{ date("Y-m-d h:i:s",$mydeal -> dtime) }}</td>
                                    <td>{{ $mydeal -> dremark }}</td>
                                    <td class = "state">
                                        @if($mydeal -> state == 0)
                                        未付款 
                                        @elseif($mydeal -> state == 1)
                                        已付款
                                        @endif
                                        

                                    </td> 
                                    <td><a onclick="javascript:if(!confirm('确定要删除选择的信息吗？\n此操作不可以恢复！')) { return false; }"   href="{{ url('/admin/mydeal/delete')}}/{{ $mydeal -> id }}"><font color="green">删除</font></a></td>
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