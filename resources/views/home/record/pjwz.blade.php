@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-订单评价';
</script>
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>
@if(session('pjzjd'))
	<script type="text/javascript">
		alert('评价失败,请重试');
	</script>
@endif
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">


<div class="headTitle">订单评价</div>

<div class="pass">
	<form action="{{url('/record/wztj')}}" method="post">
	{{ csrf_field() }}
			<div class="message">
			<ul class="expert">
			
			<li class="transition">
			<p class="head">立即评价</p>
			<p class="content">
   			<textarea name="content" required lay-verify="required" placeholder="请输入评价内容" class="layui-textarea"></textarea>
   			<input type="hidden" name="id" value="{{$id}}"></input>
			</p>
			<p class="showBtn"><button class="layui-btn layui-btn-primary layui-btn-mini">评价 <i class="layui-icon">&#xe602;</i></button></p>
		</li>
			</ul>
		</div>
		</form>
		</div> <!--index-->
		</div>
	</div>
</div>
</div>
@endsection

