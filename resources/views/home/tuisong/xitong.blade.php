@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-系统推送';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
@if(session('blxq'))
	<script type="text/javascript">
		alert('该病例可能已被删除');
	</script>
@endif

<div class="headTitle">系统推送</div>
<div class="collection">
	<ul class="expert">
 
	@if(empty($ts))
	<li> 暂无数据</li>
	@endif
	
	@foreach($ts as $tuisong)

		<li class="transition">
			<a href="{{url('/home/tuisong/blxq')}}/{{$tuisong -> bid}}" class="img">
				<img src="{{ url('/updates')}}/{{$tuisong -> headurl}}" alt="病例名称">
			</a>
			<div class="info">
				<p class="name">
					<span>{{$tuisong -> cname}}</span>{{ $tuisong -> dname }}
				</p>
				<p class="keshi">
				@foreach($keshi as $k)	
				@if($tuisong -> type== $k -> id)
				{{ $k -> name}}&nbsp;
				@endif
				@endforeach
				</p>
				<p>	{{$tuisong -> explain}}</p>
			</div>
			<div class="tools transition">
				<button class="layui-btn layui-btn-mini layui-btn-primary delBtn" id='{{$tuisong -> id}}' title="删除">
					<i class="layui-icon">&#xe640;</i>
				</button>
				<button class="layui-btn layui-btn-mini layui-btn-primary gzBtn" id='{{$tuisong -> id}}' title="关注">
					<i class="layui-icon">&#xe64c;</i>
				</button>
				</a>
			</div>
		</li>
	@endforeach
	</ul>
	
</div>
</div>
<script type="text/javascript">
		$('.delBtn').on('click', function() {
		var delTr = $(this).parents('tr');
		// alert(delTr);
		var id = $(this).attr('id');
		layer.confirm('删除操作不可撤销!', {
			btn: ['删除','算了']
		},function(){//确认
			$.ajax({
				url : '/home/tuisong/delete',
				data : {'id':id},
				type : 'post',
				success : function(data){
					
					if (data.status == 1) {
						delTr.remove();
						layer.msg(data.msg);
						window.location.href="/home/tuisong/xitong"; 
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
<script type="text/javascript">
		$('.gzBtn').on('click', function() {
		// alert(delTr);
		var id = $(this).attr('id');
		layer.confirm('你确定要关注此病例么？', {
			btn: ['确定','算了']
		},function(){//确认
			$.ajax({
				url : '/home/tuisong/follow',
				data : {'id':id},
				type : 'post',
				success : function(data){
					if (data.status == 1) {
						layer.msg(data.msg);
						window.location.href="/home/tuisong/xitong"; 
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

