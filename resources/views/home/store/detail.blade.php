 @extends('home.layout')
 @section('banner')
 <script type="text/javascript">
    document.title='康复社-康复器械园';
</script>

<link rel="stylesheet" href="{{ url('/home/css/shop_detail.css') }}">
<link rel="stylesheet" href="{{ url('/home/css/expert_detail.css') }}">
	<!-- 位置导航 -->
	<div class="location container">
		<span class="layui-breadcrumb">
			<a href="{{ url('http://hkyl.com')}}">首页</a>
			<a href="{{ url('http://hkyl.com/store/index') }}">分类</a>
			<a><cite>当前分类</cite></a>
		</span>
	</div>
@if(session('login'))
<script type="text/javascript">
		alert('您还没有登录');
</script>
@endif
@if(session('utp1'))
<script type="text/javascript">
		alert('请以患者身份登录收藏');
</script>
@endif
@if(session('goodsc'))
<script type="text/javascript">
		alert('收藏成功');
</script>
@endif
@if(session('goodscd'))
<script type="text/javascript">
		alert('收藏失败');
</script>
@endif
@if(session('sc'))
<script type="text/javascript">
		alert('已被收藏过');
</script>
@endif
	<!-- 正文内容 -->
	<div id="content" class="container">
		<!-- 商品信息 -->
		<div class="top">
			<!-- 相册 -->
			<div class="album">
				<div class="preview">
					<div id="vertical" class="bigImg">
						<img src="{{ url('/updates')}}/{{$xq -> img}}" width="286" height="286" alt="" id="midimg" />
						<div style="display:none;" id="winSelector"></div>
					</div><!--bigImg end-->	
					<div class="smallImg">
						<div class="scrollbutton smallImgUp disabled"></div>
						<div id="imageMenu">
							<ul>
								
								<li id="onlickImg"><img src="{{ url('/updates')}}/{{$xq -> img}}"  alt="{{$xq -> gname}}"/></li>
								<li><img src="images/demo/small/02.jpg"  alt="洋妞"/></li>
								
							</ul>
						</div>
						<div class="scrollbutton smallImgDown"></div>
					</div><!--smallImg end-->	
					<div id="bigView" style="display:none;"><img width="800" height="800" alt="" src="" /></div>
				</div>
			</div>
			<!-- 摘要 -->
			<div class="tags">
				<p class="title">{{$xq->gname}}</p>
				<hr>
				<div class="attrs">
					<p class="attr"><span>商城价：</span><span class="price">￥{{$xq -> price}}</span></p>                           
					<p class="attr"><span>原价：</span><del>￥12,000.00</del></p>
					<p class="attr"><span>品牌：</span>{{$xq -> brand}}</p>                   
					<p class="attr"><span>商品库存：</span>{{$xq -> stock }}</p>                                     
					<p class="attr"><span>浏览次数：</span>{{$gxq -> hits}}人次</p>                                     
					       
					<p class="attr"><span>毛重：</span>{{$xq -> weight}}</p> 
				</div> 
				<hr>   
				<form class="layui-form">
				 {{ csrf_field() }}
					<div class="layui-form-item">
						<label class="layui-form-label">数量：</label>
						<div class="layui-form-mid layui-word-aux">
							<i class="transition" id="downBtn">-</i>
						</div>
						<div class="layui-input-inline">
							<input type="text" name="number" id="number" required lay-verify="number" value="1" class="layui-input">
							<input type='hidden' name='gid' value="{{$xq -> id}}"></input>
						</div>
						<div class="layui-form-mid layui-word-aux">
							<i class="transition" id="upBtn">+</i>
						</div>
						<div class="layui-inline">
							<label class="shoucang">
								<a href="{{ url('/expert/goodsc')}}/{{$xq -> id}}"><i class="layui-icon">&#xe600;</i> 加入收藏</a>
							</label>
							<label class="shoucang">
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
							</label>
						</div>
					</div>
					
					<div class="layui-form-item">
						<div class="layui-input-block">
							<button class="layui-btn layui-btn-normal layui-btn-big" lay-submit lay-filter="formDemo1">加入购物车</button>
							<button class="layui-btn layui-btn-danger layui-btn-big" lay-submit lay-filter="formDemo2">立即购买</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- 商品详情 -->
		<div id="tabs">
			<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
				<ul class="layui-tab-title">
					<li class="layui-this">详细信息</li>
					<li>产品参数</li>
					<li>客户评价</li>
				</ul>
				<div class="layui-tab-content">
					<div class="layui-tab-item layui-show">
						{!! $xq -> news !!}
					</div>
					<div class="layui-tab-item">
						{!! $xq -> parameter !!}
					</div>
					<div class="layui-tab-item">
						<p class="num">
							<i class="layui-icon">&#xe63a;</i> 共有<span>{{$con}}</span>条网友评价
						</p>
						<ul class="evaluate">
						@foreach($pingjia as $pj)
							<li>
								<div class="face">
									<img src="{{ url('/updates')}}/{{$pj -> headurl}}" alt="">
									<span class="name">{{$pj -> uname}}</span>
								</div>
								<div class="content">
									<p class="title">
										<span class="time">{{date('Y-m-d H:i:s',$pj -> time)}}</span>
									</p>
									<p class="description">
										{{$pj -> content}}
									</p>

								</div>
								
							</li>
						@endforeach	
						
						</ul>
						<!-- 分页 -->
						<div class="page">
							<ul>
								
							</ul>
						</div>
					</div>
				</div>
			</div>      
		</div>
	</div>

	<!-- 脚部 -->

	
	<script src="{{ url('/home/layui/layui.js') }}"></script>
	<script type="text/javascript">
		layui.use('element');
	</script>

	<!-- 相册 -->
	<script src="{{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('/home/js/image.zoom.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('i#upBtn').on('click', function() {
				var num = parseInt($('#number').val());
				num++;
				$('#number').val(num);
			});
			$('i#downBtn').on('click', function() {
				var num = parseInt($('#number').val());
				num--;
				if (num <= 1) num = 1;
				$('#number').val(num);
			});
		});
		layui.use('form',function(){
			var form = layui.form();
			form.on('submit(formDemo1)', function(data){
				$.ajax({
			  	url : '/store/goodscar',
				async:false,
				type : 'post',
				dataType : 'json',
				data: data.field,
				success : function(res){
					if(res == 0)
					{
							alert('请先登录');
					}
					if(res == 1)
					{
							alert('购物车添加成功');
					}
					if(res == 2)
					{
						alert('购物车添加失败,请重试');
					}
					if(res == 3)
					{
						alert('请以患者身份登录购买');
					}
					}
				});
				 //阻止表单跳转。如果需要表单跳转，去掉这段即可。
				 return false;	
			});
			form.on('submit(formDemo2)', function(data){
				$.ajax({
			  	url : '/goodscar/buy',
				async:false,
				type : 'post',
				dataType : 'json',
				data: data.field,
				success : function(res){
					if(res == 0)
					{
						window.location.href = "{{url('/goodscar/car')}}";
					}
					if(res == 1)
					{
						alert('请先登录');
					}
					if(res == 2)
					{
						alert('请以患者身份登录购买');
					}
					if(res == 3)
					{
						alert('购买失败,请重试');
					}
				}
				});
				return false;
			});
		});
	</script>

	<!-- 百度分享 -->
	<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
@endsection