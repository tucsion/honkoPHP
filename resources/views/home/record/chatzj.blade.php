@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-咨询记录';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
@if(session('zx'))
	<script type="text/javascript">
		alert('回复成功');
	</script>
@endif
@if(session('zxd'))
	<script type="text/javascript">
		alert('回复失败,请重试');
	</script>
@endif
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
<div class="index"> 
	<div class="list">
		<p class="bTitle">病例名称:<a href="{{ url('home/tuisong/blxq')}}/{{$blxq -> id}}" if='blxq'target="_blank">{{$blxq -> dname}}</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						咨询专家:<a id='zjid' href="{{ url('/expert/detail')}}/{{$zj -> id}}">{{$zj -> uname}}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						剩余咨询条数:{{$blxq -> zxnum - $blxq -> usenum}}
		</p>
	</div>
	<div style="padding: 10px;">
		@if(empty($zixun))
		<p>暂无咨询记录</p>
		@else
		@foreach($zixun as $zx)
		@if($zx -> type == 0)
		<p>患者咨询:{{$zx -> news}}</p>
		@endif
		@if($zx -> type == 1)
		<p>我:{{$zx -> news}}
		@endif
		@endforeach
		@endif
	</div>
	<form action="{{url('/record/huifu')}}" method="post">
	{{ csrf_field() }}
			<div class="message">
			<ul class="expert">
			
			<li class="transition">
			<p class="head">立即回复患者</p>
			<p class="content">
   			<textarea name="news" required lay-verify="required" placeholder="请输入回复内容" class="layui-textarea"></textarea>
   			<input type="hidden" name="bid" value="{{$blxq -> id}}"></input>
   			<input type="hidden" name="zjid" value="{{$zj -> id}}"></input>
			</p>
			<p class="showBtn"><button class="layui-btn layui-btn-primary layui-btn-mini">回复 <i class="layui-icon">&#xe602;</i></button></p>
		</li>
			</ul>
		</div>
		</form>
		</div> <!--index-->
		</div>
	</div>

	<!-- 脚部 -->
<script type="text/javascript">
        $(function(){
        setInterval(aa,10000);
        function aa()
        {
        $.ajax({
                url : '{{url('/record/ajax')}}/{{$blxq -> id}}/{{$zj -> id}}',
                async:false,
                type : 'get',
                dataType : 'json',
                success : function(res){
                            if(res.status == 1)
                            {
                                
                                var illid = res.illid;
                                var zjid = res.zjid;
                                window.location.href="{{url('/record/chatzj')}}/"+illid+"/"+zjid; 
                                
                            }
                            if(res.status == 0)
                            {
                                 
                            }
                        }

        });
        }
    });
</script>
	
@endsection