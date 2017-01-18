@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-添加文章';
</script>
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>
@if(session('pass'))
	<script type="text/javascript">
		alert('密码修改成功');
	</script>
@endif
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
<script type="text/javascript" src="{{ url('/admin/ue/ueditor.config.js') }}"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="{{ url('/admin/ue/ueditor.all.js') }}"></script>
<div class="base">
	<div class="headTitle">基础资料</div>
	<div class="content">
	@if(session('tjd'))
	<script type="text/javascript">
		alert('文章添加失败');
	</script>
	@endif
	
		<form class="layui-form" action="{{ url('/home/zl/insert')}}" method="post" ENCTYPE= 'MULTIPART/FORM-DATA'>
 		{{ csrf_field() }}
			<!-- 头像 -->
			<div class="layui-form-item">
				<label class="layui-form-label">所属分类</label>
				<div class="layui-input-inline">
					<select name="dtype" lay-verify="">
					  <option value="">请选择一个分类</option>
					  <option value="1">ST</option>
					  <option value="2">OT</option>
					  <option value="3">PT</option>
					  <option value="4">其他</option>
					</select>     
				</div>
			</div>
			<!-- 昵称 -->
			<div class="layui-form-item">
				<label class="layui-form-label">文章名称</label>
				<div class="layui-input-inline">
					<input type="text" name="name" required  lay-verify="required" placeholder="请输文章名称" value='' class="layui-input">
					<input type="hidden" name='dtime' value="{{time()}}"></input>
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">试读字数</label>
				<div class="layui-input-inline">
					<input type="text" name="wordnum" required  lay-verify="required" placeholder="请输文章试读字数" value='' class="layui-input">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">文章收费</label>
				<div class="layui-input-inline">
					<input type="text" name="dpay" required  lay-verify="required" placeholder="" value='10.00' class="layui-input" disabled>
				</div>
			</div>
			<!-- 邮箱 -->
			<div class="layui-form-item">
				<label class="layui-form-label">内容</label>
				<div class="layui-input-block">
					
                        <!-- 加载编辑器的容器 -->
                        <script id="container1" name="news" type="text/plain">
                        </script>
                        <!-- 实例化编辑器 -->
                        <script type="text/javascript">
                            var ue = UE.getEditor('container1');
                        </script>
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-input-block">
					<button class="layui-btn" lay-submit lay-filter="">提交</button>
					
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

