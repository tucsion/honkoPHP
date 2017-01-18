@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='会员服务详情';
</script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              服务订单详情
               
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{ url('/admin/myserve/index')}}">会员服务订单</a></li>
                <li class="active">详情页面</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
 
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        
                        <!-- form start -->
                       
                    

                       
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">姓名：</label>
                                    <div class="col-sm-10">
                                       <p>{{ $user -> relname }}</p>
                                    </div>
                                </div>
                               
                              <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">昵称：</label>
                                    <div class="col-sm-10">
                                       <p>{{$user -> uname}}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">电话：</label>
                                    <div class="col-sm-10">
                                       <p>{{$user -> phone}}</p>
                                    </div>
                                </div>
                          
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">总价：</label>
                                    <div class="col-sm-10">
                                        <p>{{$data -> price}}元</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">实付金额：</label>
                                    <div class="col-sm-10">
                                        <p>1元</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">订单创建时间：</label>
                                    <div class="col-sm-4">
                                        <p>{{$data -> servetime}}</p>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                     <label for="inputPassword3" class="col-sm-2 control-label">订单状态：</label>
                                    <div class="col-sm-4">
                                    <p> @if($data -> state == 0)
                                       未付款
                                    @elseif($data -> state==1)
                                       已付款
                                    @endif</p>
                                    </div>
                                    
                                 
                                </div>
                              
                               

                                

                                
                            </div><!-- /.box-body -->
                          
                        </form>
                    </div><!-- /.box -->
                 
                </div><!--/.col (right) -->
            </div>   <!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection