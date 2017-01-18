@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-等级规则';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">


<div class="headTitle">等级规则</div>
<div class="integration">
	<table class="layui-table">
		<thead>
			<tr>
				<th>等级</th>
				<th>积分总量</th>
			</tr>
		</thead>
		<tbody>
		@foreach($data as $jf)
			<tr>
				<td>{{$jf -> level}}</td>
				<td>{{$jf -> jfxiao }}--{{$jf -> jfda}}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
</div>
@endsection
