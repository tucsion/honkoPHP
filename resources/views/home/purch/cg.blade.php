@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-历史采购单';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
@if(session('cg'))
<script type="text/javascript">
		alert('采购单创建成功');
</script>
@endif
	


<div class="headTitle">历史采购单</div>
<div class="order">
	<form action="/order/sx" class="layui-form" method="post">
	{{ csrf_field() }}
		
	</form>
	<table id="order" class="layui-table" lay-skin="line">
		<thead>
			<tr>
				<th>采购单号</th>
				<th>生成时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		@if(empty($count))
		<tr><td>暂无采购订单</td></tr>
		@endif

		@foreach($purch as $pur)
			<tr>
				<td>{{$pur  -> cgnum}}</td>
				<td>{{date("Y-m-d H:i:s",$pur -> cgtime)}}</td>
				<td>
					<a href="javascript:void(0);" filterID='10' class="delBtn" id="{{ $pur -> id}}">删除</a> |
					<a href="{{ url('/purch/cgxq')}}/{{$pur -> id}}" target="_blank">查看</a>
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


<script type="text/javascript">
	
	$('.delBtn').on('click', function() {
		var delTr = $(this).parents('tr');
		// alert(delTr);
		var id = $(this).attr('id');
		layer.confirm('删除操作不可撤销！', {
			btn: ['删除','算了']
		},function(){//确认
			$.ajax({
				url : '/purch/del',
				data : {'id':id},
				type : 'post',
				success : function(data){
					
					if (data.status == 1) {
						delTr.remove();
						layer.msg(data.msg);
						window.location.href="/purch/cg"; 
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