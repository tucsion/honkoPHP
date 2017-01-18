<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>付费咨询弹窗</title>
	<link rel="stylesheet" href="{{ url('/home/layui/css/layui.css') }}">
	<link rel="stylesheet" href="{{ url('/home/css/consulting.css') }}">
</head>

<body>
	<div class="face">
		<img src="{{ url('/updates')}}/{{$u -> headurl}}" alt="">
	</div>
	<div class="info">
		<p class="name">{{$u -> uname}}</p>
		<p class="keshi">{{$u -> major}}</p>
		<p class="shanchang">
			擅长：{{$u -> shanchang}}
		</p>
		<p class="jianjie"  id='jianjie'>
			简介：{{str_limit($u -> jianjie,$limit = 150)}}
			<small style="color:red;" class="btn1" id="{{$u -> id}}">查看全部</small>
		</p>
		

  		<form class="layui-form layui-form-pane" >
  		 {{ csrf_field() }}
			<div class="layui-form-item">
				<label class="layui-form-label">咨询条数</label>
				<div class="layui-input-block">
					<select name="sertype" lay-verify="required">
						<option value="">请选择咨询条数</option>
						@foreach($ser as $serve)
						<option value="{{$serve -> id}}">{{ $serve -> tname }}</option>
						@endforeach
						<input type="hidden" name='zjid' value="{{$u -> id}}"></input>
					</select>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">病历分类</label>
				<div class="layui-input-block" >
					<select name="rw"  lay-verify="required"  lay-filter="renwu">
						<option value="">请选择分类</option>
						@if(empty($rw))
						<option value="0">您还没创建人物信息,请先去创建人物	</option>
						@else
						@foreach($rw as $renwu)
						<option value="{{$renwu -> id}}" >{{$renwu -> cname}}</option>
						@endforeach
						@endif
					</select>
				</div>
			</div>  
			<div class="layui-form-item">
				<label class="layui-form-label">病历选择</label>
				<div class="layui-input-block">
					<select name="bl" lay-verify="required" id='bl'>
						<option value="" >请选择病历</option>
					</select>
				</div>
			</div>   
			<div class="layui-form-item">
				<div class="layui-input-block">
					<button class="layui-btn" lay-submit lay-filter="formDemo" >提交</button>
				</div>
			</div>  
  		</form>


	</div>
	<div class="bottom"></div>

	<script type="text/javascript" src="{{ url('/home/layui/layui.js') }}"></script>
	<script src="{{ url('http://libs.baidu.com/jquery/2.0.0/jquery.min.js') }}"></script>
	<script type="text/javascript">
		layui.use('form',function(){
			var form = layui.form();
			var index = parent.layer.getFrameIndex(window.name);
			// $('.layui-btn').click(function(){

 		// 		parent.layer.close(index);
			// });
			form.on('submit(formDemo)', function(data){
				// console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
				// console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
				// console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
				$.ajax({
			  	url : '/expert/serve',
				async:false,
				type : 'post',
				dataType : 'json',
				data: data.field,
				success : function(res){
							if(res == 0)
							{
								parent.layer.close(index);
								parent.layer.alert('订单已添加,请您尽快支付');
							}else{
								parent.layer.close(index);
								parent.layer.alert('订单可能出了一些小问题,请您重新购买');
							}
						}
				});
				 //阻止表单跳转。如果需要表单跳转，去掉这段即可。	
			});
			form.on('select(renwu)', function(data){
  				var id = data.value;
  				var tableHtm;
			  	$.ajax({
			  	url : '/expert/blxz/'+id,
				async:false,
				type : 'get',
				dataType : 'json',
				success : function(res){
					 if(res)
					 {
					 	
					 	for (var i = 0; i < res.length; i++) {
					 		tableHtm += "<option value="+res[i].id+">"+res[i].dname+"</option>";
					 		$('#bl').html('');
					 		$('#bl').html(tableHtm);
						}
					 }else{
					 		tableHtm = "<option value=''>暂无对应病历,请先去添加</option>";
					 	$('#bl').html(tableHtm);
					 }
					
					form.render();
			  	}
				}); 

			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
		$('.btn1').on('click', function() {
			var id = $(this).attr('id');
			$.ajax({
				url : '/expert/jianjie/'+id,
				async:false,
				type : 'get',
				dataType : 'json',
				success : function(res){
					tableHtml = '简介：'+res.jianjie;
					$('#jianjie').html(tableHtml);
				}
			});
		});
	});
	</script>

</body>
</html>