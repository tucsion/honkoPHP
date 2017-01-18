<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>选择人物</title>
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
	<h3>请选择人物</h3>
	<table class="layui-table" lay-even lay-skin="line">
		<thead>
			<tr>
				<th>姓名</th>
				<th>病历数</th>
				<th>住院时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<tr>
			@foreach($man as $user)
				<td>{{ $user -> cname}}</td>
				<td>{{ $user -> cbir }}</td>
				<td>{{ $user -> intime }}</td>
				<td><button class="layui-btn layui-btn-small layui-btn-warm selectBtn" characterId="{{$user -> id }}" characterName="{{ $user -> cname }}" characterCbir="{{ $user -> cbir }}" characterCsex="{{ $user -> csex }}" characterState="{{ $user -> state }}" characterNation="{{ $user -> nation }}" characterJob="{{ $user -> job }}" characterCaddress="{{ $user -> caddress }}" characterIntime="{{ $user -> intime }}">选择</button></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
	<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
	<script type="text/javascript">
		var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
		//给父页面传值
		$('.selectBtn').on('click', function(){
			var cid = $(this).attr('characterId');
			var cname = $(this).attr('characterName');
			var cbir = $(this).attr('characterCbir');
			var csex = $(this).attr('characterCsex');
			var state = $(this).attr('characterState');
			var nation = $(this).attr('characterNation');
			var job = $(this).attr('characterJob');
			var caddress = $(this).attr('characterCaddress');
			var intime = $(this).attr('characterIntime');
		    parent.$('#character_id').val(cid);
		    parent.$('#character_name').val(cname);
		    parent.$('#character_cbir').val(cbir);
		    if (csex == '男') {
		    	parent.$('#male').trigger('click');
		    }else{
		    	parent.$('#female').trigger('click');
		    }
		    if(state == '未婚'){
		    	parent.$('#weihun').trigger('click');
		    }else{
		    	parent.$('#yihun').trigger('click');
		    }
		    parent.$('#national').val(nation);
		    parent.$('#character_job').val(job);
		    parent.$('#character_caddress').val(caddress);
		    parent.$('#character_intime').val(intime);
		    parent.layer.close(index);
		});
	</script>

</body>
</html>