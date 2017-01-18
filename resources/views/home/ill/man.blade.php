@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-人物列表';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
	<!-- 内容区域 -->
@if(session('illedit'))
<script type="text/javascript">
		alert('人物信息修改成功');
</script>
@endif
@if(session('pd'))
<script type="text/javascript">
		alert('人物信息已存在');
</script>
@endif
@if(session('illadd'))
<script type="text/javascript">
		alert('人物信息添加成功');
</script>
@endif

<div class="headTitle">人物管理</div>
<div class="character">
	<table class="layui-table" lay-even lay-skin="line">
		<tr>
			<button class="layui-btn layui-btn-normal addBtn">
				<i class="layui-icon">&#xe608;</i> 添加人物
			</button>
		</tr>
		<thead>
			<tr>
				<th>姓名</th>
				<th>病历数</th>
				<th>住院时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		@if(!empty($user))
		@foreach($user as $man)
			<tr>
				<td>{{$man -> cname}}</td>
				<td>{{$man -> num }}</td>
				<td>{{$man -> intime}}</td>
				<td>
					<a href="javascript:void(0);" filterID='10' class="delBtn" id="{{ $man -> id}}">删除</a> |
					<a href="javascript:void(0);" filterID='10' class="editBtn" id="{{ $man -> id}}">修改</a> |
					<a href="javascript:void(0);" filterID='10' class="showBtn" id="{{ $man -> id}}">查看</a>
				</td>
			</tr>
		@endforeach	
		@else
			<tr>
				<td colspan="4">
					暂时没有数据
				</td> 
			</tr>
		@endif
		</tbody>

	</table>
			<div class="page" >
				{!! $user->links() !!}
			</div>	
			
</div>
<script type="text/javascript">
	//人物编辑
	$('.editBtn').on('click', function() {
		var id = $(this).attr('id');
		$.post('/ill/edit', {'id':id}, function(str){
		  layer.open({
		  	type: 1,
		  	title : '编辑人物',
		  	shade : [0.3,'#000'],
		  	shadeClose : false,
		  	scrollbar : false,
		  	area: ['893px', '500px'],
		    content: str, //注意，如果str是object，那么需要字符拼接
		  });
		});
	});
	
	//删除
	$('.delBtn').on('click', function() {
		var delTr = $(this).parents('tr');
		// alert(delTr);
		var id = $(this).attr('id');
		layer.confirm('删除操作不可撤销！<br />同时会删除分类下面的病历！', {
			btn: ['删除','算了']
		},function(){//确认
			// $.post('/ill/delete', {'id':id},function(){
			// 	success : function(){
			// 		alert();
			// 	}
			// });

			$.ajax({
				url : '/ill/delete',
				data : {'id':id},
				type : 'post',
				success : function(data){
					
					if (data.status == 1) {
						delTr.remove();
						layer.msg(data.msg);
						window.location.href="/ill/man"; 
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

	// 新增人物
	$('.addBtn').on('click', function() {
		$.get('/ill/add', {}, function(str){
		  layer.open({
		  	type: 1,
		  	title : '新增人物',
		  	shade : [0.3,'#000'],
		  	shadeClose : false,
		  	scrollbar : false,
		  	area: ['893px', '500px'],
		    content: str, //注意，如果str是object，那么需要字符拼接
		  });
		});
	});

	//查看人物信息
	$('.showBtn').on('click', function() {
		var id = $(this).attr('id');
		$.post('/ill/detail', {'id':id}, function(str){
		  layer.open({
		  	type: 1,
		  	title : '查看人物信息',
		  	shade : [0.3,'#000'],
		  	shadeClose : false,
		  	scrollbar : false,
		  	area: ['700px', '500px'],
		  	content: str, //注意，如果str是object，那么需要字符拼接
		  	btn:['修改','关闭'],
		    yes : function(index){
		    	layer.close(index);
		    	$.post('/ill/edit', {'id':id}, function(str){
		    	  layer.open({
		    	  	type: 1,
		    	  	title : '编辑人物',
		    	  	shade : [0.3,'#000'],
		    	  	shadeClose : false,
		    	  	scrollbar : false,
		    	  	area: ['893px', '500px'],
		    	    content: str, //注意，如果str是object，那么需要字符拼接
		    	  });
		    	});
		    }
		  });
		});
	});
</script>
</div>
@endsection