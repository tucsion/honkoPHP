@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-地址列表';
    
</script>
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>

<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">
	<!-- 内容区域 -->
@if(session('editadd'))
<script type="text/javascript">
		alert('地址添加成功');
</script>
@endif
@if(session('editad'))
<script type="text/javascript">
		alert('地址添加失败');
</script>
@endif
@if(session('deleteadd'))
<script type="text/javascript">
		alert('地址删除成功');
</script>
@endif

<div class="address">
	<div class="headTitle">地址管理</div>
	<div class="content">
		<p class="tishi">温馨提示：这里的地址为购买商品邮寄地址</p>
		<div class="layui-tab">
			<ul class="layui-tab-title">
				<li class="layui-this">地址列表</li>
				<li>新增地址</li>
			</ul>
			<div class="layui-tab-content">
				<!-- 地址列表 -->
				<div class="layui-tab-item layui-show">
					<table class="layui-table" lay-skin="line">
						<thead>
							<tr>
								<th>收货人</th>
								<th>所在地区</th>
								<th>详细地址</th>
								<th>邮编</th>
								<th>电话/手机</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
						@if(empty($add))
							<tr>
								<td>
								暂无地址
								</td>
							</tr>
						@elseif(!empty($add))
						@foreach ($add as $address)
							<tr>
								<td>{{$address -> uname}}</td>
								<td>{{$address -> province}} {{$address -> city}} {{$address -> county}}</td>
								<td>{{$address -> address}}</td>
								<td>{{$address -> postcode}}</td>
								<td>{{$address -> utel}}</td>
								<td>
									<a href="javascript:void(0);" filterID='10' class="editBtn" id="{{ $address -> id}}">修改</a> | 
									<a href="{{url('/home/user/deleteadd')}}/{{$address -> id}}">删除</a>
								</td>
							</tr>
						@endforeach	
						@endif
						</tbody>
					</table>
				</div>
				<!-- 新增收货地址 -->
				<div class="layui-tab-item">
					<form action="{{ url('/home/user/editadd')}}" class="layui-form" method="post">
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
								<textarea placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码，楼层和房间号等信息" class="layui-textarea" name='address' lay-verify="required"></textarea>
							</div>
						</div>
						<!-- 邮编 -->
						<div class="layui-form-item">
							<label class="layui-form-label">邮政编码</label>
							<div class="layui-input-block w50">
								<input type="text" lay-verify="number"  name ="postcode" placeholder="如您不清楚邮递区号，请填写000000" class="layui-input">
							</div>
						</div>
						<!-- 姓名 -->
						<div class="layui-form-item">
							<label class="layui-form-label">收货人姓名</label>
							<div class="layui-input-inline">
								<input type="text" lay-verify="required name" placeholder="长度2-25个字符" name="uname" class="layui-input">
							</div>
						</div>
						<!-- 手机 -->
						<div class="layui-form-item">
							<label class="layui-form-label">手机</label>
							<div class="layui-input-inline">
								<input type="text" required  lay-verify="phone" placeholder="请填写11位手机号" name="utel" class="layui-input">
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
								<button class="layui-btn" lay-submit lay-filter="formDemo">保存</button>
							</div>
						</div>
					</form>
				</div>
				<!-- 分页 -->
				<div class="page">
						{!! $add->links() !!}
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="{{url('/home/js/area2.js')}}"></script>
<script type="text/javascript" src="{{url('/home/js/getArea.js')}}"></script>
<script type="text/javascript">
	layui.use(['form'],function(){
		var form = layui.form();
		form.render();
		form.verify({
			name:[
				/^[\S]{2,25}$/,
				'姓名长度必须在2-25之间，且不能出现空格'
			] 
		});
	});
	//修改
	// layer.open({
	//   type: 2,
	//   area: ['700px', '530px'],
	//   fixed: false, //不固定
	//   maxmin: true,
	//   content: '/home/user/snat'
	// });
	$('.editBtn').on('click', function() {
		var id = $(this).attr('id');
	  layer.open({
	  	type: 2,
	  	title : '地址修改',
	  	shade : [0.3,'#000'],
	  	shadeClose : false,
	  	scrollbar : false,
	  	area: ['893px', '500px'],
	    content: '/home/user/snat/'+id, //注意，如果str是object，那么需要字符拼接
	  });
	  form.render();
		
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
</div>
</div>
@endsection