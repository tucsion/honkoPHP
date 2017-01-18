@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-提现订单';
</script>
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
@if(session('tx'))
<script type="text/javascript">
		alert('提现订单创建成功');
</script>
@endif


<div class="headTitle">提现订单</div>
	

<div class="pass">
<div class="layui-input-inline">账户余额:￥{{$price}}</div>
	
<div class="order">
	<table id="order" class="layui-table" lay-skin="line">
		<thead>
			<tr>
				<th>订单编号</th>
				<th>订单类型</th>
				<th>提现金额</th>
				<th>订单状态</th>
				<th>下单时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		@if(empty($count))
		<tr>
		<td>暂无提现订单</td>
		</tr>
		@endif
		@foreach($draw as $draws)
		
			<tr>
				<td>{{$draws -> drawnum}}</td>
				<td>
					提现服务
				</td>
				<td>￥{{$draws -> draw}}</td>
				<td>@if($draws -> state == 0)
				审核中
				@elseif($draws -> state == 1)
				审核完成
				@elseif($draws -> state == 2)
				交易完成
				@endif
				</td>
				<td>{{date("Y-m-d H:i:s",$draws -> time)}}</td>
				<td>
					<a href="javascript:void(0);" filterID='10' class="delBtn" id="{{ $draws -> id}}">取消提现</a>
				</td>
			</tr>
		@endforeach	
		</tbody>
	</table>
	<div class="page" >
				{!!$draw -> links() !!}
			</div>

</div>
</div>
</div>
<script type="text/javascript">
	
	$('.delBtn').on('click', function() {
		var delTr = $(this).parents('tr');
		// alert(delTr);
		var id = $(this).attr('id');
		layer.confirm('取消操作不可撤销！', {
			btn: ['取消','算了']
		},function(){//确认
			$.ajax({
				url : '/assets/delete',
				data : {'id':id},
				type : 'post',
				success : function(data){
					
					if (data.status == 1) {
						delTr.remove();
						layer.msg(data.msg);
						window.location.href="/assets/porder"; 
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

