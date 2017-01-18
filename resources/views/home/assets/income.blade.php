@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-收入管理';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
<div class="headTitle">订单列表</div>
<div class="order">
		
		<div class="layui-form-item">
			<label class="layui-form-label">余额:￥{{$price}}</label>
			<div class="layui-input-inline">
				<a href="{{url('/assets/draw')}}"><i class="layui-icon">&#xe608;提现</i></a>
			</div>
		</div>
		
	<table id="order" class="layui-table" lay-skin="line">
	
		<thead>
			<tr>
				<th>订单编号</th>
				<th>下单时间</th>
				<th>交易额</th>
				<th>来源</th>
			</tr>
		</thead>
		<tbody>
		@foreach($income as $incomes)
			<tr>
				<td>{{$incomes -> servenum}}</td>
				<td>
					{{date('Y-m-d H:i:s',$incomes ->time) }}
				</td>
				<td>￥{{$incomes -> price}}</td>
				<td>@if($incomes -> type == 0)
				文章下载收入
				@elseif($incomes -> type == 1)
				咨询服务收入
				@endif
				</td>
			</tr>
		@endforeach	
		</tbody>
	</table>
	<div class="page" >
				{!!$income -> links() !!}
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