 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='康复社-专家列表';
</script> 


<link rel="stylesheet" href="{{ url('/home/css/expert.css') }}">

	<!-- 内容开始 -->
	<div id="filter" class="container">
		<dl>
		
			<dt>康复科：</dt>
			<dd><a href="{{ url('/expert/zjlist') }}/keshi=0" class="active">全部</a></dd>
			
			@foreach($keshi as $ks)
			<dd><a href="{{ url('/expert/zjlist') }}/keshi={{ $ks -> id }}">{{ $ks -> name }}</a></dd>
			@endforeach
		
		</dl>
		<dl>
			<dt>医生职称：</dt>
			<dd><a href="{{ url('/expert/zjlist') }}/zc=0" class="active">全部</a></dd>
			@foreach($expert as $zc)
			<dd><a href="{{ url('/expert/zjlist') }}/zc={{$zc -> id}}">{{ $zc -> cate }}</a></dd>
			@endforeach
		</dl>
		<dl>
			<dt>首字母：</dt>
			<dd><a href="{{ url('/expert/zjlist') }}/py=1"
			@if($py == 1 or $py == 0)
			class="active"
			@endif>全部</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=a"
			@if($py == 'a')
			class="active"
			@endif>A</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=b"
			@if($py == 'b')
			class="active"
			@endif>B</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=c"
			@if($py == 'c')
			class="active"
			@endif>C</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=d"
			@if($py == 'd')
			class="active"
			@endif>D</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=e"
			@if($py == 'e')
			class="active"
			@endif>E</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=f"
			@if($py == 'f')
			class="active"
			@endif>F</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=g"
			@if($py == 'g')
			class="active"
			@endif>G</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=h"
			@if($py == 'h')
			class="active"
			@endif>H</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=j"
			@if($py == 'j')
			class="active"
			@endif>J</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=k"
			@if($py == 'k')
			class="active"
			@endif>K</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=l"
			@if($py == 'l')
			class="active"
			@endif>L</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=m"
			@if($py == 'm')
			class="active"
			@endif>M</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=n"
			@if($py == 'n')
			class="active"
			@endif>N</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=o"
			@if($py == 'o')
			class="active"
			@endif>O</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=p"
			@if($py == 'p')
			class="active"
			@endif>P</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=q"
			@if($py == 'q')
			class="active"
			@endif>Q</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=r"
			@if($py == 'r')
			class="active"
			@endif>R</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=s"
			@if($py == 's')
			class="active"
			@endif>S</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=t"
			@if($py == 't')
			class="active"
			@endif>T</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=w"
			@if($py == 'w')
			class="active"
			@endif>W</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=x"
			@if($py == 'x')
			class="active"
			@endif>X</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=y"
			@if($py == 'y')
			class="active"
			@endif>Y</a></dd>
			<dd><a href="{{ url('/expert/zjlist') }}/py=z"
			@if($py == 'z')
			class="active"
			@endif>Z</a></dd>
		</dl>
	</div>
	<p class="container num">
		平台有<span> {{$num}} </span>名优质医生为您的健康保驾护航
	</p>
	<div id="main" class="container">
		<div id="left">
		@foreach($user as $u)
			<ul>
				<li>
					<a  id="ids" href="{{ url('/expert/detail') }}/{{ $u -> id}}" class="face">
						<img src="{{ url('/updates')}}/{{($u ->headurl)}}" alt="医生姓名">
					</a>
					<div class="info">
						<p class="top">
							<span class="name">{{$u -> uname}}</span>
							<span class="zhicheng">
		         				@foreach($expert as $zhicheng)
								@if($u -> zhicheng == $zhicheng -> id )
								{{ $zhicheng -> cate }}
								@endif
								@endforeach
								
							</span>
							<span 

							@if($u -> isrz == 0)
							 class="renzheng weirenzheng" 
							@elseif($u -> isrz == 1)
							class="renzheng yirenzheng"
							@endif
							>实名认证
							</span>
							
							@if($u -> iszaixian == 0)
							<span class="online lixian">离线</span>
							@elseif($u -> iszaixian == 1)
							<span class="online zaixian">在线</span>
							@endif
						
						</p>
						<p class="keshi">
							{{$u -> major}}&nbsp;&nbsp;
							@foreach($keshi as $k)	
							@if(strpos($u -> keshi,(string)$k -> id) !== false)
							{{ $k -> name}}&nbsp;
							@endif
							@endforeach
						</p>
						<p class="shanchang">{{ $u -> shanchang }}</p>
						@if(empty(session('user')) or session('user') -> utp == 1)
						<div class="list_btns">
							<button class="expert_btn1" id='{{$u -> id}}'>免费留言</button>
							<button class="expert_btn2" user="{{$u -> id}}">付费咨询</button>
							<input id="user" name="hid" type="hidden" value="{{$userid}}" />
						</div>
						@endif
					</div>
					<div class="time">
						<table class="layui-table">
							<tr>
								<th rowspan="3">出诊时间</th>
								<th>周一</th>
								<th>周二</th>
								<th>周三</th>
								<th>周四</th>
								<th>周五</th>
								<th>周六</th>
								<th>周日</th>
							</tr>
							<tr>
							@for ($i = 1; $i < 8; $i++)
								<td 
								@if(strpos($u -> chuzhen,(string)$i) !== false)
								class="active"
								@endif>上午</td>
							@endfor
							</tr>
							<tr>
							@for ($i = 1; $i < 8; $i++)
								<td
								
								@if(strpos($u -> chuzhen,(string)($i + 7)) !== false)
                        		class="active"	
                          		@endif>下午</td>
							@endfor
							</tr>
						</table>
					</div>
				</li>
			</ul>
		@endforeach

			<div class="page">
				<ul>
					{!! $user->links() !!}
				</ul>
			</div>
		</div>
		<div id="right">
			<div class="rightTitle">
				<span class="title">医生文章</span>
				<span class="more"><a href="#">更多>></a></span>
			</div>
			<div class="sideMenu clear">
				<ul>
				@foreach($wz as $wenzhang)
					<li>
						<a href="#">{{ $wenzhang -> name}}</a>
						<dl>
							<dd class="icon">
								<em class="yuedu">阅读 
								@if(empty($wenzhang -> num))
								0
								@elseif(!empty($wenzhang -> num))
								{{$wenzhang -> num}}
								@endif</em>
								<em class="pinglun">评论 
								@if(empty($wenzhang -> comnum))
								0
								@elseif(!empty($wenzhang -> comnum))
								{{$wenzhang -> comnum}}
								@endif</em>
							</dd>
							<dd class="face">

								<img src="{{ url('/updates')}}/{{($wenzhang ->headurl)}}" alt="">
							</dd>
							<dd class="info">
								<p>发布医生：<span>{{$wenzhang -> uname }}</span></p>
								<p>{{ $wenzhang -> major}}</p>
								<p>
								@foreach($keshi as $kes)	
								@if(strpos($u -> keshi,(string)$kes -> id) !== false)
								{{ $kes -> name}}&nbsp;
								@endif
								@endforeach
								&nbsp; 
								@foreach($expert as $zhic)
								@if($u -> zhicheng == $zhic -> id )
								{{ $zhic -> cate }}
								@endif
								@endforeach
								</p>
							</dd>
						</dl>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	@if(session('info'))

      <script type="text/javascript">
      	alert(session('info'));
      </script>                  
     
                            
     @endif
	<div id="guest">
	
	
	
		<form action="{{ url('/expert/message')}}"  method="post">
		{{ csrf_field() }}
			<div class="layui-form-item">
				<textarea name="message" placeholder="请输入内容" class="layui-textarea"></textarea>
				<input type="hidden" id="zjid" name='zjid' value=''></input>
			</div>
			<div class="layui-form-item">
				<button class="layui-btn" class="guestBtn" lay-submit lay-filter="formDemo">提交留言</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</form>
	
	</div>

<script src="{{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/home/js/expert.js') }}"></script>

	<!-- 脚部 -->
@endsection