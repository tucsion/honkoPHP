@extends('admin.layout')
@section('content')
<script type="text/javascript">
    document.title='教育与培训文章添加';
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
                文章管理
                <small>添加</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ url('/admin/index')}}"><i class="fa fa-dashboard"></i>主页</a></li>
                <li><a href="#">教育与培训文章管理</a></li>
                <li class="active">添加页面</li>
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
                            <h3 class="box-title">添加页面</h3>
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

                        <form class="form-horizontal" action="{{ url('/admin/train/insert') }}" method='post'  ENCTYPE= 'MULTIPART/FORM-DATA'>
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">文章标题</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='name' value="{{ old('name') }}" class="form-control" id="inputEmail3" placeholder="请输入文章标题">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">seo标题</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='seoname' value="{{ old('seoname') }}" class="form-control" id="inputEmail3" placeholder="请输入seo标题，如留空等于标题">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">seo关键字</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='seo' value="{{ old('seo') }}" class="form-control" id="inputEmail3" placeholder="请输入seo关键字，如留空等于标题">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">seo描述</label>
                                    <div class="col-sm-10">
                                        <textarea  name='depict' cols='90%'>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label for="inputPassword3"  class="col-sm-2 control-label">类别</label>
                                    <div class="col-sm-10">
                                     <select name='cid' class='form-control'>  
                                       
                                     @foreach($data as $cate)
                                           <option value="{{ $cate ->id }}">{{ $cate->cate }}</option>

                                          
                                     @endforeach  

                                       </select>  

                                    </div>  

                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">访问次数</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='visitnum' value="{{ old('visitnum') }}" class="form-control" id="inputPassword3"
                                               placeholder="请输入访问次数，可留空">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">信息内容</label>
                                    <div class="col-sm-10">
                                    <!-- 加载编辑器的容器 -->
                                    <script id="container1" name="news" type="text/plain">
                                    </script>
                                    <!-- 实例化编辑器 -->
                                    <script type="text/javascript">
                                        var ue = UE.getEditor('container1');
                                    </script>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">封面图片</label>
                                    <div class="col-sm-10">
                                    <input type="file" name='img' id="exampleInputFile">
                                    <p class="help-block">Example block-level help text here.</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">发布日期</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='addtime' value="{{ date('Y-m-d H:i:s', time()) }}" class="form-control" id="inputPassword3"
                                               placeholder="请输入文章的添加时间">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">作者</label>
                                    <div class="col-sm-10">
                                        <input type="text" name='author' value="{{ old('author') }}" class="form-control" id="inputPassword3"
                                               placeholder="请输入作者姓名">
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