@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-资料列表';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
@if(session('tj'))
	<script type="text/javascript">
		alert('文章添加成功');
	</script>
@endif
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
		<div class="index"> 
		<ul class="data">
		@foreach($wz as $wenzang)
			<li>
				<a href="{{ url('/expert/wenzang')}}/{{$wenzang -> id}}"><i class="layui-icon">&#xe623;</i>{{$wenzang -> name}}</a>
				<span class="time">{{date("Y-m-d",$wenzang -> dtime)}}</span>
			</li>
		@endforeach
		</ul>
		<div class="page"> {!! $wz -> links() !!}</div>
		</div>

	<!-- 脚部 -->

	
@endsection