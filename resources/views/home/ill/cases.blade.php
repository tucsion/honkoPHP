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
@if(session('bltj'))
<script type="text/javascript">
		alert('病例添加成功');
</script>
@endif
@if(session('namepd'))
<script type="text/javascript">
		alert('人物信息已存在');
</script>
@endif
@if(session('illadd'))
<script type="text/javascript">
		alert('病例信息添加成功');
</script>
@endif
@if(session('caseedit'))
<script type="text/javascript">
		alert('病例信息修改成功');
</script>
@endif

<div class="headTitle">病历管理</div>
<div class="medical_records">
	<table class="layui-table" lay-even lay-skin="line">
		<tr>
			<button class="layui-btn layui-btn-normal addBtn">
				<i class="layui-icon">&#xe608;</i> 新增病历
			</button>
		</tr>
		<thead>
			<tr>
				<th>编号</th>
				<th>人物</th>
				<th>病历名称</th>
				<th>摘要</th>
				<th>提交时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		@foreach($bl as $bingli)
			<tr>
				<td>{{ $bingli -> id }}</td>
				<td>{{ $bingli -> cname }}</td>
				<td>{{ $bingli -> dname }}</td>
				<td>{{str_limit($bingli -> explain,$limit = 20)}}</td>
				<td>{{date("Y-m-d",$bingli -> addtime)}}</td>
				<td>
					<a href="javascript:void(0);" filterID='10' class="delBtn" id="{{ $bingli -> id}}">删除</a> |
					<a href="javascript:void(0);" filterID='10' class="showBtn" id="{{ $bingli -> id}}">查看</a> |
					<a href="javascript:void(0);" filterID='10' class="editBtn" id="{{ $bingli -> id}}">修改</a>	
				
			</button>
				</td>
			</tr>
		@endforeach
		</tbody>
		
	</table>
	<div class="page" >
				{!! $bl->links() !!}
			</div>	
</div>
</div>

<script type="text/javascript">
	$('.addBtn').on('click', function() {
		//弹出即全屏
		var index = layer.open({
			type: 2,
			title : '新增病历',
			content: '/ill/caseadd',
			area: ['320px', '640px'],
			maxmin: false,
			scrollbar:true
		});
		layer.full(index);
	});
	//查看病例信息
	$('.showBtn').on('click', function() {
		var id = $(this).attr('id');
		$.post('/ill/casexq', {'id':id}, function(str){
		  layer.open({
		  	type: 1,
		  	title : '查看病历信息',
		  	shade : [0.3,'#000'],
		  	shadeClose : false,
		  	scrollbar : false,
		  	area: ['700px', '500px'],
		  	content: str, //注意，如果str是object，那么需要字符拼接
		  	btn:['关闭'],
		    
		  });
		});
	});
	//病例编辑
	$('.editBtn').on('click', function() {
		var id = $(this).attr('id');

		var index = layer.open({
			type: 2,
			title : '修改病历',
			content: '/ill/caseedit/'+id,
			area: ['320px', '640px'],
			maxmin: false,
			scrollbar:true
		});
		layer.full(index);
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
				url : '/ill/casedel',
				data : {'id':id},
				type : 'post',
				success : function(data){
					
					if (data.status == 1) {
						delTr.remove();
						layer.msg(data.msg);
						window.location.href="/ill/cases"; 
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

