 @extends('layout')
 @section('content')
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
                <div class="col-lg-3 col-xs-6">
                   这是后台首页
                </div><!-- ./col -->
               
            </div><!-- /.row -->
            

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection