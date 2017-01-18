 @extends('home.layout')
 @section('banner')
  <script type="text/javascript">
    document.title='康复社-购物车';
</script>
@if(session('orderd'))
<script type="text/javascript">
		alert('订单创建失败');
</script>
@endif
<link rel="stylesheet" href="{{ url('/home/css/car.css')}}">
	<!-- 购物车 -->
	<div id="car" class="container">
		<div class="location">
			<img src="{{ url('/home/images/gwc2.gif')}}"/>
		</div>
		
		<div id="car">
			<form class="layui-form" action="/goodscar/myorder" method="post">
			{{ csrf_field() }}
			<!-- 标题 -->
			<table class="layui-table" layui-skin="line">
				<thead>
					<tr>
						<th colspan="6" style="font-size: 20px;text-align: center;color: #FF5722">
							<i class="layui-icon" style="font-size: 20px">&#xe630;</i> 订单信息
						</th>
					</tr>
				</thead>
			</table>
			<!-- 地址管理 -->
			<table class="layui-table address" layui-skin="line">
				<thead>
					<tr>
						<th colspan="6">收货地址</th>
					</tr>
				</thead>
				<tbody>
				@if(!empty($address))
					<tr>
						<th>收货人</th>
						<th>所在地区</th>
						<th>详细地址</th>
						<th>邮编</th>
						<th>电话</th>
						<th>操作</th>
					</tr>
					<tr>
						<td style="display: none;"><input type="text" id ='character_id'  name='dzid'value="{{$address -> id}}"></td>
						<td><input type="text" id ='character_uname' class="num" name='dzid'value="{{$address -> uname}}" disabled=""></td>
						<td><input type="text" id ='character_province' class="num" name='dzid'value="{{$address -> province}}" disabled="">
						<input type="text" id ='character_city' class="num" name='dzid'value="{{$address->city}}" disabled="">
						<input type="text" id ='character_county' class="num" name='dzid'value="{{$address -> county}}" disabled="">
						</td>
						<td><input type="text" id ='character_address' class="num" name='dzid'value="{{$address -> address}}" disabled=""></td>
						<td><input type="text" id ='character_postcode' class="num" name='dzid'value="{{$address -> postcode}}" disabled=""></td>
						<td><input type="text" id ='character_utel' class="num" name='dzid'value="{{$address -> utel}}" disabled=""></td>
						<td>
							<a href="javascript:void(0);" class="layui-btn layui-btn-mini layui-btn-primary addressList"><i class="layui-icon" id="selectAddress">&#xe649;</i> 地址列表</a>
						</td>
					</tr>
				@else
					<tr>
						<td colspan="6" class="no-list">
							<br />
							您还没有添加地址，去<a href="{{ url('/home/user/index')}}#menu=address" class="addAddress">添加</a>
							<br /><br />
						</td>
					</tr>
				@endif
				</tbody>
			</table>
			<!-- 支付 -->
			<table class="layui-table payment" layui-skin="line">
				<thead>
					<tr>
						<th colspan="10">支付方式</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<input type="radio" id="alipay" name="payment" checked="checked" title="支付宝" />
						</td>
					</tr>
				</tbody>
			</table>
			<!-- 发票信息 -->
			<table class="layui-table fapiao" layui-skin="line">
				<thead>
					<tr>
						<th colspan="5">发票信息</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="5">
							<input type="radio" name="fapiao" lay-filter="fapiao" value="否" id="fapiao-no" checked="checked" title="不要发票" />
						</td>
					</tr>
					<tr>
						<td colspan="5">
							<input type="radio" name="fapiao" lay-filter="fapiao" value="是" id="fapiao-yes" title="需要发票" />
							
						</td>
					</tr>
					<tr class="fapiaoList">
						<th style="display: none;"><input type="text" id ='character_id' name='fpid' value=""></th>
						<th>发票信息：</th>
						<td class="fapiao_info_1">
						</td>
						<td class="fapiao_info_2"></td>
						<td class="fapiao_info_3"></td>
						<td>
							<a href="javascript:void(0);" class="layui-btn layui-btn-mini layui-btn-primary fapiaoListBtn" ><i class="layui-icon">&#xe649;</i> 更换</a>
						</td>
					</tr>
					<tr class="noFapiao">
						<td colspan="5" class="no-list">
							<br />
							您还没有发票信息，去<a href="#" class="addFapiao">添加</a>
							<br /><br />
						</td>
					</tr>
				</tbody>
			</table>
			<!-- 商品信息 -->
			<table class="layui-table products" layui-skin="line">
				<colgroup>
					<col>
					<col width="100">
					<col width="100">
					<col width="100">
				</colgroup>
				<thead>
					<tr>
						<th colspan="4">商品信息</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>商品名称</th>
						<th>单价</th>
						<th>数量</th>
						<th>小计</th>
					</tr>
					@foreach($good as $wp)
					<tr>
					<input type="hidden" name='gid[]' value="{{$wp['gid']}}"></input>
						<td>
							<a href="###">
								<img src="{{ url('/updates')}}/{{$wp['img']}}">{{$wp['gname']}}
							</a>
						</td>
						<td>￥{{$wp['price']}}</td>
						<td>{{$wp['number']}}</td>
						<input type="hidden" name='number[]' value="{{$wp['number']}}"></input>
						<td>￥{{$wp['price'] * $wp['number']}}</td>
					</tr>
					@endforeach
					
				</tbody>
			</table>
			<!-- 优惠信息 -->
			<table class="layui-table discount" layui-skin="line">
				<thead>
					<tr>
						<th>优惠信息</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>积分使用</th>
					</tr>
					@if($jf != 0)
					<tr>
						<td>
						<input type="hidden" name='jf' value='{{$jf}}'></input>
							您使用 {{$jf * 1000}}个积分兑换了 {{$jf}} 元

						</td>
					</tr>
					@endif
					@if($jf == 0)
					<tr>
						<td class="no-list">
						<input type="hidden" name='jf' value='0'></input>
							<br />
							您没有选择积分兑换
							<br /><br />
						</td>
					</tr>
					@endif
				</tbody>
			</table>
			<!-- 合计 -->
			<table class="layui-table jiesuan" layui-skin="line">
				<thead>
					<tr>
						<th>结算</th>
					</tr>
				</thead>
				<tr>
					<td align="right">总金额：￥{{$zprice}}</td>
					<input type="hidden" name='zj' value='{{$zprice}}' ></input>
				</tr>
				<tr>
					<td align="right">
						<a href="{{ url('/goodscar/car')}}" class="layui-btn layui-btn-primary">返回修改</a>
						<button class="layui-btn layui-btn-danger">提交订单</button>
					</td>
				</tr>
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
	
	<script type="text/javascript" src="{{ url('/home/js/car2.js')}}"></script>

@endsection