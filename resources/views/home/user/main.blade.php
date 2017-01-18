<div class="index"> 
 @if (count($errors) > 0)
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li style="font-size: 25px;color:red;">{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
@endif
@if(session('pass'))
		<div class="alert alert-danger">
			        <ul>
			           
			                <li style="font-size: 25px;color:red;">{{ $session('pass') }}</li>
			            
			        </ul>
			    </div>
@endif
	<div class="head">
		<img 
		@if(empty($user->headurl))
		src ="{{url('/updates')}}/20151130210650_85035.jpg"
		@else
		src="{{ url('/updates')}}/{{$user -> headurl}}"
		@endif alt="">
		<p class="name">
			<span class="name">姓名：{{ $user -> relname }}</span>
			<span class="nicheng">昵称：{{$user -> uname}}</span>
		</p>
		<p class="tags">
			<span>我的积分：{{ $user -> jfnum - $user -> userjf}}</span>
			<span>最新消息（<em><a href="#"></a></em>）</span>
		</p>
	</div>
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
						<a href="javascript:void(0);" id="character">查看</a>
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
						<a href="javascript:void(0);" id="character">查看</a>
					</td>
				</tr>
			@endforeach
				
			</tbody>
		</table>
	</div>
	
	
</div> <!--index-->