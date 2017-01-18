@extends('home.layer')
@section('center')
<script type="text/javascript">
    document.title='康复社-会员中心-发票管理';
    
</script>
<style>
    {{ date_default_timezone_set('PRC') }} 
</style>
@if(session('addbill'))
	<script type="text/javascript">
		alert('发票信息添加成功');
	</script>
@endif
@if(session('addbilld'))
	<script type="text/javascript">
		alert('添加发票信息失败');
	</script>
@endif
@if(session('deletebill'))
	<script type="text/javascript">
		alert('发票信息删除成功');
	</script>
@endif
<script src=" {{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<link rel="stylesheet" href="{{ url('/home/css/member.css') }}">

<div class="address">
	<div class="headTitle">发票管理</div>
	<div class="content">
		<p class="tishi">温馨提示：这里的发票为购买商品邮寄发票</p>
		<div class="layui-tab">
			<ul class="layui-tab-title">
				<li class="layui-this">发票列表</li>
				<li>新增发票</li>
			</ul>
			<div class="layui-tab-content">
				<!-- 地址列表 -->
				<div class="layui-tab-item layui-show">
					<table class="layui-table" lay-skin="line">
						<thead>
							<tr>
								<th>抬头</th>
								<th>发票类型</th>
								<th>发票项目</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
						@if(empty($bill))
							<tr>
								<td>
								暂无发票信息
								</td>
							</tr>
						@elseif(!empty($bill))
						@foreach ($bill as $fp)
							<tr>
								<td>{{$fp -> depict}}</td>
								<td>@if($fp -> billtype == 0)
								普通发票
								@endif</td>
								<td>@if($fp -> billitem == 0)
								医疗器械
								@endif</td>
								<td>
									<a href="javascript:void(0);" filterID='10' class="editBtn" id="{{ $fp -> id}}">修改</a> | 
									<a href="{{url('/home/user/deletebill')}}/{{$fp -> id}}">删除</a>
								</td>
							</tr>
						@endforeach	
						@endif
						</tbody>
					</table>
				</div>
				<!-- 新增收货地址 -->
				<div class="layui-tab-item">
					<form action="{{ url('/home/user/addbill')}}" class="layui-form" method="post">
					{{ csrf_field() }}
						<div class="layui-form-item layui-form-text">
							<label class="layui-form-label">发票抬头</label>
							<div class="layui-input-block">
								<input type="text" lay-verify=""  name ="depict" placeholder="请填写真实的发票抬头" class="layui-input">
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
								<input type="text" required  lay-verify="" placeholder="请填写收件人姓名" name="receiver" class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">电话</label>
							<div class="layui-input-inline">
								<input type="text" required  lay-verify="phone" placeholder="请填写收件人联系电话" name="phone" class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<label class="layui-form-label">地址</label>
							<div class="layui-input-inline">
								<input type="text" required  lay-verify="" placeholder="请填写收件人地址" name="address" class="layui-input">
							</div>
						</div>
						<div class="layui-form-item">
							<div class="layui-input-block">
								<button class="layui-btn" lay-submit lay-filter="formDemo">保存</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- 分页 -->
			<div class="page">
					{!! $bill->links() !!}
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
	  	title : '发票信息修改',
	  	shade : [0.3,'#000'],
	  	shadeClose : false,
	  	scrollbar : false,
	  	area: ['893px', '500px'],
	    content: '/home/user/editbill/'+id, //注意，如果str是object，那么需要字符拼接
	  });
	  form.render();
		
	});

</script>
@endsection