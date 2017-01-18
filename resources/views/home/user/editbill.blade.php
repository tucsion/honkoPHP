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
			<form class="layui-form" >
			{{ csrf_field() }}
			
					<div class="layui-form-item layui-form-text">
							<label class="layui-form-label">发票抬头</label>
							<div class="layui-input-block">
							<input type="hidden" name='id' value="{{$bill -> id}}"></input>
								<input type="text" lay-verify=""  name ="depict" placeholder="请填写真实的发票抬头" class="layui-input" value="{{$bill -> depict}}">
							</div>
						</div>
						<!-- 邮编 -->
						<div class="layui-form-item">
							<label class="layui-form-label">发票类型</label>
							<div class="layui-input-block w50">
								<input type="text" lay-verify=""  name ="billtype" placeholder=""  value='普通发票' disabled='' class="layui-input">
							</div>
						</div>
						<!-- 姓名 -->
						<div class="layui-form-item">
							<label class="layui-form-label">发票项目</label>
							<div class="layui-input-inline">
								<input type="text" lay-verify="required name" placeholder="长度2-25个字符" name="billitem"  value='医疗器械' disabled='' class="layui-input">
							</div>
						</div>
						<!-- 手机 -->
						<div class="layui-form-item">
							<label class="layui-form-label">收件人</label>
							<div class="layui-input-inline">
								<input type="text" required  lay-verify="" placeholder="请填写收件人姓名" name="receiver" value='{{$bill -> receiver}}' class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">电话</label>
							<div class="layui-input-inline">
								<input type="text" required  lay-verify="phone" placeholder="请填写收件人联系电话" name="phone" value='{{$bill -> phone}}' class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">地址</label>
							<div class="layui-input-inline">
								<input type="text" required  lay-verify="" placeholder="请填写收件人地址" name="address"  value='{{$bill -> address}}' class="layui-input">
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
		   			url : '/home/user/updatebill',
		   			type : 'post',
		   			dataType : 'json',
		   			data : data.field,
		   			success : function(msg){
		   				if (msg.status == 1) {
		   					layer.close('index');
		   					parent.layer.msg('修改成功');
		   					parent.layer.close(index);
		   					window.parent.frames.location.href="/home/user/bill" 
		   				}
		   			}
		   		});
		   		
		   		return false;	
		   			
		   });
		});

	</script>
</body>
</html>
