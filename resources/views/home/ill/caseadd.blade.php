<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>康复社-添加病历</title>
	<meta name="keywords" content="">
	<meta name="description" content="">
	<link rel="stylesheet" href="{{ url('/home/layui/css/layui.css')}}">
	<link rel="stylesheet" href="{{ url('/home/css/common.css')}}">
	<link rel="stylesheet" href="{{ url('/home/css/medical_records.css')}}">
</head>
<body>

	<div id="main">
		<h3>添加病历</h3>
		<form action="{{ url('/ill/caseinsert')}}" method="post" class="layui-form" >
		{{ csrf_field() }}

			<table class="layui-table">
				<tr>
					<th colspan="2">人物信息</th>
				</tr>
				<tr>
					<td>
						<!-- 姓名 -->
						<div class="layui-form-item">
							<label class="layui-form-label">真实姓名</label>
							<div class="layui-input-inline">
								<input type="text" name="cname" required lay-verify="required" placeholder="请输入真实姓名"  class="layui-input" value="" id="character_name">
								<input type="hidden" value="" id="character_id" name='cid'>
							</div>
							<div class="layui-form-mid layui-word-aux">
								<a href="javascript:void(0);" class="layui-btn layui-btn-primary layui-btn-small" id="selectCharacter">
									<i class="layui-icon">&#xe613;</i> 选择人物
								</a>
							</div>
						</div>
					</td>
					<td>
						<!-- 出生年月 -->
						<div class="layui-form-item">
							<label class="layui-form-label">出生年月</label>
							<div class="layui-input-inline">
								<div class="layui-inline">
									<input class="layui-input" placeholder="出生年月" lay-verigy="required" readonly onclick="layui.laydate({elem: this})" id="character_cbir"  name='cbir' value=''>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<!-- 性别 -->
						<div class="layui-form-item">
							<label class="layui-form-label">性别</label>
							<div class="layui-input-block">
								<input name="csex" id="male" value='男' title="男" type="radio" checked="checked">
								<input name="csex" id="female" value='女' title="女" type="radio">
							</div>
						</div>
					</td>
					<td>
						<!-- 婚否 -->
						<div class="layui-form-item">
							<label class="layui-form-label">婚姻状况</label>
							<div class="layui-input-block">
								<input name="state" id="weihun" value='未婚' title="未婚" checked="checked" type="radio">
								<input name="state" id="yihun" value='已婚' title="已婚" type="radio">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<!-- 民族 -->
						<div class="layui-form-item">
							<label class="layui-form-label">民族</label>
							<div class="layui-input-inline">
								<select name="nation" id="national">
									<option value="">请选择民族</option>
								</select>
							</div>
						</div>
					</td>
					<td>
						<!-- 职业 -->
						<div class="layui-form-item">
							<label class="layui-form-label">职业</label>
							<div class="layui-input-inline">
								<input type="text" name="job" id="character_job" value='' placeholder="请填写职业" autocomplete="off" class="layui-input">
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
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
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<!-- 详细地址 -->
						<div class="layui-form-item">
							<label class="layui-form-label">详细地址</label>
							<div class="layui-input-block">
								<input type="text" name="caddress" required  lay-verify="" placeholder="详细地址" class="layui-input" id="character_caddress" value=''>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<!-- 住院时间 -->
						<div class="layui-form-item">
							<label class="layui-form-label">住院时间</label>
							<div class="layui-input-inline">
								<div class="layui-inline">
									<input class="layui-input" placeholder="住院时间" lay-verify="required" readonly onclick="layui.laydate({elem: this})" id="character_intime"  name ='intime' value=''>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<th colspan="2">病历信息</th>
				</tr>
				<tr>
					<td>
						<!-- 病历名称 -->
						<div class="layui-form-item">
							<label class="layui-form-label">病历名称</label>
							<div class="layui-input-block">
								<input type="text" name="dname" placeholder="请填写病历名称" autocomplete="off" class="layui-input">
							</div>
						</div>
					</td>
					<td>
						<!-- 科室选择 -->
						<div class="layui-form-item">
							<label class="layui-form-label">科室</label>
							<div class="layui-input-inline">
								<select name="type">
									<option value="">请选科室</option>
									@foreach($keshi as $keshi)
									<option value="{{$keshi -> id}}">{{$keshi -> name}}</option>
									@endforeach
									
								</select>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<!-- 病历描述 -->
						<div class="layui-form-item">
							<label class="layui-form-label">病历描述</label>
							<div class="layui-input-block" >
								<textarea name="explain" placeholder="请输入病历描述" class="layui-textarea"></textarea>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<!-- 检查报告 -->
						<div class="layui-form-item">
							<label class="layui-form-label">检查报告</label>
							<div class="layui-input-block" id="baogao">
								<input name="file" id="jiancha" class="layui-upload-file" lay-title="添加检查报告" type="file"> 
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<!-- 康复评定 -->
						<div class="layui-form-item">
							<label class="layui-form-label">康复评定</label>
							<div class="layui-input-block" id='kangfu'>
								<input name="file1" id="pingding" class="layui-upload-file" lay-title="添加康复评定" type="file"> 
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<!-- 电子病历 -->
						<div class="layui-form-item">
							<label class="layui-form-label">电子病历</label>
							<div class="layui-input-block" id='bl'>
								<input name="file2" id="bingli" class="layui-upload-file" lay-title="添加电子病历" type="file"> 
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" id="submitTd">
						<p>
							<input type="checkbox" name="xieyi" lay-skin="switch" >
							我已同意《<a href="javascript:void(0);" id="binglixieyi">病历上传协议</a>》
							<input type='hidden' name='xieyiFlag' value='1' lay-verify='xieyiFlag'>
						</p>
						<div class="layui-form-item">
							<div class="layui-input-inline">
								<button class="layui-btn" lay-submit lay-filter="formDemo" id='submit'>提交</button>
								<button type="reset" class="layui-btn layui-btn-primary">重置</button>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</form>
	</div>

<script type="text/javascript" src="{{ url('/home/js/national.js')}}"></script>
<script src="{{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{url('/home/js/area2.js')}}"></script><script type="text/javascript" src="{{url('/home/js/getArea.js')}}"></script>
<script src="{{ url('/home/layui/layui.js') }}"></script>

<script type="text/javascript">
	layui.use(['form','layer','laydate','upload'],function(){

		var layer = layui.layer,form = layui.form();
		//验证
		form.on('switch',function(data){
			// $('#submit').removeClass('layui-btn-disabled');
			if (data.elem.checked) {
				$('input[name=xieyiFlag]').val(2);
			}else{
				$('input[name=xieyiFlag]').val(1);
			}

		});

		form.verify({
			xieyiFlag:function(value){
				if (value == 1) {
					return '还未同意病例上传协议';
				}
			}
		});

		//上传检查报告
		layui.upload({
			url: '/ill/img',
			elem: '#jiancha', //指定原始元素，默认直接查找class="layui-upload-file"
			method: 'post', //上传接口的http类型
			success: function(res){ //上传成功后的回调
				var html = "<div class='thumbnail'><img src='"+res.url+"' /><input type='hidden' name='baogaoimg[]' value='"+res.baogaoimg+"'><div class='tool'><a href='javascript:void(0);' class='delBtn'><i class='layui-icon'>&#xe640;</i></a></div></div>";
				$('#baogao').before(html);
    		}
		});

		//上传康复评定
		layui.upload({
			url: '/ill/img',
			elem: '#pingding', 
			method: 'post',
			success: function(res){ 
			var html = "<div class='thumbnail'><img src='"+res.url+"' /><input type='hidden' name='pingdingimg[]' value='"+res.baogaoimg+"'><div class='tool'><a href='javascript:void(0);' class='delBtn'><i class='layui-icon'>&#xe640;</i></a></div></div>";
			$('#kangfu').before(html);
			}
		});

		//上传电子病历
		layui.upload({
			url: '/ill/img',
			elem: '#bingli', 
			method: 'post',
			success: function(res){ 
			var html = "<div class='thumbnail'><img src='"+res.url+"' /><input type='hidden' name='bingliimg[]' value='"+res.baogaoimg+"'><div class='tool'><a href='javascript:void(0);' class='delBtn'><i class='layui-icon'>&#xe640;</i></a></div></div>";
			$('#bl').before(html);
			}
		});

		$('.delBtn').live('click',function(){
			var delImg = $(this).parents('.thumbnail').children('input').val();
			var delBtn = $(this);
			$.ajax({
				url : '/ill/deleteimg',
				type : 'post',
				data : {'url':delImg},
				success:function(data){
					if(data.url = 1)
					{

						delBtn.parents('.thumbnail').remove();
						layer.msg('删除成功');
					}

				}

			});
		});
	});
	
</script>

<script type="text/javascript">
	//选择人物弹窗
	$('#selectCharacter').on('click', function() {
		layer.open({
			title : '人物选择',
			type : 2,
			content : '/ill/select',
			area : ['600px','500px'],
			end : function(){
				layui.form().render();
			}
		});
	});
	//验证


	//上传协议弹窗
	$('#binglixieyi').on('click', function() {
		layer.open({
			title : '阅读《病历上传协议》',
			type : 2,
			content : '/ill/xieyi',
			area : ['600px','500px'],
			btn : ['同意','不同意'],
			yes : function(index){
				layer.close(index);
				$('#submitTd p input').attr('checked', 'checked');
				$('#submitTd p .layui-form-switch').addClass('layui-form-onswitch');
				$('input[name=xieyiFlag]').val(2);
			},
			btn2 : function(){
				$('#submitTd p input').attr('checked', '');
				$('#submitTd p .layui-form-switch').removeClass('layui-form-onswitch');
				$('input[name=xieyiFlag]').val(1);
			}
		});
	});
		//城市联动
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
</body>
</html>