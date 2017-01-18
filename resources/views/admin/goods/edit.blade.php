@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='商品修改';
</script> 
<style type="text/css">  
     {{ date_default_timezone_set('PRC') }} 
</style>

<!-- 配置文件 -->
<script type="text/javascript" src="{{ url('/admin/ue/ueditor.config.js') }}"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{ url('/admin/ue/ueditor.all.js') }}"></script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                商品管理
                <small>修改</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="#">商品管理</a></li>
                <li class="active">修改页面</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
 
                <!-- right column -->
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">修改页面</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                       
                        @if(session('info'))
                        <div class="alert alert-danger">
                                <ul>
                                   
                                        <li>{{ session('info') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif
                         @if(session('img'))
                        <div class="alert alert-danger">
                                <ul>
                                   
                                        <li>{{ session('img') }}</li>
                                    
                                </ul>
                            </div>
                            
                        @endif

                        <form class="form-horizontal" action="{{ url('/admin/goods/update') }}" method='post'  ENCTYPE= 'MULTIPART/FORM-DATA'>
                            {{ csrf_field() }}
                             <input type='hidden' name='id' value="{{ $good -> id }}"></input>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">商品名</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='gname' value="{{ $good -> gname }}" class="form-control" id="inputEmail3" placeholder="请输入商品名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                <label for="inputPassword3"  class="col-sm-2 control-label">商品分类</label>

                                    <div class="col-sm-10">
                                     <select name='cid' class='form-control'>  
                                       
                                     @foreach($res as $cate)
                                           <option value="{{ $cate ->id }}" 
                                        @if($cate -> id == $good -> cid)
                                        selected = "selected"
                                        @endif
                                           >{{ $cate->cate }}</option>

                                          
                                     @endforeach  

                                       </select>  

                                    </div>  

                                </div>
                                <div class="form-group">
                                <label for="inputPassword3"  class="col-sm-2 control-label">适用范围</label>
                                    <div class="col-sm-10">
                                     <select name='scope' class='form-control'>
                                           
                                     @foreach($scope as $scope)

                                           <option value="{{ $scope ->id }}"
                                             @if($scope -> id == $good -> scope)
                                                selected = "selected"
                                            @endif
                                           >{{ $scope -> name }}</option>
                                     @endforeach     
                                       </select>  
                                    </div>                           
                                </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">商品价格</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='price' value="{{ $good -> price }}" class="form-control" id="inputPassword3"
                                               placeholder="请输入商品价格">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">商品库存</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='stock' value="{{ $good -> stock }}" class="form-control" id="inputPassword3"
                                               placeholder="请输入商品库存数量">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">品牌</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='brand' value="{{ $good -> brand }}" class="form-control" id="inputPassword3"
                                               placeholder="请输入商品的品牌">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">重量</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='weight' value="{{ $good -> weight }}" class="form-control" id="inputPassword3"
                                               placeholder="请输入商品的重量">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">商品图片</label>
                                    <div class="col-sm-4">
                                    <input type="file" name='img' id="exampleInputFile">
                                    <p class="help-block">Example block-level help text here.</p>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" name='pic' value="{{ $good -> img }}" class="form-control" id="inputEmail3" placeholder="">
                                    </div>
                                    <div class="col-sm-1">
                                    <a href="{{ url('/updates')}}/{{$good -> img}}" target="_blank"><img name='pic' src="{{ url('/updates/picsee.png') }}">
                                    </a>
                                    </div>
                                </div>
                                <div class="form-group">
                                 <label for="inputPassword3"  class="col-sm-2 control-label">生产厂家</label>
                                    <div class="col-sm-10">
                                     <select name='vender' class='form-control'>
                                           <option value="0">暂无生产厂家</option>
                                     @foreach($vender as $vender)

                                           <option value="{{ $vender ->id }}"
                                            @if($vender -> id == $good -> vender)
                                            selected = "selected"
                                            @endif
                                           >{{ $vender -> name }}</option>
                                     @endforeach     
                                       </select>   
                                    </div>   
                                </div>
                                <div class="form-group">
                                 <label for="inputPassword3"  class="col-sm-2 control-label">代理商</label>
                                    <div class="col-sm-10">
                                     <select name='agent' class='form-control'>
                                           <option value="0">暂无代理商</option>
                                     @foreach($agent as $agent)

                                           <option value="{{ $agent ->id }}"
                                            @if($agent -> id == $good -> agent)
                                            selected = "selected"
                                            @endif

                                           >{{ $agent -> name }}</option>
                                     @endforeach     
                                       </select>   
                                    </div>   
                                </div>
                                <div class="form-group">
                                 <label for="inputPassword3" class="col-sm-2 control-label">商品状态</label>
                                <div class="col-sm-10">
                               
                                 <select name='state' class='form-control'>
                                       <option value='0'>上架</option>
                                       <option value="1">下架</option>   
                                   </select>
                                    
                                </div>
                                  
                              </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">详细信息</label>
                                    <div class="col-sm-10">
                                    <!-- 加载编辑器的容器 -->
                                    <script id="container1" name="news" type="text/plain">{{$good -> news}}
                                    </script>
                                    <!-- 实例化编辑器 -->
                                    <script type="text/javascript">
                                        var ue = UE.getEditor('container1');
                                    </script>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">参数</label>
                                    <div class="col-sm-10">
                                            <!-- 加载编辑器的容器 -->
                                            <script id="container2" name="parameter" type="text/plain">{{$good -> parameter}}
                                            </script>
                                            <!-- 实例化编辑器 -->
                                            <script type="text/javascript">
                                                var ue = UE.getEditor('container2');
                                            </script>
                                    </div>
                                </div> 
                               
   
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button type="reset" class="btn btn-default">重置</button>
                                <button type="submit" class="btn btn-info pull-right">提交</button>
                            </div><!-- /.box-footer -->
                        </form>
                    </div><!-- /.box -->
                 
                </div><!--/.col (right) -->
            </div>   <!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection