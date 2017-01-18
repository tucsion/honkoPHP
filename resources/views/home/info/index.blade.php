 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='康复社-康复资讯';
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
				<dt>康复资讯</dt>
				@foreach($health as $zixun)
				<dd 	
				@if($id == $zixun -> id)
				class="active"
				@endif>
					<i class="layui-icon transition">&#xe602;</i>
					<a class="transition" href="{{ url('/info/index') }}/{{ $zixun -> id }}">{{$zixun -> cate}}</a>
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
					<a href="{{ url('/info/index') }}/{{$huiyi -> id}}">康复资讯</a>
					<a><cite>{{$fenlei -> cate}}</cite></a>
				</span>
			</div>
			<!-- 文章列表 -->
			@if(empty($wzhang))
			<ul class="list">
				<li class="h">
					<i class="layui-icon">&#xe623;</i>暂无此类别的文章</a>
				</li>
			@elseif(!empty($wzhang))
			<ul class="list">
				<li class="h">
					<img 
					@if(empty($wzhang -> img))
					 src="{{ url('/home/images/article_h.jpg') }}"
					@elseif(!empty($wzhang -> img))
					src ="{{ url('/updates')}}/{{$wzhang -> img}}"
					@endif
					alt="文章名称">
					<div class="content">
						<p class="title">
							<a href="{{ url('/info/detail')}}/{{$wzhang -> id }}">{{$wzhang -> name }}</a>
						</p>
						<p class="time">{{date("Y-m-d",$wzhang -> addtime)}}</p>
						<p class="description">
							{{str_limit($wzhang ->depict,$limit = 200)}}
						</p>
					</div>
				</li>
				@foreach($wz as $wenzang)
				<li>
					<a href="{{ url('/info/detail')}}/{{$wenzang -> id }}"><i class="layui-icon">&#xe623;</i>{{$wenzang -> name}}</a>
					<span class="time">{{date("Y-m-d",$wenzang -> addtime)}}</span>
				</li>
				@endforeach
			</ul>
			@endif
			<!-- 分页 -->
			<div class="page">
				<ul>
					{!! $wz->links() !!}
				</ul>
			</div>
		</div>
	</div>

@endsection