 @extends('home.layout')
 @section('banner')
  <script type="text/javascript">
    document.title='康复社-购物车';
</script>
<link rel="stylesheet" href="{{ url('/home/css/car.css')}}">
@if(session('goodsqrd'))
<script type="text/javascript">
		alert('未选择商品,订单生成失败');
</script>
@endif
@if(session('orderd'))
<script type="text/javascript">
		alert('订单创建失败,请重试');
</script>
@endif
	<!-- 购物车 -->
	<div id="car" class="container">
		<div class="location">
			<img src="{{ url('/home/images/gwc1.gif')}}"/>
		</div>
		
		<div class="car">
			<form action="{{ url('/goodscar/carqr')}}" method="post">
			{{ csrf_field() }}
			<table class="layui-table" lay-skin="line">
				<colgroup>
					<col width="100">
					<col>
					<col width="130">
					<col width="190">
					<col width="130">
					<col width="100">
				</colgroup>
				<thead>
					<tr>
						<th><label for="checkAll"><input type="checkbox" id="checkAll"> 全选</label></th>
						<th>商品</th>
						<th>单价</th>
						<th>数量</th>
						<th>小计</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
				@foreach($car as $goodscar) 
					<tr>
						<td>
							<input type="checkbox" class="checkOne" name='xuanze[] value={{$goodscar -> id}}'>
							<input type="hidden" name="proId[]"  value="{{$goodscar -> id}}">
						</td>
						<td>
							<a href="###">
								<img src="{{ url('/updates') }}/{{$goodscar -> img}}" style="width:150px;height:150px;">{{$goodscar -> gname}}
							</a>
						</td>
						<td>￥<input type="text" disabled class="num danjia" value="{{$goodscar -> price}}"></td>
						<td>
							<a href="javascript:void(0);" class="min layui-btn layui-btn-disabled layui-btn-mini layui-btn-primary"><i class="layui-icon">&#xe61a;</i></a> 
							<input class="num proNum" name="proNum[]" type="text" value="{{$goodscar -> number}}" />  
							<a href="javascript:void(0);" class="add layui-btn layui-btn-mini layui-btn-primary"><i class="layui-icon">&#xe619;</i></a> 
						</td>
						<td>￥<input type="text" value="{{$goodscar -> price}}" disabled class="num xiaoji" name='xiaoji'></td>
						<td><a href="javascript:void(0);" class="delBtn" characterId="{{$goodscar -> id }}"><i class="layui-icon">&#xe640;</i> 删除</a></td>
					@endforeach
					<tr>
						<td colspan="4">
							<input type="checkbox" id="jifen">
							可用积分：<span class="num jifen">{{$jf}}</span>
							(<span class="num jifen_guize">1000</span>积分=1元), 
							本订单最大抵扣金额： <span class="num jifen_money">0</span>
						</td>
						<td colspan="2">合计：￥<input type="text" name='heji' disabled class="num heji" value=""></td>
					</tr>
					<tr style="display: none;">
						<td colspan="6" align="right">
							积分兑换：<input type="text" name='jf' class="num jifen_money2" value="0" />
						</td>
					</tr>
					<tr>
						<td colspan="6" align="right">
							<span>实际支付：￥<input type="text" disabled class="num" id="total" value="0" name='zprice'></span>
							
							<button class="layui-btn layui-btn-danger">结算</button>
						</td>
					</tr>
				</tbody>
			</table>
			</form>
		</div>
		
	</div>

	<script src="{{url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{ url('/home/layui/layui.js') }}"></script>
	<script type="text/javascript">
		layui.use(['element','layer'],function(){
			var layer = layui.layer;
		});	
		//微信
		$('#weixin').on('mouseover', function() {
			layer.tips('<img src="images/erwm.jpeg">', '#weixin', {
				tips: [1, '#78BA32'],
				time : 50000
			});
		}).mouseout(function() {
			layer.closeAll('tips'); //关闭所有的tips层
		});
		//QuickBar
		$(function(){
			var bar = $('#quickBar'),winH = $(window).height(),barTop = '';
			barTop = (winH - bar.height())/2;
			bar.css('top', barTop);
			$(window).resize(function() {
				var bar = $('#quickBar'),winH = $(window).height(),barTop = '';
				barTop = (winH - bar.height())/2;
				bar.css('top', barTop);
			});
			//电话
			$('#quickTel').on('mouseenter', function() {
				layer.tips('<b style="font-size:20px">电话：400 333 6691</b>', '#quickTel', {
					tips: [4, '#78BA32'],
					time : 50000
				});
			}).mouseleave(function() {
				layer.closeAll('tips'); //关闭所有的tips层  
			});
		});
	</script>

	<!-- 购物车 -->
	<script type="text/javascript" src="{{ url('/home/js/car.js')}}"></script>

@endsection