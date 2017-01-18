 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='支付宝支付接口';
</script> 

<link rel="stylesheet" href="{{ url('/home/css/expert.css') }}">

<div class="container" id="filter">
		<div>
		<dl>
			<dd style="font-size:13px;color:red;">1、确认信息 </dd>
			<dd style="font-size:13px;"> → 2、点击确认</dd>
			<dd style="font-size:13px;"> → 3、确认完成</dd>
		</dl>
		</div>
		<dl style="text-align:center;">
			<dt>订单号:</dt>
			<dd style="color:red;">{{$dd -> servenum}}</dd>
		</dl>
		
		<dl style="text-align:center;">
			<dt style="font-size:13px;">订单名称:</dt>
			<dd style="font-size:13px;">鸿康医疗服务{{$dd -> servenum}}</dd>
		</dl >
		<dl style="text-align:center;">
			<dd style="font-size:13px;">付款金额:￥{{$dd -> price}}</dd>
		</dl>
		<dl style="text-align:center;">
			<dt style="font-size:13px;">订单描述:</dt>
			<dd style="font-size:13px;">鸿康医疗服务{{$dd -> servenum}}</dd>
		</dl>
		<dl style="text-align:center;">
			<dd style="font-size:13px;color:red;"><a href="{{ url('/alipay/pay')}}/{{$dd -> id}}"><p style="color:#921AFF;font-size:16px;">确认支付</p></a></dd>
		</dl>
</div>



	<!-- 脚部 -->
@endsection