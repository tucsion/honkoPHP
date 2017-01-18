@extends('admin.layout')
@section('content')
<style type="text/css">
#lunbo {
display: block; 
    height: 34px; 
    width: 107px; 
    line-height: 2; 
    text-align: center; 
    background: blue; 
    color: white; 
    font-size: 14px; 
    font-weight: bold; 
    text-decoration: none; 
    padding-top: 3px;
}
#lunbo:hover{
    background: black;
}
</style>
<script type="text/javascript">
    document.title='友情链接';
</script>
   <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                友情链接
                <small>列表页</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index') }}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="#">友情链接</a></li>
                
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
                        <div class="box-body">
                        <form action="{{ url('/admin/link/index') }}" method='get'>
                        <div style=''>
                        	<div class='col-md-6'>
                            <div class="input-group input-group-sm">
                            <a href="{{ url('/admin/link/add') }}" id='lunbo'>添加友情链接</a>
                            </div>
                            </div>
                            <div class= 'col-md-2' style="text-align:right;"><small>按标题检索</small></div>
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
                                    <th>标题</th>
                                    <th>创建时间</th>
                                    <th>图片</th>
                                    <th>链接</th>  
                                    <th>状态</th>                               
                                    <th>操作</th>
                                </tr>
                                </thead>
                               @foreach($data as $link)
                                <tr>
                                    <td>{{ $link->id }}</td>
                                    
                                    <td>{{ $link -> yqname }}</td>
                                    <td> {{ $link -> addtime }} </td>
                                    <td><img width='100px' height='30px'src="{{ url('/updates') }}/{{ $link -> yqpic }}">&nbsp; &nbsp; <a href="{{ url('/updates') }}/{{ $link -> yqpic }}" target="_blank"><img name='img' src="{{ url('/updates/picsee.png') }}">
                                    </td> 
                                    <td>{{ $link -> yqlink }} </td>
                                     <td>
                                    @if($link ->state == 0)
                                       启用
                                    @elseif($link ->state ==1)
                                       禁用
                                    @endif
                                    </td>                            
                                    <td><a  href="{{ url('/admin/link/edit')}}/{{ $link -> id }}">编辑</a> | <a  href="{{ url('/admin/link/delete')}}/{{ $link -> id }}">删除</a>
                                    </td>
                                </tr>
                               @endforeach

                            </table>
                            {!! $data -> appends($request) -> render() !!}
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                   
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
   


@endsection