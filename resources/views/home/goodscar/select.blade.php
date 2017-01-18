<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>选择地址</title>
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
	<h3>请选择地址</h3>
	<table class="layui-table" lay-even lay-skin="line">
		<thead>
			<tr>
				<th>收货人</th>
				<th>地址</th>
				<th>详细地址</th>
				<th>联系电话</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<tr>
			@foreach($address as $dz)
				<td>{{ $dz -> uname}}</td>
				<td>{{ $dz -> province }}</td>
				<td>{{ $dz -> address }}</td>
				<td>{{ $dz -> utel}} </td>
				<td><button class="layui-btn layui-btn-small layui-btn-warm selectBtn" characterId="{{$dz -> id }}" characterName="{{ $dz -> uname }}" characterProveince="{{ $dz -> province }}" characterCity="{{ $dz -> city }}" characterCounty="{{ $dz -> county }}" characterAddress="{{ $dz -> address }}" characterUtel="{{ $dz -> utel }}" characterPostcode="{{ $dz -> postcode }}" >选择</button></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
	<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
	<script type="text/javascript">
		var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
		//给父页面传值
		$('.selectBtn').on('click', function(){
			var aid = $(this).attr('characterId');
			var uname = $(this).attr('characterName');
			var province = $(this).attr('characterProveince');
			var city = $(this).attr('characterCity');
			var county = $(this).attr('characterCounty');
			var address = $(this).attr('characterAddress');
			var utel = $(this).attr('characterUtel');
			var postcode = $(this).attr('characterPostcode');
		    parent.$('#character_id').val(aid);
		    parent.$('#character_uname').val(uname);
		    parent.$('#character_province').val(province);
		    parent.$('#character_city').val(city);
		    parent.$('#character_utel').val(utel);
		    parent.$('#character_postcode').val(postcode);
		    parent.$('#character_county').val(county);
		    parent.$('#character_address').val(address);
		    parent.layer.closeAll();
		});
	</script>

</body>
</html>