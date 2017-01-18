@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-我的积分';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
	<!-- 内容区域 -->

<div class="headTitle">积分记录</div>
<div class="integration">
	<table class="layui-table">
		<tr>
			<th>总积分</th>
			<th>已使用积分</th>
			<th>剩余积分</th>
		</tr>
		<tr>
			<td>{{$num -> jfnum }}</td>
			<td><span>{{ $num -> userjf}}</span></td>
			<td>{{ $num -> jfnum - $num -> userjf}}</td>
		</tr>
	</table>
	<p>&nbsp;</p>
	<table class="layui-table" lay-even lay-skin="nob">
		<thead>
			<tr>
				<th>动作名称</th>
				<th>积分数量</th>
				<th>发生时间</th>
			</tr>
		</thead>
		<tbody>
		@foreach($jf as $jfs)
			<tr>
				<td>{{ $jfs -> operate}}</td>
				<td>{{ $jfs -> addup }}</td>
				<td>{{ date('Y-m-d H:i:s',$jfs -> operatetime)}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	<div class="page"> {!! $jf -> links() !!}</div>
</div>
</div>
@endsection