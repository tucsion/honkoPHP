 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='康复社-{{ $xq -> hname }}';
</script>

<link rel="stylesheet" href="{{ url('/home/css/device_detail2.css') }}">
<link rel="stylesheet" href="{{ url('/home/css/shop_detail.css') }}">
<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
@if(session('purch'))
<script type="text/javascript">
		alert('采购成功');
</script>
@endif
	<!-- 内容区域 -->
	<div id="category" class="container">
		<ul>
			@foreach($hickey as $fl)
			<li
			@if($xq -> cid == $fl -> id)
			class="active"
			@endif
			>
				<a href="{{ url('/hickey/qxlist')}}/{{$fl -> id}}">
					<img src="{{ url('/updates')}}/{{$fl -> img}}" alt="{{$fl -> cate}}" title="{{$fl -> cate}}">
					<span class="title">{{$fl -> cate}}</span>
				</a>
			</li>
		@endforeach	
			
		</ul>
	</div>
	<!-- 位置导航 -->
	<div class="location container">
		<span class="layui-breadcrumb">
			<a href="{{ url('http://hkyl.com')}}">首页</a>
			<a href="{{ url('/hickey/qxlist')}}/{{$flei -> id}}">{{$flei -> cate}}</a>
			<a><cite>{{ $xq -> hname}}</cite></a>
		</span>
	</div>
	<!-- 产品详情 -->
	<div id="content" class="container">
		<div class="top">
			<!-- 相册 -->
			<div class="album">
				<div class="preview">
					<div id="vertical" class="bigImg">
						<img src="{{ url('/updates')}}/{{$xq -> img}}" width="286" height="286" alt="" id="midimg" />
						<div style="display:none;" id="winSelector"></div>
					</div><!--bigImg end-->	
					<div class="smallImg">
						<div class="scrollbutton smallImgUp disabled"></div>
						<div id="imageMenu">
							<ul>
								
								<li id="onlickImg"><img src="{{ url('/updates')}}/{{$xq -> img}}"  alt=""/></li>
								
							</ul>
						</div>
						<div class="scrollbutton smallImgDown"></div>
					</div><!--smallImg end-->	
					<div id="bigView" style="display:none;"><img width="800" height="800" alt="" src="" /></div>
				</div>
			</div>
			<!-- 摘要 -->
			<div class="tags">
				<p class="title">{{$xq -> hname}}</p>
				<p class="attr"><span>产品编号：</span>{{ $xq -> hnum }}</p>
				<p class="attr"><span>产品名称：</span>{{ $xq -> hname}}</p>
				<p class="attr"><span>品牌：</span>{{ $xq -> brand }}</p>                   
				<p class="attr"><span>分类：</span>{{ $fenlei -> name  }}</p>                      
				<p class="attr"><span>产地：</span>{{ $xq -> field }}</p>
				<p class="attr"><span>产品型号：</span>{{ $xq -> htype}}</p>             
				<p class="attr"><span>毛重：</span>{{$xq -> kg}}</p>
				<hr>
				
				@if(empty(session('user')) or session('user') -> utp != '3')

				@elseif(session('user') -> utp == '3')
				<form class="layui-form" action="/purch/caigou" method="post">
				{{ csrf_field() }}
				<div class="layui-form-item">
						<label class="layui-form-label">数量：</label>
						<div class="layui-form-mid layui-word-aux">
							<i class="transition" id="downBtn">-</i>
						</div>
						<div class="layui-input-inline">
							<input type="text" name="number" id="number" required lay-verify="number" value="1" class="layui-input">
							<input type='hidden' name='gid' value="{{$xq -> id}}"></input>
						</div>
						<div class="layui-form-mid layui-word-aux">
							<i class="transition" id="upBtn">+</i>
						</div>
						<div class="layui-inline">
							<label class="shoucang">
								<a href="{{ url('/expert/goodsc')}}/{{$xq -> id}}"><i class="layui-icon">&#xe600;</i> 加入收藏</a>
							</label>
							
						</div>
					</div>
					<div class="layui-form-item">
						<div class="layui-input-block">

						<input type="hidden" name='gid' value='{{ $xq -> id }}'></input>
							<button class="layui-btn layui-btn-big layui-btn-danger"><i class="layui-icon">&#xe608;</i> 加入采购单</button>
						</div>
					</div>
				</form>
				@endif
			</div>
		</div>
		<!-- tab切换 -->
		<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
			<ul class="layui-tab-title">
				<li class="layui-this">详细信息</li>
				<li>产品参数</li>
			</ul>
			<div class="layui-tab-content">
				<!-- 详细信息 -->
				<div class="layui-tab-item layui-show">
					{!! $xq -> news !!}
				</div>
				<!-- 产品参数 -->
				<div class="layui-tab-item">
					<table style="border-spacing: 1px;width: 1128px;padding:30px 0px;">
						<tbody>
							<tr style="background-color: #f7f7f7;font-size: 14px;text-align: center;height: 44px;line-height: 44px; border-spacing: 1px;"><td style=" border-spacing: 1px;">产品参数</td></tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							@if(empty($xq -> brand))
							品牌：暂无
							@elseif(!empty($xq -> brand))
							品牌：{{$xq -> brand}}
							@endif
							</td>
							<td>
							@if(empty($xq -> measure))
							展开尺寸：暂无
							@elseif(!empty($xq -> measure))
							展开尺寸：{{$xq -> measure}}
							@endif
							</td>
							</tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							@if(empty($xq -> field))
							产地：暂无
							@elseif(!empty($xq -> field))
							产地：{{$xq -> field}}
							@endif
							</td>
							<td>
							@if(empty($xq -> size))
							纸箱尺寸：暂无
							@elseif(!empty($xq -> size))
							纸箱尺寸：{{$xq -> size}}
							@endif
							</td>
							</tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							@if(empty($xq -> htype))
							产品型号：暂无
							@elseif(!empty($xq -> htype))
							产品型号：{{$xq -> htype}}
							@endif
							</td>
							<td>
							@if(empty($xq -> timing))
							计时范围：暂无
							@elseif(!empty($xq -> timing))
							计时范围：{{$xq -> timing}}分
							@endif
							</td>
							</tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							@if(empty($xq -> kg))
							毛重：暂无
							@elseif(!empty($xq -> kg))
							毛重：{{$xq -> kg}}KG
							@endif
							</td>
							<td>
							@if(empty($xq -> gaping))
							距离范围：暂无
							@elseif(!empty($xq -> gaping))
							距离范围：{{$xq -> gaping}}KM
							@endif
							</td>
							</tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							@if(empty($xq -> net))
							净重：暂无
							@elseif(!empty($xq -> net))
							净重：{{$xq -> net}}KG
							@endif
							</td>
							<td>
							@if(empty($xq -> heating))
							热量范围：暂无
							@elseif(!empty($xq -> heating))
							热量范围：{{$xq -> heating}}KCAL
							@endif
							</td>
							</tr>
						</tbody>
						</table>
					@if(empty(session('user')) or session('user') -> utp == '1')
						<table style="border-spacing: 1px;width: 1128px;padding:30px 0px;">
						<tbody>
						
							<tr style="background-color: #f7f7f7;font-size: 14px;text-align: center;height: 44px;line-height: 44px; border-spacing: 1px;"><td style=" border-spacing: 1px;">生产厂家</td></tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							权限不足无法查看
							</td>
							<td>
						</table>
					@elseif(session('user') -> utp == '2'  or session('user') -> utp == '3')
					@if(empty($vender))
						<table style="border-spacing: 1px;width: 1128px;padding:30px 0px;">
						<tbody>
						
							<tr style="background-color: #f7f7f7;font-size: 14px;text-align: center;height: 44px;line-height: 44px; border-spacing: 1px;"><td style=" border-spacing: 1px;">生产厂家</td></tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							暂无
							</td>
							<td>
						</table>
					@elseif(!empty($vender))
						<table style="border-spacing: 1px;width: 1128px;padding:30px 0px;">
						<tbody>
							<tr style="background-color: #f7f7f7;font-size: 14px;text-align: center;height: 44px;line-height: 44px; border-spacing: 1px;"><td style=" border-spacing: 1px;">生产厂家</td></tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							@if(empty($vender -> name))
							厂家名称：暂无
							@elseif(!empty($vender -> name))
							厂家名称：{{$vender -> name}}
							@endif
							</td>
							<td>
							@if(empty($vender -> url))
							网址：暂无
							@elseif(!empty($vender -> url))
							网址：{{$vender -> url}}
							@endif
							</td>
							</tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							@if(empty($vender -> email))
							邮箱：暂无
							@elseif(!empty($vender -> email))
							邮箱：{{$vender -> email}}
							@endif
							</td>
							<td>
							@if(empty($vender -> linkman))
							联系人：暂无
							@elseif(!empty($vender -> linkman))
							联系人：{{$vender -> linkman}}
							@endif
							</td>
							</tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							@if(empty($vender -> phone))
							电话：暂无
							@elseif(!empty($vender -> phone))
							电话：{{$vender -> phone}}
							@endif
							</td>
							<td>
							@if(empty($vender -> fax))
							传真：暂无
							@elseif(!empty($vender -> fax))
							传真：{{$vender -> fax}}
							@endif
							</td>
							</tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							@if(empty($vender -> service))
							维修人：暂无
							@elseif(!empty($vender -> service))
							维修人：{{$vender -> service}}
							@endif
							</td>
							<td>
							@if(empty($vender -> serphone))
							维修人联系电话：暂无
							@elseif(!empty($vender -> serphone))
							维修人联系电话：{{$vender -> serphone}}
							@endif
							</td>
							</tr>
						</tbody>	
					</table>
				@endif
				@endif
				@if(empty(session('user')) or session('user') -> utp == '1')
						<table style="border-spacing: 1px;width: 1128px;padding:30px 0px;">
						<tbody>
						
							<tr style="background-color: #f7f7f7;font-size: 14px;text-align: center;height: 44px;line-height: 44px; border-spacing: 1px;"><td style=" border-spacing: 1px;">代理商</td></tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							权限不足无法查看
							</td>
							<td>
						</table>
				@elseif(session('user') -> utp == '2'  or session('user') -> utp == '3')
				@if(empty($agent))
						<table style="border-spacing: 1px;width: 1128px;padding:30px 0px;">
						<tbody>
						
							<tr style="background-color: #f7f7f7;font-size: 14px;text-align: center;height: 44px;line-height: 44px; border-spacing: 1px;"><td style=" border-spacing: 1px;">代理商</td></tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							暂无
							</td>
							<td>
						</table>
					@elseif(!empty($agent))
						<table style="border-spacing: 1px;width: 1128px;padding:30px 0px;">
						<tbody>
							<tr style="background-color: #f7f7f7;font-size: 14px;text-align: center;height: 44px;line-height: 44px; border-spacing: 1px;"><td style=" border-spacing: 1px;">代理商</td></tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							@if(empty($agent -> name))
							代理公司名称：暂无
							@elseif(!empty($agent -> name))
							代理公司名称：{{$agent -> name}}
							@endif
							</td>
							<td>
							@if(empty($agent -> address))
							地址：暂无
							@elseif(!empty($agent -> address))
							地址：{{$agent -> address}}
							@endif
							</td>
							</tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							@if(empty($agent -> link))
							网址：暂无
							@elseif(!empty($agent -> link))
							网址：{{$agent -> link}}
							@endif
							</td>
							<td>
							@if(empty($agent -> email))
							邮箱：暂无
							@elseif(!empty($agent -> email))
							邮箱：{{$agent -> email}}
							@endif
							</td>
							</tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							@if(empty($agent -> phone))
							电话：暂无
							@elseif(!empty($agent -> phone))
							电话：{{$agent -> phone}}
							@endif
							</td>
							<td>
							@if(empty($agent -> fax))
							传真：暂无
							@elseif(!empty($agent -> fax))
							传真：{{$agent -> fax}}
							@endif
							</td>
							</tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							<td>
							@if(empty($agent -> linkman))
							联系人：暂无
							@elseif(!empty($agent -> linkman))
							联系人：{{$agent -> linkman}}
							@endif
							</td>
							</tr>
						</tbody>	
					</table>
				@endif
				@endif
				@if(empty(session('user')) or session('user') -> utp == '1')
						<table style="border-spacing: 1px;width: 1128px;padding:30px 0px;">
						<tbody>
							<tr style="background-color: #f7f7f7;font-size: 14px;text-align: center;height: 44px;line-height: 44px; border-spacing: 1px;"><td style=" border-spacing: 1px;">其他参数</td></tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">	
							<td>
							权限不足无法查看
							</td>
							</tr>
						</tbody>
						</table>
				@elseif(session('user') -> utp == '2'  or session('user') -> utp == '3')
						<table style="border-spacing: 1px;width: 1128px;padding:30px 0px;">
						<tbody>
						
							<tr style="background-color: #f7f7f7;font-size: 14px;text-align: center;height: 44px;line-height: 44px; border-spacing: 1px;"><td style=" border-spacing: 1px;">其他参数</td></tr>
							<tr style="font-size: 14px;height: 44px;line-height: 44px; border-spacing: 1px;padding-left: 32px;">
							
							<td>
							@if(empty($xq -> expend))
							易耗品：暂无
							@elseif(!empty($xq -> expend))
							易耗品：{{$xq -> expend}}
							@endif
							</td>
							<td>
							@if(empty($xq -> tollnum))
							收费编号：暂无
							@elseif(!empty($xq -> tollnum))
							收费编号：{{$xq -> tollnum}}
							@endif
							</td>
							</tr>
						</tbody>
						</table>
				@endif
				</div>
			</div>
		</div>
	</div>
<script src="{{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/home/js/image.zoom.js') }}"></script>
<script type="text/javascript">
		$(document).ready(function() {
			$('i#upBtn').on('click', function() {
				var num = parseInt($('#number').val());
				num++;
				$('#number').val(num);
			});
			$('i#downBtn').on('click', function() {
				var num = parseInt($('#number').val());
				num--;
				if (num <= 1) num = 1;
				$('#number').val(num);
			});
		});
</script>
@endsection