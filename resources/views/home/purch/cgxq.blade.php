@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-采购单详情';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
@if(session('cgd'))
<script type="text/javascript">
		alert('采购单创建失败');
</script>
@endif
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
<div class="headTitle">采购单详情</div>
<div class="order">
	<table id="order" class="layui-table" lay-skin="line">
		<thead>
			<tr>
				<th>商品信息</th>
				<th>下单时间</th>
				<th>数量</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>

		@foreach($cgxq as $cg)
			<tr>
			
				<td>
					{{$cg -> hname}}
					<img src="{{url('/updates')}}/{{$cg -> img}}" style="width:150px;height:150px;">
				</td>
				<td>{{date("Y-m-d H:i:s",$purch -> cgtime)}}</td>
				<td>{{$cg -> number}}</td>
				<td>
					<a href="javascript:void(0);" filterID='10' class="delBtn" id="{{ $cg -> gid}}">收藏</a> |
					<a href="{{ url('/hickey/detail')}}/{{$cg -> gid}}" target="_blank">查看</a>
				</td>
			</tr>
		@endforeach	
		</tbody>
	</table>

</div>
</div>
<script type="text/javascript">
	
	layui.use('form',function(){
		var form = layui.form();
		form.render();
	});
	$('.delBtn').on('click', function() {
		var delTr = $(this).parents('tr');
		// alert(delTr);
		var id = $(this).attr('id');
		layer.confirm('您确定收藏该商品么？', {
			btn: ['收藏','算了']
		},function(){//确认
			$.ajax({
				url : '/purch/qysc',
				data : {'id':id},
				type : 'post',
				success : function(data){
					
					if (data.status == 1) {
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