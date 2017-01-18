@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-基本资料';
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
		<form class="layui-form" action="{{ url('/home/zjuser/editzl')}}" method="post" ENCTYPE= 'MULTIPART/FORM-DATA'>
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
			<!-- 所属医院 -->
			<div class="layui-form-item">
				<label class="layui-form-label">所属医院</label>
				<div class="layui-input-block">
					<input type="text" name="major" required  lay-verify="" placeholder="所属医院" value='{{$user -> major}}' class="layui-input">
				</div>
			</div>
			<!-- 职称 -->
			<div class="layui-form-item">
				<label class="layui-form-label">职称</label>
				<div class="layui-input-block">
					<select name="zhicheng" id="">
					<option value="">请选择职称</option>
					@foreach($expert as $zhicheng)
					<option value="{{$zhicheng -> id }}"
					@if(session('user') -> zhicheng == $zhicheng -> id)
					selected
					@endif>{{$zhicheng -> cate}}</option>
					@endforeach
				</select>
				</div>
			</div>
			<!-- 专科设置 -->
			<div class="layui-form-item">
				<label class="layui-form-label">专科设置</label>
				<div class="layui-input-block">
				@foreach($keshi as $zhuanke)
					<input type="checkbox" name="keshi[]" title="{{$zhuanke -> name}}"  value="{{$zhuanke -> id}}"
					@if(strpos(($user ->keshi),((string)$zhuanke -> id)) !== false)
					checked
					@endif>
				@endforeach
				</div>
			</div>
			<!-- 出诊时间 -->
			<div class="layui-form-item">
				<label class="layui-form-label">出诊时间</label>
				<div class="layui-input-block">
				<table class="visit" ellpadding="2" cellspacing="1" >
                      <tr>
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
                        <td><input type="checkbox" name="chuzhen[{{$i}}]" value="{{$i}}"
                          {{ $chuzhen = $user -> chuzhen}}
                          {{ $i = (string)$i }}
                          title ='上午'
                        @if(strpos($chuzhen,$i) !== false)
                       
                        checked ="checked"
                         
                        @endif></td>
                        @endfor
                      </tr>
                      <tr>
                        @for ($i = 1; $i < 8; $i++)
                          <td><input type="checkbox" name="chuzhen[{{($i+7)}}]" value='{{($i+7)}}' title="下午" 
                          
                          {{$t = $i +7 }}
                          {{$t = (string)$t}}
                         
                          @if(strpos($chuzhen,$t) !== false)
                        
                          checked ="checked"
                         
                          @endif
                          
                          ></td>
                        @endfor
                      </tr>
                    </table>
				</div>
			</div>
			<!-- 手机号码 -->
			<div class="layui-form-item">
				<label class="layui-form-label">手机号码</label>
				<div class="layui-input-inline">
					<input type="text" name="phone" required  lay-verify="phone" placeholder="手机号码" value='{{$user -> phone }}' class="layui-input">
				</div>
			</div>
			<!-- 擅长 -->
			<div class="layui-form-item">
				<label class="layui-form-label">擅长</label>
				<div class="layui-input-block">
					<input type="text" name="shanchang" required  lay-verify="" placeholder="擅长" value='{{$user -> shanchang}}' class="layui-input">
				</div>
			</div>
			<!-- 擅长 -->
			<div class="layui-form-item">
				<label class="layui-form-label">教育经历</label>
				<div class="layui-input-block">
					<input type="text" name="jiaoyu" required  lay-verify="" placeholder="教育经历" value='{{$user -> jiaoyu}}' class="layui-input">
				</div>
			</div>	
			<!-- 擅长 -->
			<div class="layui-form-item">
				<label class="layui-form-label">简介</label>
				<div class="layui-input-block">
					<input type="text" name="jianjie" required  lay-verify="" placeholder="教育经历" value='{{$user -> jianjie}}' class="layui-input">
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
