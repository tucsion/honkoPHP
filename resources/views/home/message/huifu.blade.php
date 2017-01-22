@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-患者咨询';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">

<div class="headTitle">患者咨询</div>
<div class="message">
	<ul class="expert">
	@foreach($zixun as $zx)
		<li class="transition">
			<p class="head">
				病历：<a href="{{url('/home/tuisong/blxq')}}/{{$zx -> bid}}" target="_blank">{{$zx -> dname}}</a> 
				专家：{{$zj -> uname }} <span class="time">{{date('Y-m-d H:i:s',$zx ->zxtime) }}</span>
				@if($zx -> state ==0)
				<button class="layui-btn layui-btn-mini layui-btn-danger newIcon">NEW</button>
				@endif
			</p>
			<p class="content">
				{{$zx -> news}}
			</p>
			<p class="showBtn" style='text-align: right;'><a class="layui-btn layui-btn-primary layui-btn-mini" href="{{ url('/record/chatzj') }}/{{$zx -> bid}}/{{$zx -> zjid}}">查看详情 <i class="layui-icon">&#xe602;</i></p></a>
		</li>	
	@endforeach
	</ul>
	<div class="page"> {!! $zixun -> links() !!}</div>
</div>
</div>
	<script src="{{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>


@endsection