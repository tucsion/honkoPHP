@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='会员订单详情';
</script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              订单详情
               
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{ url('/admin/myorder/index')}}">会员订单</a></li>
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
                       
                        @if(session('info'))
                        <div class="alert alert-danger">
                                <ul>
                                   
                                        <li>{{ session('info') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif

                       
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">姓名</label>
                                    <div class="col-sm-10">
                                       <p>{{ $user -> relname }}</p>
                                    </div>
                                </div>
                               
                              <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">昵称</label>
                                    <div class="col-sm-10">
                                       <p>{{$user -> uname}}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">电话</label>
                                    <div class="col-sm-10">
                                       <p>{{$user -> phone}}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">商品名称</label>
                                    <div class="col-sm-10">
                                        <p>1</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">数量</label>
                                    <div class="col-sm-10">
                                        <p>1个</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">总价</label>
                                    <div class="col-sm-10">
                                        <p>{{$data -> price}}元</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">实付金额</label>
                                    <div class="col-sm-10">
                                        <p>1元</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">收货人</label>
                                    <div class="col-sm-4">
                                       <p>{{$data -> conname }}</p>
                                    </div>
                                    <label for="inputEmail3" class="col-sm-2 control-label">收货地址</label>
                                    <div class="col-sm-4">
                                       <p>1</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">订单创建时间</label>
                                    <div class="col-sm-4">
                                        <p>{{$data -> ordertime}}</p>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                     <label for="inputPassword3" class="col-sm-2 control-label">订单状态</label>
                                    <div class="col-sm-4">
                                    <p>{{$data -> state }}</p>
                                    </div>
                                    
                                    <label for="inputEmail3" class="col-sm-2 control-label">物流单号</label>
                                    <div class="col-sm-4">
                                        <input type="text" name='' value="{{$data -> exnum }}" class="form-control" id="inputEmail3" placeholder="请输入物流单号">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">物流公司</label>
                                    <div class="col-sm-4">
                                        <input type="text" name='' value="{{$data -> express }}" class="form-control" id="inputEmail3" placeholder="请输入物流公司名称">
                                    </div>
                                   
                                </div>
                               

                                

                                
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                
                                <button type="submit" class="btn btn-info pull-right">完成确认</button>
                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                 
                </div><!--/.col (right) -->
            </div>   <!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection