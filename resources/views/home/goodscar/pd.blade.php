<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>选择发票信息</title>
	<link rel="stylesheet" href="{{ url('/home/layui/css/layui.css')}}">
	<style type="text/css">
		h3,td,th{
			text-align: center !important;
		}
		h3{
			font-size: 20px;
			color: #222;
			padding: 20px 0 10px 0;
		}
	</style>
</head>
<body>
	<h3>请选择发票信息</h3>
	<table class="layui-table" lay-even lay-skin="line">
		<thead>
			<tr>
				<th>收货人</th>
				<th>地址</th>
				<th>联系电话</th>
				<th>发票抬头</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<tr>
			@foreach($bill as $fp)
				<td>{{ $fp -> receiver}}</td>
				<td>{{ $fp -> address }}</td>
				<td>{{ $fp -> phone }}</td>
				<td>{{ $fp -> depict}} </td>
				<td><button class="layui-btn layui-btn-small layui-btn-warm selectBtn" characterId="{{$fp -> id }}" characterDepict="{{ $fp -> depict }}" characterBilltype="{{ $fp -> billtype }}" characterBillitem="{{ $fp -> billitem }}" >选择</button></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
	<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
	<script type="text/javascript">
		var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
		//给父页面传值
		$('.selectBtn').on('click', function(){
			var bid = $(this).attr('characterId');
			var depict = $(this).attr('characterDepict');
			var billtype = $(this).attr('characterBilltype');
			var billitem = $(this).attr('characterBillitem');

			parent.$('.fapiaoList').find('.fapiao_info_1').text(depict);
			parent.$('.fapiaoList').find('.fapiao_info_2').text(billtype);
			parent.$('.fapiaoList').find('.fapiao_info_3').text(billitem);
			parent.$('.fapiaoList').find('input').val(bid);
		    
		    parent.layer.closeAll();
		});
	</script>

</body>
</html>