@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-病例详情';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
@if(session('pass'))
	<script type="text/javascript">
		alert('原密码不正确');
	</script>
@endif
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
<div class="base">
	<div class="headTitle">病例详情</div>
	<div class="content">
			<div class="layui-form-item">
				<label class="layui-form-label">姓名:</label>
				<div class="layui-input-inline">
					<p style="padding:9px 15px; ">{{$bl -> dname}}</p>
				</div>
				<label class="layui-form-label">出生日期:</label>
				<div class="layui-input-inline">
					<p style="padding:9px 15px; ">{{$rw -> cbir}}</p>
				</div>
				<label class="layui-form-label">性别:{{$rw -> csex}}</label>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">职业:</label>
				<div class="layui-input-inline">
					<p style="padding:9px 15px; ">{{$rw -> job}}</p>
				</div>
				<label class="layui-form-label">现住址:</label>
				<div class="layui-input-inline">
					<p style="padding:9px 15px; ">{{$rw -> caddress}}</p>
				</div>
				<label class="layui-form-label">婚否:{{$rw -> state}}</label>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">入院时间:</label>
				<div class="layui-input-inline">
					<p style="padding:9px 15px; ">{{$rw -> intime}}</p>
				</div>
				
			</div>
			<!-- 邮箱 -->
			<div class="layui-form-item">
				<label class="layui-form-label">病症描述:</label>
				<div class="layui-input-block">
					<p style="padding:9px 15px; ">{{$bl -> explain}}</p>
				</div>
			</div>
			
			<!-- 详细地址 -->
			<div class="layui-form-item">
				<label class="layui-form-label">检测报告:</label>
				<div class="layui-input-block">
				@if(empty($bl->baogaoimg))
				<p style="padding:9px 15px; ">暂未上传</p>
				@endif
				@if(!empty($bl -> baogaoimg))
				@foreach($bl -> baogaoimg as $bgimg)
					<img src="{{ url('/updates')}}/{{$bgimg}}" style="width:50px;height: 50px;">
				@endforeach
				@endif
				</div>
			</div>
			<!-- 所属医院 -->
			<div class="layui-form-item">
				<label class="layui-form-label">康复评定:</label>
				<div class="layui-input-block">
				@if(empty($bl->meteimg))
					<p style="padding:9px 15px; ">暂未上传</p>
				@endif
				@if(!empty($bl -> meteimg))
				@foreach($bl -> meteimg as $pdimg)
					<img src="{{ url('/updates')}}/{{$pdimg}}" style="width:50px;height: 50px;">
				@endforeach
				@endif
				</div>
			</div>
			<!-- 手机号码 -->
			<div class="layui-form-item">
				<label class="layui-form-label">电子病历:</label>
				<div class="layui-input-inline">
				@if(empty($bl->emrimg))
				<p style="padding:9px 15px; ">暂未上传</p>
				@endif
				@if(!empty($bl -> emrimg))
				@foreach($bl -> emrimg as $blimg)
					<img src="{{ url('/updates')}}/{{$blimg}}" style="width:50px;height: 50px;">
				@endforeach
				@endif
				</div>
			</div>
	</div>
</div>
</div>
@endsection