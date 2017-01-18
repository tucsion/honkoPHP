@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-认证管理';
</script>
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>
@if(session('rz'))
	<script type="text/javascript">
		alert('提交认证消息成功');
	</script>
@endif
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">

<div class="verify">
	<form class="layui-form" action="{{ url('/home/zjuser/rzadd')}}" method="post" ENCTYPE= 'MULTIPART/FORM-DATA'>
	{{ csrf_field() }}
		<div class="layui-form-item">
			<label class="layui-form-label">真实姓名</label>
			<div class="layui-input-inline">
				<input type="text" name="relname" required value="{{$user -> relname}}" lay-verify="required" placeholder="请输真实姓名" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">性别</label>
			<div class="layui-input-block">
				<input name="sex" value="男" title="男" checked="checked" type="radio">
				<input name="sex" value="女" title="女" type="radio">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">证件类型</label>
			<div class="layui-input-inline">
				<select name="zjtype" id="">
					<option value="">请选择证件类型</option>
					<option value="职称证">职称证</option>
				</select>
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">证件号码</label>
			<div class="layui-input-block w50">
				<input type="text" name="cardno" required lay-verify="identity" placeholder="" class="layui-input">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">证件照片</label>
			<div class="layui-input-block">
				<input name="file1" class="layui-upload-file" lay-title="正面" type="file"> 
				
				<input name="file2" class="layui-upload-file" lay-title="反面" type="file">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label"></label>
			<div class="layui-input-block w50">
				<button class="layui-btn" lay-submit="" lay-filter="demo2">提交</button>
			</div>
		</div>
	</form>
</div>
</div>
<script type="text/javascript">
	layui.use(['form','upload'],function(){
		var form = layui.form();
		form.render();
		layui.upload({
			// elem : '#test',
		    url: '/home/user/img' //上传接口
		    ,
		    method :'post',
		    
			success: function(res){ //上传成功后的回调
		    	
		    	
	    	}
		});
	});
</script>
@endsection