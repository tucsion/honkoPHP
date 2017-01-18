<div class="character_show">
	<table class="layui-table" lay-skin="line" lay-even="">
		<tr>
			<th>姓名</th>
			<td>{{$user -> cname}}</td>
		</tr>
		<tr>
			<th>出生年月</th>
			<td>{{$user -> cbir}}</td>
		</tr>
		<tr>
			<th>性别</th>
			<td>{{$user -> csex}}</td>
		</tr>
		<tr>
			<th>婚姻状况</th>
			<td>{{$user -> state}}</td>
		</tr>
		<tr>
			<th>民族</th>
			<td>
			<div class="layui-input-inline">
				<select name="nation" id="national" disabled="disabled" >
					<option>请选择民族</option>
				</select>
			</div>
		</td>
		</tr>
		<tr>
			<th>职业</th>
			<td>{{$user -> job}}</td>
		</tr>
		<tr>
			<th>现住址</th>
			<td>{{$user -> province}} {{$user -> city}} {{$user -> county}}</td>
		</tr>
		<tr>
			<th>详细地址</th>
			<td>{{$user -> caddress}}</td>
		</tr>
		<tr>
			<th>住院时间</th>
			<td>{{$user -> intime}}</td>
		</tr>
		<tr>
			<th>病例名称</th>
			<td>{{$case -> dname}}</td>
		</tr>
		<tr>
			<th>病例类型</th>
			<td>{{$keshi -> name}}</td>
		</tr>
	</table>
</div>
<script type="text/javascript" src="{{ url('/home/js/national.js') }}"></script>
<script type="text/javascript">
	layui.use(['laydate','form'],function(){
		var laydate = layui.ladate,form = layui.form();
		$('#national').val({{$user -> nation}});
		form.render();//刷新layui
	});

</script>