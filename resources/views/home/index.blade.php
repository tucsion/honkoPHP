 @extends('home.layout')
 @section('banner')
 <link rel="stylesheet" type="text/css" href="{{ url('/home/css/vmc.slider.css') }}" />
 <link rel="stylesheet" type="text/css" href="{{ url('/home/css/index.css') }}">
 <script type="text/javascript" src="{{ url('/home/js/jquery.waypoints.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/home/js/jquery.countup.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/home/js/vmc.slider.full.min.js') }}"></script> 
	<script type="text/javascript" src="{{ url('/home/layui/layui.js') }}"></script>
	
	<!-- Banner -->
	<div id="banner">
		<div id="slider">
			<a href="#"><img src="{{ url('/home/images/banner2.jpg') }}"></a>
			<a href="#"><img src="{{ url('/home/images/banner3.jpg') }}"></a>
			<a href="#"><img src="{{ url('/home/images/banner4.jpg') }}"></a>
			<a href="#"><img src="{{ url('/home/images/banner5.jpg') }}"></a>
		</div>
	</div>
@if(session('utp'))
<script type="text/javascript">
		alert('请以患者身份登录购买');
</script>
@endif
	<!-- 首页患者数量 -->
	<div id="num">
		<div class="bg"></div>
		<div class="num">
			<p><span class="red">本平台已连续帮助<span class="big counter">{{ number_format($set -> number)}}</span>例</span><span class="black">患者实现康复</span></p>
		</div>
	</div>

	<!-- 3个按钮 -->
	<ul id="btn3">
		<li class="btn31"><a href="/expert/index">搜索医生</a></li>
		<li class="btn32"><a href="/hickey/index">搜索器械</a></li>
		<li class="btn33"><a href="{{ url('/train/index') }}/{{$jiaoyu -> id}}">病情自查</a></li>
	</ul>

	<!-- 三个盒子 -->
	<ul id="box3">
		<li>
			<div class="img">
				<img src="{{ url('/home/images/box31.jpg') }}" alt="">
				<div class="bg"></div>
				<ul class="sub">
					<li><a href="{{ url('/train/index') }}/{{$jiaoyu -> id}}">教育与培训</a></li>
					<li><a href="{{ url('/info/index') }}/{{$huiyi -> id}}">康复咨讯</a></li>
					<li><a href="{{ url('/expert/index')}}">专家团队</a></li>
					<li><a href="{{ url('/procure/index') }}/{{$qiye -> id}}">合作机构</a></li>
				</ul>
			</div>
			<div class="title">
				<a href="{{ url('/info/index') }}/{{$huiyi -> id}}">康复服务</a>
			</div>
		</li>
		<li>
			<div class="img">
				<img src="{{ url('/home/images/box32.jpg')}}" alt="">
				<div class="bg"></div>
				<ul class="sub">
					@foreach($ys as $data)
						<li><a href="{{ url('/health/index') }}/{{$data -> id}}">{{ $data -> cate }}</a></li>
					@endforeach	
					
				</ul>
			</div>
			<div class="title">
				<a href="{{ url('/health/index') }}/{{$yangsheng -> id}}">养生养老</a>
				<div class="bg"></div>
			</div>
		</li>
		<li>
			<div class="img">
				<img src="{{ url('/home/images/box33.jpg')}}" alt="">
				<div class="bg"></div>
				<ul class="sub">
					@foreach($hickey as $hi)
						<li><a href="{{ url('/hickey/qxlist')}}/{{$hi -> id}}">{{ $hi -> cate }}
						</a></li>
					@endforeach
				</ul>
			</div>
			<div class="title">
				<a href="{{ url('/hickey/index') }}">医疗器械</a>
			</div>
		</li>
	</ul>

	<!-- 关于鸿康 -->
	<div id="about">
		<div class="about">
			<p class="title">
				关于鸿康康复中心
			</p>
			<p class="content" >
				{{$set -> intro}}
			</p>
			<a href="" class="layui-btn">
				查看更多&nbsp;&nbsp;&nbsp;&nbsp;<i class="layui-icon">&#xe623;</i>
			</a>
		</div>
	</div>

	


	
	<!-- banner -->
	
	<script type="text/javascript">
		// banner
		$(function() {
			$('#slider').vmcSlider({
				width: 'auto',
				height: 480,
				gridCol: 10,
				gridRow: 5,
				gridVertical: 20,
				gridHorizontal: 10,
				autoPlay: true,
				ascending: true,
				effects: [
					'fade', 'fadeLeft', 'fadeRight', 'fadeTop', 'fadeBottom', 'fadeTopLeft', 'fadeBottomRight',
					'blindsLeft', 'blindsRight', 'blindsTop', 'blindsBottom', 'blindsTopLeft', 'blindsBottomRight',
					'curtainLeft', 'curtainRight', 'interlaceLeft', 'interlaceRight', 'mosaic', 'bomb', 'fumes'
				],
				ie6Tidy: false,
				random: false,
				duration: 3000,
				speed: 1000
			});

			var btn = $('.vui-button').length;
			$('.vui-buttons').css('margin-left', '-'+btn*16+'px');
		});
	</script>

	<!-- 数字滚动 -->
	
	<script type="text/javascript">
		$('.counter').countUp();
	</script>

@endsection