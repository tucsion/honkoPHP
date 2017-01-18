 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='支付宝支付接口';
</script> 

<link rel="stylesheet" href="{{ url('/home/css/expert.css') }}">

<div class="container" id="filter">
		<div>
		<dl>
			<dd style="font-size:13px;">1、确认信息 </dd>
			<dd style="font-size:13px;"> → 2、点击确认</dd>
			<dd style="font-size:13px;color:red;"> → 3、确认完成</dd>
		</dl>
		</div>
		<dl style="text-align:center;">
			支付成功,<small id='miaoshu'></small>秒后返回个人中心
		</dl>
		
</div>

    <script type="text/javascript">  
    //设定倒数秒数  
    var t = 5;  
    //显示倒数秒数  
    function showTime(){  
        t -= 1;  
        document.getElementById('miaoshu').innerHTML= t;  
        if(t==0){  
            location.href="{{ url('/home/user/index')}}";  
        }  
        //每秒执行一次,showTime()  
        setTimeout("showTime()",1000);  
    }  
      
      
    //执行showTime()  
    showTime();  
    </script>  



	<!-- 脚部 -->
@endsection