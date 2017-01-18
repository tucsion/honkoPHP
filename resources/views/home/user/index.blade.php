@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心';
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
			<div class="index"> 
		<div class="head">
		<img 
		@if(empty($user->headurl))
		src ="{{url('/updates')}}/20151130210650_85035.jpg"
		@else
		src="{{ url('/updates')}}/{{$user -> headurl}}"
		@endif alt="">
		@if(session('user') -> utp !=3)
		<p class="name">
			<span class="name">姓名：{{ $user -> relname }}</span>
			<span class="nicheng">昵称：{{$user -> uname}}</span>
		</p>
		@else
		<p class="name">
			<span class="name">公司名称：{{ $user -> gsname }}</span>
			<span class="nicheng">用户名：{{$user -> uname}}</span>
		</p>
		@endif
		@if(session('user') -> utp == 1)
		<p class="tags">
			<span>我的积分：{{ $user -> jfnum - $user -> userjf}}</span>
			<span>最新消息（<em><a href="{{url('/message/deal')}}">{{$count}}</a></em>）</span>
		</p>
		@endif
		@if(session('user') -> utp == 3)
		<p class="tags">
			<span>最新消息（<em><a href="{{url('/message/xitong')}}">{{$count}}</a></em>）</span>
		</p>
		@endif
		@if(session('user') -> utp == 2)
		<p class="tags">
			<span>我的积分：{{ $user -> jfnum - $user -> userjf}}</span>
			<span>最新消息（<em><a href="{{url('/message/deal')}}">{{$count}}</a></em>）</span>
			@if(session('user') -> jfnum>= 0 and session('user') -> jfnum <= 10000)
			<span>等级:五级</span>
			@endif
			@if(session('user') -> jfnum<= 500000 and session('user') -> jfnum >= 100001)
			<span>等级:三级</span>
			@endif
			@if(session('user') -> jfnum<= 100000 and session('user') -> jfnum >= 10001)
			<span>等级:四级</span>
			@endif
			@if(session('user') -> jfnum<= 1000000 and session('user') -> jfnum >= 500001)
			<span>等级:二级</span>
			@endif
			@if(session('user') -> jfnum<= 2000000 and session('user') -> jfnum >= 1000001)
			<span>等级:一级</span>
			@endif
			@if(session('user') -> jfnum<= 20000001 and session('user') -> jfnum >= 2000001)
			<span>等级:特级</span>
			@endif
			<span>未读病例:</span>
		</p>
		@endif
	</div>
	@if(session('user') -> utp == 1)
	<div class="list">
		<p class="bTitle">近期订单</p>
		<table class="layui-table">
			<thead>
				<tr>
					<th>订单编号</th>
					<th>下单时间</th>
					<th>订单类型</th>
					<th>总金额</th>
					<th>订单状态</th>
					<th>操作</th>
				</tr> 
			</thead>
			<tbody>
			@foreach($order as $order)
				<tr>
					<td>{{$order -> onumber}}</td>
					<td>{{ date('Y-m-d',$order -> ordertime)}}</td>
					<td>商品订单</td>
					<td>￥{{$order -> price}}</td>
					<td>
						@if($order-> state == 0)
						未付款
						@elseif($order -> state == 1)
						已付款
						@elseif($order -> state == 2)
						已发货
						@elseif($order -> state == 3)
						已收货
						@endif
					</td>
					<td>
						<a href="{{ url('/order/orderxq')}}/{{$order -> id}}" id="character">查看</a>
					</td>
				</tr>
			@endforeach
			@foreach ($serve as $ser)
				<tr>
					<td>{{$ser -> servenum}}</td>
					<td>{{ date('Y-m-d',$ser -> servetime)}}</td>
					<td>服务订单</td>
					<td>￥{{$ser -> price}}</td>
					<td>
						@if($ser-> state == 0)
						未付款
						@elseif($ser -> state == 1)
						已付款
						@elseif($ser -> state == 2)
						已发货
						@elseif($ser -> state == 3)
						已收货
						@endif
					</td>
					<td>
						<a href="{{ url('/order/servexq')}}/{{$ser -> id}}" id="character">查看</a>
					</td>
				</tr>
			@endforeach
				
			</tbody>
		</table>
	</div>
	@endif
	
</div> <!--index-->
		</div>
	</div>

	<!-- 脚部 -->

	
@endsection