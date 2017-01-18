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
			<dd style="color:red;">{{$sp -> onumber}}</dd>
			<dd> <small>状态:</small>
			<small style="color:red;">
			@if($sp -> state == 0)
			未付款
			@endif
			@if($sp -> state == 1)
			已付款
			@endif
			@if($sp -> state == 2)
			已发货
			@endif
			@if($sp -> state == 3)
			已收货
			@endif
			</small></dd>
		</dl>
		<dl>
			<dt style="font-size:13px;">收货人信息:</dt>
			<dt style="font-size:13px;">收货人姓名:</dt>
			<dd style="font-size:13px;">{{$dz -> uname}}</dd>
			<dt style="font-size:13px;">收货人地址:</dt>
			<dd style="font-size:13px;">{{$dz -> address}}</dd>
			<dt style="font-size:13px;">收货人电话:</dt>
			<dd style="font-size:13px;">{{$dz -> utel}}</dd>
		</dl>
		<dl>
			<dt style="font-size:13px;">支付及配送方式:</dt>
			<dt style="font-size:13px;">支付方式:</dt>
			<dd style="font-size:13px;">支付宝</dd>
			<dt style="font-size:13px;">物流公司:</dt>
			<dd style="font-size:13px;">{{$sp -> express}}</dd>
			<dt style="font-size:13px;">物流单号:</dt>
			<dd style="font-size:13px;">{{$sp -> exnum}}</dd>
		</dl>
		<dl>
		@if(empty($sp -> fp))
			<dt style="font-size:13px;">发票信息:</dt>
			<dt style="font-size:13px;">未需求发票</dt>
		@else
			<dt style="font-size:13px;">发票信息:</dt>
			<dt style="font-size:13px;">发票抬头</dt>
			<dd style="font-size:13px;">{{$fp -> depict}}</dd>
			<dt style="font-size:13px;">发票类型:</dt>
			<dd style="font-size:13px;">{{$fp -> billtype}}</dd>
			<dt style="font-size:13px;">发票项目:</dt>
			<dd style="font-size:13px;">{{$fp -> billitem}}</dd>
		@endif
		</dl>
		<dl>
			<dt style="font-size:13px;">订单信息:</dt>
			<dt style="font-size:13px;">订单编号</dt>
			<dd style="font-size:13px;">{{$sp -> onumber}}</dd>
			<dt style="font-size:13px;">发货时间</dt>
			<dd style="font-size:13px;">{{$sp -> turntime}}</dd>
			<dt style="font-size:13px;">成交时间</dt>
			<dd style="font-size:13px;">{{$sp -> emittime}}</dd>
		</dl>
		<dl>
			商品信息:
		</dl>
		@foreach($xq as $spxq)
		<dl>
			<dt style="font-size:13px;">订单编号:</dt>
			<dd style="font-size:13px;">{{$spxq -> unumber}}</dd>
			<dt style="font-size:13px;">商品图片:</dt>
			<img src="{{ url('/updates')}}/{{$spxq -> img}}" style="width:150px;height: 150px;"></a>
			<dt style="font-size:13px;">商品名称:</dt>
			<dd style="font-size:13px;">{{$spxq -> gname}}</dd>
			<dt style="font-size:13px;">商品数量:</dt>
			<dd style="font-size:13px;">{{$spxq -> num}}</dd>
		</dl>
		@endforeach
		<dl>
			<dt style="font-size:13px;">总金额:</dt>
			<dd style="font-size:13px;">{{$sp -> price}}</dd>
		</dl>
		@if($sp -> state == 0)
		<dl>
		<dd>
			&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ url('/order/queren')}}/{{$sp -> id}}"><img src="{{ url('/updates')}}/zfb.jpg"></a>
		</dd>
		</dl>
		@endif
</div>



	<!-- 脚部 -->
@endsection