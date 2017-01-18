@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='会员订单';
</script>  
   <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                服务订单
                <small>列表页</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index') }}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{ url('/admin/myserve/index') }}">会员服务订单</a></li>
                <li class="active">服务订单列表</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">服务列表页</h3>
                        </div><!-- /.box-header -->
                     
                         @if(session('myserve'))
                        <div class="callout callout-info">
                                <ul>
                                   
                                        <li>{{ session('myserve') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif
                         
                        


                            <table id="example2" class="table table-bordered table-hover">
                                <thead>

                             
                                <tr>
                                    <th>ID</th>
                                    <th>订单号</th>
                                    <th>总价</th>
                                    <th>购买人</th>
                                    <th>下单时间</th>
                                    <th>订单状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                
                                 @foreach($data as $myserve)
                                <tr>
                                
                                    <td class="ids">{{ $myserve ->id }}</td>
                                    <td>{{ $myserve -> servenum }}</td>
                                    <td> {{ $myserve -> price}}</td>
                                    <td> {{ $myserve -> srname }}/{{ $myserve -> sphone }}</td>
                                    <td>{{ date("Y-m-d h:i:s",$myserve -> servetime) }}</td>
                                    <td class = "state">
                                        @if($myserve -> state == 0)
                                        未付款 
                                        @elseif($myserve -> state == 1)
                                        已付款
                                        @endif
                                        

                                    </td> 
                                    <td><a href="{{ url('/admin/myserve/detail')}}/{{ $myserve-> id }}">查看</a> | <a onclick="javascript:if(!confirm('确定要删除选择的信息吗？\n此操作不可以恢复！')) { return false; }"   href="{{ url('/admin/myserve/delete')}}/{{ $myserve -> id }}"><font color="green">删除</font></a></td>
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