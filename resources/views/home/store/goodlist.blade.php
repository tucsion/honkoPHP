 @extends('home.layout')
 @section('banner')
 <script type="text/javascript">
    document.title='康复社-康复器械园';
</script>

	<link rel="stylesheet" href="{{ url('/home/css/shop_index.css') }}">
	<!-- 位置导航 -->
	<div class="location container">
		<span class="layui-breadcrumb">
			<a href="{{ url('http://hkyl.com')}}">首页</a>
			<a href="{{ url('http://hkyl.com/store/index') }}">分类</a>
			<a><cite>当前分类</cite></a>
		</span>
	</div>

	<!-- 正文内容 -->
	<div id="main" class="container">
		<!-- 商品列表 -->
		<div id="left">
			<!-- 筛选 -->
			<div id="filter">
				<dl>
					<dt>分类：</dt>
					<dd><a href="{{ url('/store/goodlist') }}/sort=0" 
					@if($sort == 0)
					class="active"
					@endif>全部</a></dd>
					@foreach($goods as $good)
					<dd><a href="{{ url('/store/goodlist') }}/sort={{ $good -> id }}"
					@if($sort == $good -> id)
					class="active"
					@endif>{{ $good -> cate }}</a></dd>
					@endforeach
				</dl>
				<dl>
					<dt>适用范围：</dt>
					<dd><a href="{{ url('/store/goodlist') }}/range=0" 
					@if($range == 0)

					class="active"
					@endif>全部</a></dd>
					@foreach($scope as $fw)
					<dd><a href="{{ url('/store/goodlist') }}/range={{ $fw -> id }}"
					@if($range == $fw -> id)
					 class="active"
					 @endif>{{ $fw -> name }}</a></dd>
					@endforeach
				</dl>
				
			</div>
			<div class="tools">
				<ul class="layui-nav" lay-filter="">
					<li class="layui-nav-item">商品排序：</li>
					<li class="layui-nav-item">
						<a href="javascript:;">按销量</a>
						<dl class="layui-nav-child">
							<dd><a href="{{ url('/store/goodlist') }}/xl=1">销量从高到低</a></dd>
						</dl>
					</li>
					<li class="layui-nav-item">
						<a href="javascript:;">按价格</a>
						<dl class="layui-nav-child">
							<dd><a href="{{ url('/store/goodlist') }}/jg=1">价格从低到高</a></dd>
							<dd><a href="{{ url('/store/goodlist') }}/jg=2">价格从高到低</a></dd>
						</dl>
					</li>
				</ul>
			</div>

			<!-- 商品列表 -->
			<div id="list">
				<ul>
				@foreach ($res as $god)
					<li>
						<a class="img" href="">
							<img src="{{ url('/updates')}}/{{ $god -> img }}" alt="商品名称">
						</a>
						<div class="price">
							<span class="left">￥ {{ $god -> price }}</span>
							<span class="right">{{ $god -> salenum }}次浏览</span>
						</div>
						<p class="title">
							<a class="title" href="#">{{$god -> gname}}</a>
						</p>
					</li>
				@endforeach	
				</ul>


			</div>
			<!-- 分页 -->
			<div class="page">
				{!! $res->links() !!}
			</div>
			
		</div>
		<!-- 右边栏 -->
		<div id="right">
			<!-- 销量排行 -->
			<div id="box">
				<div class="headTop">销量排行</div>
				<ul class="sales">
				@foreach ($rank as $px)
					<li 
					@if($i == 1)
					class="active"
					@endif>
						<div class="top">
							<i class="index">{{$i++}}</i>
							<a href="#" class="title">{{$px -> gname}}</a>
							<i class="num">销量：<span>{{$px -> salenum}}</span></i>
						</div>
						<div class="info">
							<p>
								<a href="#">
									<img src="{{ url('/updates')}}/{{ $px -> img }}" alt="商品名称">
								</a>
							</p>
							<p class="tags">
								商城价：<span>￥{{$px -> price}}</span>
								销量：<span>{{$px -> salenum}}</span>
							</p>
						</div>
					</li>
				
				
				@endforeach
				</ul>
			</div>
			<!-- 用户评价 -->
			
			<div id="box">
				<div class="headTop">浏览历史</div>
				<ul class="history">
					<li>
						<a href="#" class="img"><img class="transition" src="images/product_thumbnail.jpg" alt="商品名称"></a>
						<p class="title">
							<a href="#">商品名称商品名称商品名称商品名称</a>
						</p>
						<p class="price">￥8,000.00</p>
					</li>
					<li>
						<a href="#" class="img"><img class="transition" src="images/product_thumbnail.jpg" alt="商品名称"></a>
						<p class="title">
							<a href="#">商品名称商品名称商品名称商品名称</a>
						</p>
						<p class="price">￥8,000.00</p>
					</li>
					<li>
						<a href="#" class="img"><img class="transition" src="images/product_thumbnail.jpg" alt="商品名称"></a>
						<p class="title">
							<a href="#">商品名称商品名称商品名称商品名称</a>
						</p>
						<p class="price">￥8,000.00</p>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<!-- 脚部 -->

	
	<script src="{{ url('/home/layui/layui.js') }}"></script>
	<script type="text/javascript">
		layui.use('element');
	</script>
	<!-- 左边栏销量排行效果 -->
	<script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
	<script type="text/javascript">
		$('ul.sales li').mouseover(function() {
			$(this).addClass('active').siblings().removeClass();
		});
	</script>
@endsection