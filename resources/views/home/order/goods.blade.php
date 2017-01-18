@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-商品订单';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
@if(session('order'))
<script type="text/javascript">
		alert('订单创建成功');
</script>
@endif
	


<div class="headTitle">商城订单</div>
<div class="order">
	<form action="/order/sx" class="layui-form" method="post">
	{{ csrf_field() }}
		<div class="layui-form-item">
			
			<label class="layui-form-label">状态</label>
			<div class="layui-input-inline" >
				<select name="status" lay-verify="">
					<option value=""></option>
					<option value="0">待付款</option>
					<option value="1">已发货</option>
					<option value="2">已结束</option>
					<option value="3">已取消</option>
				</select>
			</div>
			<label class="layui-form-label">时间区间</label>
			<div class="layui-input-inline">
				<input class="layui-input" placeholder="开始日" name='start' id="date_start">
			</div>
			<div class="layui-input-inline link" style="">-</div>
			<div class="layui-input-inline">
				<input class="layui-input" placeholder="截止日" name='end' id="date_end">
			</div>
			
			<div class="layui-input-inline">
				<button class="layui-btn" lay-submit lay-filter="formDemo">筛选</button>
			</div>
			
		</div>
	</form>
	<table id="order" class="layui-table" lay-skin="line">
		<thead>
			<tr>
				<th>订单编号</th>
				<th>收货人</th>
				<th>费用</th>
				<th>订单状态</th>
				<th>下单时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		@if(empty($order))
		<tr><td>暂无商品订单</td></tr>
		@endif

		@foreach($order as $order)
			<tr>
				<td>{{$order  -> onumber}}</td>
				<td>{{ $order -> uname}}</td>
				<td>￥{{$order -> price}}</td>
				<td>@if($order -> state == 0)
				未付款
				@elseif($order -> state == 1)
				已付款
				@elseif($order -> state == 2)
				已发货
				@elseif($order -> state == 3)
				已收货
				@endif
				</td>
				<td>{{date("Y-m-d H:i:s",$order -> ordertime)}}</td>
				<td>
				@if($order -> state == 0)
					<a href="{{ url('/order/queren')}}/{{$order -> id}}">去付款</a> |
				@endif
					<a href="javascript:void(0);" filterID='10' class="delBtn" id="{{ $order -> id}}">删除</a> |
					<a href="{{ url('/order/goodsxq')}}/{{$order -> id}}" target="_blank">查看</a>
				</td>
			</tr>
		@endforeach	
		</tbody>
	</table>
	<div class="page" >
		
	</div>
</div>
</div>
</div>
<script type="text/javascript" src="{{ url('/home/js/filterDate.js') }}"></script>


<script type="text/javascript">
	
	$('.delBtn').on('click', function() {
		var delTr = $(this).parents('tr');
		// alert(delTr);
		var id = $(this).attr('id');
		layer.confirm('删除操作不可撤销！', {
			btn: ['删除','算了']
		},function(){//确认
			$.ajax({
				url : '/order/delete',
				data : {'id':id},
				type : 'post',
				success : function(data){
					
					if (data.status == 1) {
						delTr.remove();
						layer.msg(data.msg);
						window.location.href="/order/goods"; 
					}else{
						layer.msg(data.msg);
					}
					
				}
			});
		},function(){//取消
			layer.msg('已取消',{
				time : 2000
			});
		});
	});	
</script>
@endsection