 @extends('admin.layout')
 @section('content')
 <script type="text/javascript">
    document.title='康复社后台管理系统';

</script>
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>
 <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                主页
                <small>welcome</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index') }}"><i class="fa fa-dashboard"></i> 主页</a></li>
                <li class="active">welcome</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                        @if(session('info'))
                        <div class="callout callout-info">
                                <ul>
                                   
                                        <li>{{ session('info') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif
                <div class="col-lg-3 col-xs-3">
                   <ul class="clearFix">
                        <li style="top: 0px;">
                        <a href="{{ url('/admin/goods/index')}}">
                        <p style="text-align:center;">
                        <img height="110" width="110" alt="" src="/updates/img05.png">
                        </p>
                        <p style="text-align:center;">商品管理</p>
                        </a>
                        </li>
                    </ul>
                </div>
                   <div class="col-lg-3 col-xs-3">
                   <ul class="clearFix">
                        <li style="top: 0px;">
                        <a href="{{ url('/admin/myorder/index')}}">
                        <p style="text-align:center;">
                        <img height="110" width="110" alt="" src="/updates/img05.png">
                        </p>
                        <p style="text-align:center;">订单管理</p>
                        </a>
                        </li>
                    </ul>
                </div><!-- ./col -->
               
            </div><!-- /.row -->
            

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection