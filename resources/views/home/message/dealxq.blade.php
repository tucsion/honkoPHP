<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
<div style="padding: 30px;line-height: 25px;color: #666;padding-top: 10px">
	<p style="font-size: 16px;color: #333;line-height: 40px">
		<span style="font-size: 14px;">订单编号：
		@if(substr( $xq -> number, 0, 1 ) == 'G')
		<a href="{{ url('/order/goodsxq')}}/{{$xq -> orderid}}" id="dingdan">{{$xq -> number}}</a>
		@endif
		@if(substr( $xq -> number, 0, 1 ) == 'Z' or substr( $xq -> number, 0, 1 ) == 'X')
		<a href="{{ url('/order/servexq')}}/{{$xq -> orderid}}" id="dingdan">{{$xq -> number}}</a>
		@endif
		</span>
		<span style="font-size: 12px;color: #999;">{{date('Y-m-d H:i:s',$xq ->newstime)}}</span>
	</p>
	<p class="content">
		{{$xq -> news}}
	</p>
</div>