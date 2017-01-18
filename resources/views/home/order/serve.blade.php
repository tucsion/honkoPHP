@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-服务订单';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
<div class="headTitle">服务订单</div>
<div class="order">
	<form action="/order/sersx"  class="layui-form" method="post" >
	{{ csrf_field() }}
		<div class="layui-form-item">
			<label class="layui-form-label">状态</label>
			<div class="layui-input-inline" style="margin-right: 30px">
				<select name="status" lay-verify="">
					<option value=""></option>
					<option value="0">待付款</option>
					<option value="1">已付款</option>
					<option value="2">已发货</option>
					<option value="3">已收货</option>
				</select>
			</div>
			<label class="layui-form-label">时间区间</label>
			<div class="layui-input-inline">
				<input class="layui-input" name='start' placeholder="开始日" id="date_start">
			</div>
			<div class="layui-input-inline link" style="">-</div>
			<div class="layui-input-inline">
				<input class="layui-input" name='end' placeholder="截止日" id="date_end">
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
				<th>订单类型</th>
				<th>费用</th>
				<th>订单状态</th>
				<th>下单时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		@if(empty($serve))
		<tr><td>暂无服务订单</td></tr>
		@endif
		@foreach($serve as $server)
			<tr>
				<td>{{$server -> servenum}}</td>
				<td>
					@if($server -> type == 0)
					咨询服务
					@endif
					@if($server -> type == 1)
					资料下载
					@endif
				</td>
				<td>￥{{$server -> price}}</td>
				<td>@if($server -> state == 0)
				未付款
				@elseif($server -> state == 1)
				已付款
				@endif
				</td>
				<td>{{date("Y-m-d H:i:s",$server -> servetime)}}</td>
				<td>
				@if($server -> state == 0)
					<a href="{{ url('/order/serveqr')}}/{{$server -> id}}">去付款</a> |
				@endif
					<a href="javascript:void(0);" filterID='10' class="delBtn" id="{{ $server -> id}}">删除</a> |
					<a href="{{ url('/order/servexq')}}/{{$server -> id}}" target="_blank">查看</a>
				</td>
			</tr>
		@endforeach	
		</tbody>
	</table>
	<div class="page" >
				{!!$serve -> links() !!}
			</div>

</div>
</div>
<script type="text/javascript" src="{{ url('/home/js/filterDate.js') }}"></script>
<script type="text/javascript">
	

	layui.use('form',function(){
		var form = layui.form();
		form.render();
	});

	$('.delBtn').on('click', function() {
		var delTr = $(this).parents('tr');
		// alert(delTr);
		var id = $(this).attr('id');
		layer.confirm('删除操作不可撤销！<br />同时会删除分类下面的病历！', {
			btn: ['删除','算了']
		},function(){//确认
			$.ajax({
				url : '/order/deleteser',
				data : {'id':id},
				type : 'post',
				success : function(data){
					
					if (data.status == 1) {
						delTr.remove();
						layer.msg(data.msg);
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