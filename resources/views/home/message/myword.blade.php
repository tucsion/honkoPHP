@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-系统消息';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
<div class="headTitle">我的留言</div>
<div class="message">
	<ul class="guest">
	@foreach($word as $myword)
		<li class="transition">
			<div class="head">
				<div class="left">
					<i class="layui-icon">&#xe612;</i>
					<span class="time">{{date('Y-m-d H:i:s',$myword -> messtime)}}</span>
					<span class="zhuanjia"><a href="#">{{$myword -> uname}}</a></span>
					@if($myword -> type == 0)
					留言
					@else($myword -> type == 1)
					回复
					@endif：
					@if($myword -> state == 0)
					<button class="layui-btn layui-btn-mini layui-btn-danger newIcon" id='{{$myword -> id}}'>NEW</button>
					@endif
				</div>
				<div class="right">
					<button title="删除" class="delBtn layui-btn layui-btn-mini layui-btn-danger" id="{{$myword -> id}}">
						<i class="layui-icon">&#xe640;</i>
					</button>
					@if($myword -> type == 1)
					<button title="快捷回复" class="guestBtn layui-btn layui-btn-mini layui-btn-warm">
						<i class="layui-icon">&#xe642;</i>
					</button>
					@endif
				</div>
			</div>
			<p class="content">
				{{$myword -> message}}
			</p>
		</li>
	@endforeach
	</ul>
	<div class="page">{!! $word -> links()!!}</div>
</div>

<!-- 快捷留言 -->
<div id="quick_guest">
	<form action="" class="layui-form">
		<div class="layui-form-item">
			<input type="hidden" name='zjid' value="{{$myword -> zjid}}" ></input>
			<textarea placeholder="请输入内容" name="message" class="layui-textarea" style="width: 500px;height: 100px;margin: 10px;"></textarea>
		</div>
	</form>
</div>

</div>
<script type="text/javascript">
	$('.delBtn').on('click', function() {

		// alert(delTr);
		var id = $(this).attr('id');
		layer.confirm('您真的要删除吗？', {
			btn: ['删除','算了']
		},function(){//确认
			$.ajax({
				url : '/message/deleteword',
				data : {'id':id},
				type : 'post',
				success : function(data){
					if (data.status == 1) {
						layer.msg(data.msg);
						window.location.href="/message/myword"; 
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
	
	
	//快捷回复
	$('button.guestBtn').on('click', function() {
		layer.open({
			title : '给专家留言',
			type : 1,
			content : $('#quick_guest'),
			area : ['auto'],
			btn : ['留言','取消'],
			yes : function(index){
				layer.close(index);
				layer.msg('留言成功');
			},
			btn2 : function(){
				layer.msg('你取消了');
			}
		});
	});


	//点击删除new
	$('.newIcon').on('click', function() {
		var thisA = $(this);
		var id = $(this).attr('id');
			$.ajax({
				url : '/message/mywordxq',
				data : {'id':id},
				type : 'post',
				success : function(data){
					if (data.status == 1) {
						window.location.href="/message/myword"; 

					}else{
						layer.msg(data.msg);
					}
					
				}
			});	
		});


</script>
@endsection