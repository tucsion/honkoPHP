@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-基础资料';
</script>
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">

<div class="base">
	<div class="headTitle">基础资料</div>
	<div class="content">
	@if(session('editzld'))
	<script type="text/javascript">
		alert('修改失败');
	</script>
	@endif
	@if(session('editzl'))
	<script type="text/javascript">
			alert('修改成功');
	</script>
	@endif
		<form class="layui-form" action="{{ url('/home/user/editzl')}}" method="post" ENCTYPE= 'MULTIPART/FORM-DATA'>
 		{{ csrf_field() }}
			<!-- 头像 -->
			<div class="layui-form-item">
				<label class="layui-form-label">头像设置</label>
				<div class="layui-input-block">
					<div class="img">
						<input name="file" class="layui-upload-file" type="file"> 
						<img src="" alt="">
						<input type="hidden" name='face' id="face" value=''>
					</div>
				</div>
			</div>
			<!-- 昵称 -->
			<div class="layui-form-item">
				<label class="layui-form-label">用户昵称</label>
				<div class="layui-input-inline">
					<input type="text" name="uname" required  lay-verify="required" placeholder="请输昵称" value='{{$user -> uname}}' class="layui-input">
				</div>
			</div>
			<!-- 邮箱 -->
			<div class="layui-form-item">
				<label class="layui-form-label">邮箱设置</label>
				<div class="layui-input-block">
					<input type="text" name="email" required  lay-verify="required email" placeholder="邮箱设置" value='{{$user -> email}}' class="layui-input">
				</div>
			</div>
			<!-- 地域选择 -->
			<div class="layui-form-item">
                <label class="layui-form-label">选择地区</label>
                <div class="layui-input-inline">
                    <select name="province" id="province" lay-filter="province" lay-verify="required">
                        <option value="">请选择省</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="city" id="city" lay-filter="city" lay-verify="required">
                        <option value="">请选择市</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="county" id="area" lay-filter="area" lay-verify="required">
                        <option value="">请选择县/区</option>
                    </select>
                </div>
            </div>
			<!-- 详细地址 -->
			<div class="layui-form-item">
				<label class="layui-form-label">详细地址</label>
				<div class="layui-input-block">
					<input type="text" name="address" required  lay-verify="" placeholder="详细地址" value='{{$user -> address}}' class="layui-input">
				</div>
			</div>
			<!-- 手机号码 -->
			<div class="layui-form-item">
				<label class="layui-form-label">手机号码</label>
				<div class="layui-input-inline">
					<input type="text" name="phone" required  lay-verify="phone" placeholder="手机号码" value='{{$user -> phone }}' class="layui-input">
				</div>
			</div>

			<div class="layui-form-item">
				<div class="layui-input-block">
					<button class="layui-btn" lay-submit lay-filter="">提交</button>
					
				</div>
			</div>
		</form>
	</div>
</div>
</div>
</div>
<script type="text/javascript" src="{{url('/home/js/area2.js')}}"></script>
<script type="text/javascript" src="{{url('/home/js/getArea.js')}}"></script>
<script type="text/javascript">	
	layui.use(['form','upload'],function(){
		var form = layui.form();

		layui.upload({
			// elem : '#test',
		    url: '/home/user/img' //上传接口
		    ,
		    method :'post',
		    
			success: function(res){ //上传成功后的回调
		    	$('.img img').attr('src',res.url).css('display','inline-block');
		    	$('.img input[type=hidden]').attr('value',res.url);
		    	$('.img input[type=file]').addClass('opacityBtn');
	    	}
		});

		form.render();

		
	});
	

	//地域选择
	//初始数据
	var areaData = Area;
	var $form;
	var form;
	var $;
	var pp = '';
	layui.use(['jquery', 'form'], function() {
	   var pp = '{{$user -> province}}';//省
	   var cc = '{{$user -> city}}';//市
	   var aa = '{{$user -> county}}';//县

	   $ = layui.jquery;
	   form = layui.form();
	   $form = $('form');
	   loadProvince(pp);

	   //修改页面
	   if (pp) {
	       var index1 = pp.split('_')[2];
	       var index2 = cc.split('_')[2];

	       loadCity(areaData[index1].mallCityList,cc);
	       loadArea((areaData[index1].mallCityList)[index2],aa);
	       loadArea(((areaData[index1].mallCityList)[index2]).mallAreaList,aa);
	   }
	});

</script>


@endsection
