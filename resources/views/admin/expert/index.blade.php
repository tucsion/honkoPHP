
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
    #zti {margin:0;padding:0;line-height:1.5em;font-family:Georgia,"Times New Roman",Times,serif;font-size:15px;color:#33322e;background: #39443D url(images/templatemo_body_bg.jpg) repeat-x;}
     {{ date_default_timezone_set('PRC') }} 
</style>
<script type="text/javascript">
   document.title='专家信息';
</script>


	    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                医生个人信息 
                <small>列表</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index') }}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="{{ url('/admin/expert/index')}}">专家个人信息</a></li>
                <li class="active">列表</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">快速查看</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                        <form action="{{ url('/admin/expert/index') }}" method='get'>
                        <div class='row'>
                        	<div class='col-md-2'>
                             <div class="form-group">
                             <select name='num' class="form-control">

                                <option 

                                @if(!empty($request['num']) && $request['num'] == 10)
                                selected = "selected"
                                @endif

                                value="10">10</option>
                                <option 

                                 @if(!empty($request['num']) && $request['num'] == 25)
                                selected = "selected"
                                @endif

                                value="25">25</option>
                                <option 

                                 @if(!empty($request['num']) && $request['num'] == 50)
                                selected = "selected"
                                @endif

                                value="50">50</option>
                                <option 

                                 @if(!empty($request['num']) && $request['num'] == 100)
                                selected = "selected"
                                @endif

                                value="100">100</option>
                             </select>
                            </div>   
                            </div>
                             
                            <div class='col-md-2' style="text-align:right;">
                            <small id='zti' style="color: white;">按手机号检索</small>
                            </div>
                        	<div class='col-md-2'>
                        		<div class="input-group input-group">
		                            <input name='keywords' type="text" value="{{ $request['keywords'] or '' }}" class="form-control">
                                
                               
				                   
                                  </div>
                        		
                        	</div>
                              <div class='col-md-2' style="text-align:right;">
                            <small id='zti' style="color: white;">按昵称检索</small>
                            </div>
                            <div class='col-md-2'>
                                <div class="input-group input-group">
                                    <input name='keyword' type="text" value="{{ $request['keyword '] or '' }}" class="form-control">
                                
                               
                                    <span class="input-group-btn">
                                      <button class="btn btn-info btn-flat" >搜索</button>
                                    </span>
                                  </div>
                                
                            </div>
                            <div class='col-md-2'>
                            <div class="input-group input-group-sm">
                            <a href="{{ url('/admin/expert/add') }}" id='lunbo'>添加专家</a>
                            </div>
                            </div>
                        </div>

                        </form>
                       	<br><br>
                         @if(session('user2del'))
                        <div class="callout callout-info">
                                <ul>
                                   
                                        <li>{{ session('user2del') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif
                         @if(session('user2add'))
                        <div class="callout callout-info">
                                <ul>
                                   
                                        <li>{{ session('user2add') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif
                        @if(session('user2edit'))
                        <div class="callout callout-info">
                                <ul>
                                   
                                        <li>{{ session('user2edit') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>姓名</th>
                                    <th>昵称</th>
                                    <th>性别</th>
                                    <th>手机</th>
                                    <th>创建时间</th>
                                    <th>认证</th>
                                    <th>操作</th>

                                    
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $expert)

                               


                                <tr>
                                    <td>{{ $expert -> id }}</td>
                                    <td>{{ $expert -> relname }}
                                    </td>
                                    <td>{{ $expert -> uname }}</td>
                                    <td>
                                    @if( $expert -> sex  == 0)
                                    男
                                    @elseif($expert -> sex  == 1)
                                    女
                                    @endif
                                    </td>
                                    <td >{{ $expert -> phone }}</td>
                                    <td>{{ date('Y-m-d H:i:s', $expert -> phone ) }}</td>
                                    <td>
                                    @if( $expert -> isrz  == 0)
                                    未认证
                                    @elseif($expert -> isrz  == 1)
                                    <p style="color:red;">已认证</p>
                                    @endif
                                    </td>
                                   	<td><a  href="{{ url('/admin/expert/edit')}}/{{ $expert -> id }}">编辑</a> | 
                                    <a onclick="javascript:if(!confirm('确定要删除选择的信息吗？\n此操作不可以恢复！')) { return false; }"   href="{{ url('/admin/expert/delete')}}/{{ $expert -> id }}"><font color="green">删除</font></a>
                                    </td>
                                </tr>

                                @endforeach
                            </table>
							<div>
                            {!! $data -> appends($request) -> render() !!}
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                   
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


@endsection