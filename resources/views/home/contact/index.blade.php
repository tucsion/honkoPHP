 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='康复社-联系我们';
</script>
<link rel="stylesheet" href="{{ url('/home/css/article.css') }}">
<link rel="stylesheet" href="{{ url('/home/css/list.css') }}">
<link rel="stylesheet" href="{{ url('/home/css/article_detail.css') }}">
<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
	
	
	<!-- banner -->
	<div id="banner" style="background: url('{{url('/updates/')}}/{{$banner -> img}}') center center no-repeat;"></div>
	<div id="list" class="container">
		<!-- 左边栏 -->
		<div id="left">
			<dl>
				<dt>联系我们</dt>
				@foreach($lianxi as $lianx)
				<dd 	
				@if($id == $lianx -> id)
				class="active"
				@endif>
					<i class="layui-icon transition">&#xe602;</i>
					<a class="transition" href="{{ url('/contact/index') }}/{{$lianx -> id}}">{{$lianx -> cate}}</a>
				</dd>
				@endforeach
			</dl>
		</div>
		
		<!-- 列表 -->
		<div id="right">
			<!-- 位置导航 -->
			<div class="location">
				<span class="title">
					<i class="layui-icon">&#xe602;</i>{{$fenlei -> cate}}
				</span>
				<span class="layui-breadcrumb">
					<a href="{{ url('http://hkyl.com')}}">首页</a>
					<a href="#">联系我们</a>
					<a ><cite>{{$fenlei -> cate}}</cite></a>
				</span>
			</div>
			<!-- 文章列表 -->
			@if(empty($lian))
			<ul class="list">
				<div class="content">
					<div class="content">
						<form>
								<div style="text-align:center;">姓名:<input></input></div>
								<div style="text-align:center;">电话:<input></input></div>
								<div style="text-align:center;">邮箱:<input></input></div>
								<div style="text-align:center;">留言:<input></input></div>
								<button style="width:100px;margin:0 auto;display:block;">提交</button>
						</form>
					</div>
				</div>
			@elseif($lian -> cid == 66)
			<div class="content">
					<div class="content">
						<img src="{{url('updates')}}/QQ图片20170116120849.png">
						<img src="{{url('updates')}}/{{$lian -> img}}" style="width:1000px;height:500px;">
						
					</div>
				</div>
			@elseif($lian -> cid == 65)
			<div class="content">
					<div class="content">
						{!! $lian -> news !!}
						
					</div>
				</div>
			@elseif($lian -> cid == 64)
			<div class="content">
					<div class="content">
						<img src="{{url('updates')}}/{{$lian -> img}}" style="width:1000px;height:500px;">
						
					</div>
				</div>
			@elseif($lian -> cid == 63)
			<div class="content">
					<div class="content">
						<img src="{{url('updates')}}/{{$lian -> img}}" style="width:600px;height:400px;">
						{!! $lian -> news !!}
					</div>
				</div>
			@elseif($lian ->cid == 62)
			<div class="content">
					<div class="content">
						
						{!! $lian -> news !!}
						<img src="{{url('updates')}}/{{$lian -> img}}" style="width:800px;height:180px;">
					</div>
				</div>
			@elseif($lian -> cid == 68)
			<div class="content">
					<div class="content">
						
						{!! $lian -> news !!}
						
					</div>
				</div>
			</ul>
			@endif
			<!-- 分页 -->
			
		</div>
	</div>

@endsection