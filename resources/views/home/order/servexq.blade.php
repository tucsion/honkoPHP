 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='康复社-订单支付';
</script> 

<link rel="stylesheet" href="{{ url('/home/css/expert.css') }}">
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>

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
			@if($xq -> state == 1)
			已付款
			@endif
			</small></dd>
		</dl>
		@if($xq -> type == 1)
		<dl>
			<dt style="font-size:13px;">文章信息:</dt>
			<dt style="font-size:13px;">文章名称:</dt>
			<dd style="font-size:13px;">{{$wzxq -> name}}</dd>
			<dt style="font-size:13px;">发布专家:</dt>
			<dd style="font-size:13px;">{{$zj -> uname}}</dd>
			<dt style="font-size:13px;">服务类型:</dt>
			<dd style="font-size:13px;">资料下载</dd>
		</dl>
		@endif
		@if($xq -> type == 0)
		<dl>
			<dt style="font-size:13px;">详细信息:</dt>
			<dt style="font-size:13px;">病例名称:</dt>
			<dd style="font-size:13px;">{{$bl -> dname}}<a href="javascript:void(0);" filterID='10' class="showBtn" id="{{ $bl -> id}}">查看</a></dd>
			<dt style="font-size:13px;">咨询专家:</dt>
			<dd style="font-size:13px;">{{$zj -> uname}}</dd>
			<dt style="font-size:13px;">服务类型:</dt>
			<dd style="font-size:13px;">在线咨询</dd>
		</dl>
		@endif
		<dl>
			<dt style="font-size:13px;">订单信息:</dt>
			<dt style="font-size:13px;">订单编号:</dt>
			<dd style="font-size:13px;">{{$xq -> servenum}}</dd>
			<dt style="font-size:13px;">下单时间:</dt>
			<dd style="font-size:13px;">{{date('Y-m-d H:i:s',$xq -> servetime)}}</dd>
			
			
		</dl>
		<dl>
			<dt style="font-size:13px;">总金额:</dt>
			<dd style="font-size:13px;">{{$xq -> price}}</dd>
		</dl>
		@if($xq -> state == 0)
		<dl>
		<dd>
			&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ url('/order/serveqr')}}/{{$xq -> id}}"><img src="{{ url('/updates')}}/zfb.jpg"></a>
		</dd>
		</dl>
		@endif
</div>

<script type="text/javascript">
	//查看病例信息
	$('.showBtn').on('click', function() {
		var id = $(this).attr('id');
		$.post('/ill/casexq', {'id':id}, function(str){
		  layer.open({
		  	type: 1,
		  	title : '查看病历信息',
		  	shade : [0.3,'#000'],
		  	shadeClose : false,
		  	scrollbar : false,
		  	area: ['700px', '500px'],
		  	content: str, //注意，如果str是object，那么需要字符拼接
		  	btn:['关闭'],
		    
		  });
		});
	});
</script>

	<!-- 脚部 -->
@endsection