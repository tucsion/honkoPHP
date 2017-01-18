 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='康复社-企业采购';
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
				<dt>企业采购</dt>
				@foreach($procure as $caigou)
				<dd 	
				@if($id == $caigou -> id)
				class="active"
				@endif>
					<i class="layui-icon transition">&#xe602;</i>
					<a class="transition" href="{{ url('/procure/index') }}/{{ $caigou -> id }}">{{$caigou -> cate}}</a>
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
					<a href="#">企业采购</a>
					<a><cite>{{$fenlei -> cate}}</cite></a>
				</span>
			</div>
			<!-- 文章列表 -->
			@if(empty($wz))
			<ul class="list">
				<li class="h">
					<i class="layui-icon">&#xe623;</i>暂无此类别的文章</a>
				</li>
			@elseif($wz -> cid == 15)
			<div class="content">
					<div class="content">
						{!! $wz -> news !!}
						
					</div>
				</div>
			@elseif($wz -> cid == 56)
			
			<ul class="list">
				@foreach($wzhang as $wenzang)
				<li class="h">
					<img 
					@if(empty($wenzang -> img))
					 src="{{ url('/home/images/article_h.jpg') }}"
					@elseif(!empty($wz -> img))
					src ="{{ url('/updates')}}/{{$wenzang -> img}}"
					@endif
					alt="文章名称">
					<div class="content">
						<p class="title">
							<a href="{{ url('/procure/detail')}}/{{$wenzang -> id }}">{{$wenzang -> name }}</a>
						</p>
						<p class="time">{{date("Y-m-d",$wenzang -> addtime)}}</p>
						<p class="description">
							{{str_limit($wenzang ->depict,$limit = 200)}}
						</p>
					</div>
				</li>
				@endforeach
			</ul>
			@endif
			<!-- 分页 -->
			
		</div>
	</div>

@endsection