@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-未完成采购单';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
<div class="headTitle">未完成采购单</div>
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

		@if(empty($count))
			<tr>
			<td>暂无采购订单</td>
			</tr>
		@endif
		@foreach($purch as $pur)
			<tr>
			
				<td>
					{{$pur -> hname}}
					<img src="{{url('/updates')}}/{{$pur -> img}}" style="width:150px;height:150px;">
				</td>
				<td>{{date("Y-m-d H:i:s",$pur -> purtime)}}</td>
				<td>{{$pur -> number}}</td>
				<td>
					<a href="javascript:void(0);" filterID='10' class="delBtn" id="{{ $pur -> id}}">删除</a> |
					<a href="{{ url('/hickey/detail')}}/{{$pur -> gid}}" target="_blank">查看</a>
				</td>
			</tr>
		@endforeach	
		</tbody>
	</table>
	<div style="text-align: right;">
			<a href="{{ url('/hickey/index')}}" >继续采购</a> ||
			@if($count)
			<a href="{{ url('/purch/add')}}" >生成采购单</a>
			@endif
	</div>
	<div class="page" >
			{!!$purch -> links() !!}
	</div>

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
		layer.confirm('删除操作不可撤销！<br />同时会删除分类下面的病历！', {
			btn: ['删除','算了']
		},function(){//确认
			$.ajax({
				url : '/purch/delete',
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