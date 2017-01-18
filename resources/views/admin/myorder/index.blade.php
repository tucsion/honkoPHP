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
                订单列表
                <small>列表页</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index') }}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{ url('/admin/myorder/index') }}">会员订单</a></li>
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
                                    <th>订单号</th>
                                    <th>总价</th>
                                    <th>购买人</th>
                                    <th>下单时间</th>
                                    <th>订单状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                
                                 @foreach($data as $myorder)
                                <tr>
                                
                                    <td class="ids">{{ $myorder ->id }}</td>
                                    <td>{{ $myorder->onumber }}</td>
                                    <td> {{ $myorder -> price}}</td>
                                    <td> {{ $myorder -> conname }}</td>
                                    <td>{{ date("Y-m-d h:i:s",$myorder -> ordertime) }}</td>
                                    <td class = "state">
                                        @if($myorder -> state == 0)
                                        未付款 
                                        @elseif($myorder -> state == 1)
                                        已付款,未发货 
                                        @elseif($myorder -> state == 2)
                                        已发货
                                        @elseif($myorder -> state == 3)
                                        已收货
                                        @endif
                                        

                                    </td> 
                                    <td><a href="{{ url('/admin/myorder/detail')}}/{{ $myorder-> id }}">查看</a> | <a onclick="javascript:if(!confirm('确定要删除选择的信息吗？\n此操作不可以恢复！')) { return false; }"   href="{{ url('/admin/myorder/delete')}}/{{ $myorder -> id }}"><font color="green">删除</font></a></td>
                                </tr>
                               @endforeach

                            </table>
                          
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                   
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    
  <script type="text/javascript">
      
        window.onload = function()
        {
            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // alert($);
        $(".state").on('click',function()
            {
                // var id = $(this).parent().children().first();
                var id = $(this).parent().find('.ids').html();
                var t = $(this);
                $.ajax({
                    url:"{{ url('/admin/myorder/ajaxupdate') }}",
                    type:"POST",
                    data:{id:id},
                    success:function(data)
                    {
                        if(data == '1')
                        {
                            t.html('已付款,未发货');
                           
                        }else if(data == '2')
                        {   
                            t.html('已发货');
                           
                        }else
                        {
                            alert('修改失败')
                        }
                    },
                    dataType:'json'
                });
            });
        }
        
    </script>

@endsection