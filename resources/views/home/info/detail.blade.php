 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='{{$detail -> name}}-康复资讯';
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
				@if($detail-> cid  == $zixun -> id)
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
			<!-- 文章详情 -->
			<div id="content">
				<div class="content">
					<h3 class="title">{{$detail -> name}}</h3>
					<p class="tags">
						<span>发布者：{{$detail -> author}}</span>
						<span>浏览次数：{{$detail -> visitnum}} 次</span>
						<span>发布时间：{{date("Y-m-d H:i:s",$detail -> addtime)}}</span>
					</p>
					<div class="content">
						{!! $detail -> news !!}
						
					</div>
				</div>

				<div class="tools">
					<hr>
					<span class="prev">上一篇：<em>@if(empty($shang))
					<a href="#">
					暂无内容
					@elseif(!empty($shang))
					<a href="{{ url('/train/detail')}}/{{$shang -> id }}">
					{{$shang -> name}}
					@endif
					</a></em></span>
					<span class="next">下一篇：<em>@if(empty($xia))
					<a href="#">
					暂无内容
					@elseif(!empty($xia))
					<a href="{{ url('/train/detail')}}/{{$xia -> id }}">
					{{$xia -> name}}
					@endif
					</a></em></span>
					<span class="share">
						<div class="bdsharebuttonbox">
							<a href="#" class="bds_more" data-cmd="more"></a>
							<a href="#" class="bds_qzone" data-cmd="qzone"></a>
							<a href="#" class="bds_tsina" data-cmd="tsina"></a>
							<a href="#" class="bds_tqq" data-cmd="tqq"></a>
							<a href="#" class="bds_renren" data-cmd="renren"></a>
							<a href="#" class="bds_weixin" data-cmd="weixin"></a>
						</div>
					</span>
				</div>
			</div>
		</div>
	</div>
	
@endsection


	<!-- 百度分享 -->
	<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
