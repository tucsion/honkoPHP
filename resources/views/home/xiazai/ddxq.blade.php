 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='康复社-订单支付';
</script> 

<link rel="stylesheet" href="{{ url('/home/css/expert.css') }}">

<div class="container" id="filter">
			
		<dl>
		<dt>订单详情</dt>	
		</dl>
		<dl>
			<dt>订单号:</dt>
			<dd style="color:red;">{{$xq -> servenum}}</dd>
			<dd> <small>状态:</small>
			<small style="color:red;">
			@if($xq -> state == 0)
			未付款
			@endif
			</small></dd>
		</dl>
		<dl>
			<dt style="font-size:13px;">订单信息:</dt>
		</dl>
		<dl>
			<dt style="font-size:13px;">专家姓名:</dt>
			<dd style="font-size:13px;">{{$xq -> uname}}</dd>
		</dl>
		<dl>
			<dt style="font-size:13px;">资料名称:</dt>
			<dd style="font-size:13px;">{{$xq -> name}}</dd>
		</dl>
		<dl>
			<dt style="font-size:13px;">服务类型:</dt>
			<dd style="font-size:13px;">资料下载</dd>
		</dl>
		<dl>
			<dt style="font-size:13px;">金额:</dt>
			<dd style="font-size:13px;">￥:{{$xq -> price}}</dd>
		</dl>
		<dl>
		<dd>
			&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ url('/xiazai/queren')}}/{{$xq -> id}}"><img src="{{ url('/updates')}}/zfb.jpg"></a>
		</dd>
		</dl>
</div>



	<!-- 脚部 -->
@endsection