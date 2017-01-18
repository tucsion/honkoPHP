<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="{{ url('/home/css/base.css')}}">
	<link rel="stylesheet" href="{{ url('/home/css/common.css')}}">
	<link rel="stylesheet" href="{{ url('/home/layui/css/layui.css')}}">
	<link rel="stylesheet" href="{{ url('/home/css/member.css')}}">
</head>
<body>
	<div class="address">
		<div class="content">
			<p class="tishi">温馨提示：这里的地址为购买商品邮寄地址</p>

			<!-- 新增收货地址 -->
			<form class="layui-form">
			{{ csrf_field() }}
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
				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">详细地址</label>
					<div class="layui-input-block">
						<textarea placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码，楼层和房间号等信息" class="layui-textarea" name='address' lay-verify="required">{{$add -> address}}</textarea>
					</div>
				</div>
				<!-- 邮编 -->
				<div class="layui-form-item">
					<label class="layui-form-label">邮政编码</label>
					<div class="layui-input-block w50">
					<input type ="hidden" name='id' value='{{$add -> id}}'>
						<input type="text" lay-verify="number"  name ="postcode" placeholder="如您不清楚邮递区号，请填写000000" value="{{$add->postcode}}"class="layui-input">
					</div>
				</div>
				<!-- 姓名 -->
				<div class="layui-form-item">
					<label class="layui-form-label">收货人姓名</label>
					<div class="layui-input-inline">
						<input type="text" lay-verify="required name" placeholder="长度2-25个字符" name="uname" value="{{$add -> uname}}" class="layui-input">
					</div>
				</div>
				<!-- 手机 -->
				<div class="layui-form-item">
					<label class="layui-form-label">手机</label>
					<div class="layui-input-inline">
						<input type="text" required  lay-verify="phone" placeholder="请填写11位手机号" name="utel" value="{{$add -> utel}}" class="layui-input">
					</div>
				</div>
				
				<div class="layui-form-item">
					<label class="layui-form-label"></label>
					<div class="layui-input-inline">
						<input type="checkbox" name="state" lay-skin="switch"><div class="layui-form-mid layui-word-aux">设置为默认收货地址</div>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn" lay-submit lay-filter="formSubmit">保存</button>
					</div>	
				</div>
			</form>
			
		</div>
	</div>
	
	<script type="text/javascript" src="{{url('/home/layui/layui.js')}}"></script>
	<script type="text/javascript" src="{{url('/home/js/area2.js')}}"></script>
	<script type="text/javascript" src="{{url('/home/js/getArea.js')}}"></script>
	<script type="text/javascript">
		//地址联动
		var areaData = Area;
		var $form;
		var form;
		var $;
		var pp = '';
		layui.use(['jquery', 'form'], function() {
		   var pp = '{{$add -> province}}';//省
		   var cc = '{{$add -> city}}';//市
		   var aa = '{{$add -> county}}';//县
	
		   $ = layui.jquery;
		   form = layui.form();
		   $form = $('form');
		   loadProvince(pp);
		   var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
		   //修改页面
		   if (pp) {
		       var index1 = pp.split('_')[2];
		       var index2 = cc.split('_')[2];

		       loadCity(areaData[index1].mallCityList,cc);
		       loadArea((areaData[index1].mallCityList)[index2],aa);
		       loadArea(((areaData[index1].mallCityList)[index2]).mallAreaList,aa);
		   }
		   //表单提交
		   //{{ url('/home/user/updateadd')}}
		   form.on('submit(formSubmit)',function(data){
		   		$.ajax({
		   			url : '/home/user/updateadd',
		   			type : 'post',
		   			dataType : 'json',
		   			data : data.field,
		   			success : function(msg){
		   				if (msg.status == 1) {
		   					layer.close('index');
		   					parent.layer.msg('修改成功');
		   					parent.layer.close(index);
		   					form.render();
		   					window.parent.frames.location.href="/home/user/address" 
		   				}
		   			}
		   		});
		   		
		   		return false;	
		   			
		   });
		});

	</script>
</body>
</html>
