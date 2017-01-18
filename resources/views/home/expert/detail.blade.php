 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='{{$user -> uname}}-康复社-专家列表';
</script> 
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<link rel="stylesheet" href="{{ url('/home/css/expert_detail.css') }}">
<!-- 内容开始 -->
@if(session('login'))
<script type="text/javascript">
		alert('您还没有登录');
</script>
@endif
@if(session('utp'))
<script type="text/javascript">
		alert('请已患者身份登录');
</script>
@endif
@if(session('wzsc'))
<script type="text/javascript">
		alert('收藏成功');
</script>
@endif
@if(session('sc'))
<script type="text/javascript">
		alert('已被收藏过');
</script>
@endif
@if(session('mess'))
<script type="text/javascript">
		alert('留言失败,请重试');
</script>
@endif
@if(session('message'))
<script type="text/javascript">
		alert('已成功留言');
</script>
@endif
@if(session('kong'))
<script type="text/javascript">
		alert('留言不能为空!');
</script>
@endif
	<!-- 专家信息 -->
	<div id="expert">
		<div class="container">
			<!-- 头像 -->
			<div class="face">
				<img @if(empty($user -> headurl))
				src ="{{ url('/updates')}}/20151130210650_85035.jpg"
				@else
				src ="{{ url('/updates')}}/{{$user -> headurl}}"
				@endif
				 alt="">

				<span class="tool">
					<a href="{{ url('/expert/zjsc')}}/{{$user -> id}}">
						<i class="layui-icon">&#xe608;</i>
						加入收藏
					</a>
				</span>
			</div>
			<!-- 详细信息 -->
			<div class="info">
				<div class="content">
					<div class="top">
						<p class="name">{{$user -> uname }}<span>{{$cate -> cate}}</span></p>
						<p class="keshi">{{ $user -> major }}</p>
						@if(empty(session('user')) or session('user') -> utp == 1 )
						<button class="expert_btn2 layui-btn layui-btn-big" user ="{{$user -> id}}"><i class="layui-icon ">&#xe63a; </i> 我要咨询</button>
						<input id="user" name="hid" type="hidden" value="{{$userid}}" />
						@endif
					</div>
					<dl>
						<dd><i class="icon1"></i><span>实名认证</span></dd>
						<dd><i class="icon2"></i><span>医生资质</span></dd>
						<dd><i class="icon3"></i><span>贡献值</span></dd>
					</dl>
					<p class="sex">
						<span>性别：{{ $user -> sex}}</span>
						<span>职务：{{$cate -> cate }}</span>
						<span>教育经历：{{$user -> jiaoyu}}</span>
					</p>
					<p class="shanchang">
						擅长：{{$user -> shanchang}}
					</p>
					<p class="jianjie"  id='jianjie'>
						简介：{{str_limit($user -> jianjie,$limit = 150)}}
						<small style="color:red;" class="btn1" id="{{$user -> id}}">查看全部</small>
					</p>
				</div>
				
			</div>
		</div>
	</div>
	
	<!-- 中间部分 -->
	<div id="main" class="container">
		<div id="left">
			<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
				<ul class="layui-tab-title">
					<li class="layui-this">资料贡献</li>
					<li>患者留言</li>
					<li>患者评价</li>
				</ul>
				<div class="layui-tab-content">
					<!-- 资料贡献 -->
					<div class="layui-tab-item layui-show">
						<p class="num">
							共有 <span>{{$num}}</span> 篇文章
						</p>
						<ul class="data">
						@foreach($wz as $wenzang)
							<li>
								<a href="{{ url('/expert/wenzang')}}/{{$wenzang -> id}}"><i class="layui-icon">&#xe623;</i>{{$wenzang -> name}}</a>
								<span class="time">{{date("Y-m-d",$wenzang -> dtime)}}</span>
							</li>
						@endforeach
						</ul>
						<!-- 分页 -->
						<div class="page">
							<ul>
								{!! $wz->links() !!}
							</ul>
						</div>
					</div>
					<!-- 患者留言 -->
					<div class="layui-tab-item">
					@if(empty(session('user')) or session('user')->utp == 1)
						<p class="num">
							<i class="layui-icon">&#xe63a;</i> 共有<span>{{$co}}</span>条网友留言
							<button class="layui-btn layui-btn-mini guestBtn"><i class="layui-icon">&#xe611; </i> 快速留言</button>
						</p>
					@endif
						<dl class="guest">
						@if(empty($message))
						<dd>暂无留言信息</dd>
						@else
						@foreach($message as $ly)
							<dd>
								<div class="title">
									<img src="{{ url('/updates')}}/{{$ly -> headurl}}" alt="">
									{{$ly -> uname }}
									<em>{{ date('Y-m-d H:i:s',$ly -> messtime)}}</em>
								</div>
								<div class="content">
									{{ $ly -> message }}
								</div>
							</dd>
						@endforeach
						@endif
												<div class="page">
							<ul>
								{!! $message->links() !!}
							</ul>
						</div>
						</dl>
						<!-- 分页 -->
						@if(empty(session('user')) or session('user')->utp == 1)
						<form class="layui-form" action="{{ url('/expert/message')}}" id="guest" method="post">
							{{ csrf_field() }}
							<div class="layui-form-item">
								<textarea name="message" placeholder="请输入内容" class="layui-textarea"></textarea>
								<input type="hidden" name='zjid' value='{{$user -> id }}'></input>
							</div>
							<div class="layui-form-item">
								<button class="layui-btn" class="guestBtn" lay-submit lay-filter="formDemo">提交留言</button>
								<button type="reset" class="layui-btn layui-btn-primary">重置</button>
							</div>
						</form>
						@endif
					</div>
					<!-- 患者评价 -->
					<div class="layui-tab-item">
						<p class="num">
							<i class="layui-icon">&#xe63a;</i> 共有<span>{{$con}}</span>条网友评价
						</p>
						<ul class="evaluate">
						@foreach($pj as $pingjia)
							<li>
								<div class="face">
									<img src="{{ url('/updates')}}/{{$pingjia -> headurl}}" alt="">
									<span class="name">{{$pingjia -> uname}}</span>
								</div>
								<div class="content">
									<p class="title">
										<span class="title"></span>
										<span class="time">{{ date('Y-m-d',$pingjia -> time)}}</span>
									</p>
									<p class="tags">
										<span>疗效：{{$pingjia -> liaoxiao}}</span>
										<span>服务：{{$pingjia -> fuwu}}</span>
										<span>就诊费用：不公开</span>
									</p>
									<p class="description">
										{{$pingjia -> content}}
									</p>

								</div>
								
							</li>
							
						@endforeach
						</ul>
						<!-- 分页 -->
						<div class="page">
							<ul>
								{!! $pj->links() !!}
							</ul>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<div id="right">
			<table class="layui-table">
				<thead>
					<tr>
						<th colspan="3">专家出诊时间</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th></th><th>上午</th><th>下午</th>
					</tr>
					<tr>
						<th>周一</th>
						
							<td >
								@if(strpos($user -> chuzhen,'1') !== false)
								<i class="layui-icon">&#xe618;</i>
								@endif
							</td>
							<td >
								@if(strpos($user -> chuzhen,'8') !== false)
								<i class="layui-icon">&#xe618;</i>
								@endif
							</td>
							
					</tr>
					<tr>
						<th>周二</th>
						<td >
								@if(strpos($user -> chuzhen,'2') !== false)
								<i class="layui-icon">&#xe618;</i>
								@endif
							</td>
							<td >
								@if(strpos($user -> chuzhen,'9') !== false)
								<i class="layui-icon">&#xe618;</i>
								@endif
							</td>
					</tr>
					<tr>
						<th>周三</th>
						<td >
								@if(strpos($user -> chuzhen,'3') !== false)
								<i class="layui-icon">&#xe618;</i>
								@endif
							</td>
							<td >
								@if(strpos($user -> chuzhen,'10') !== false)
								<i class="layui-icon">&#xe618;</i>
								@endif
							</td>
					</tr>
					<tr>
						<th>周四</th>
						<td >
								@if(strpos($user -> chuzhen,'4') !== false)
								<i class="layui-icon">&#xe618;</i>
								@endif
							</td>
							<td >
								@if(strpos($user -> chuzhen,'11') !== false)
								<i class="layui-icon">&#xe618;</i>
								@endif
							</td>
					</tr>
					<tr>
						<th>周五</th>
						<td >
								@if(strpos($user -> chuzhen,'5') !== false)
								<i class="layui-icon">&#xe618;</i>
								@endif
							</td>
							<td >
								@if(strpos($user -> chuzhen,'12') !== false)
								<i class="layui-icon">&#xe618;</i>
								@endif
							</td>
					</tr>
					<tr>
						<th>周六</th>
						<td >
								@if(strpos($user -> chuzhen,'6') !== false)
								<i class="layui-icon">&#xe618;</i>
								@endif
							</td>
							<td >
								@if(strpos($user -> chuzhen,'13') !== false)
								<i class="layui-icon">&#xe618;</i>
								@endif
							</td>
					</tr>
					<tr>
						<th>周日</th>
						<td >
								@if(strpos($user -> chuzhen,'7') !== false)
								<i class="layui-icon">&#xe618;</i>
								@endif
							</td>
							<td >
								@if(strpos($user -> chuzhen,'14') !== false)
								<i class="layui-icon">&#xe618;</i>
								@endif
							</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<!-- 底部推荐 -->
	<div id="recommend" class="container">
		<div class="recommend_title">
			<span class="left">法规政策</span>
			<span class="right"><a href="{{ url('/info/index')}}/59">查看更多>></a></span>
		</div>
		<ul class="recommend">
		@if(empty($zc))
		<li>暂无相关政策信息</li>
		@elseif(!empty($zc))
			<!-- 254*170 -->
			@foreach($zc as $zc)
			<li>
				<a href="{{ url('info/detail')}}/{{$zc -> id}}">
					<img src="{{ url('/updates')}}/{{$zc -> img}}" alt="文章名称">
				</a>
				<a href="{{ url('info/detail')}}/{{$zc -> id}}" class="title">
					{{$zc -> name }}
				</a>
				<div class="title time">{{ date('Y-m-d',$zc -> addtime)}}</div>
				<p class="description">
					{{str_limit($zc -> news,$limit = 50)}}
				</p>
			</li>
			@endforeach
		@endif
		</ul>
	</div>
<script type="text/javascript" src="{{ url('/home/layui/layui.js') }}"></script>
<script type="text/javascript">
		layui.use('element');
</script>
<script src="{{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/home/js/expert.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.btn1').on('click', function() {
			var id = $(this).attr('id');
			$.ajax({
				url : '/expert/jianjie/'+id,
				async:false,
				type : 'get',
				dataType : 'json',
				success : function(res){
					tableHtml = '简介：'+res.jianjie;
					$('#jianjie').html(tableHtml);
				}
			});
		});
	});
</script>
@endsection