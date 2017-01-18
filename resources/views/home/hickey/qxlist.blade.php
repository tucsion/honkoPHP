 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='康复社-{{ $qx -> cate }}';
</script>
<link rel="stylesheet" href="{{ url('/home/css/device.css') }}">
<link rel="stylesheet" href="{{ url('/home/css/device_index.css') }}">
<link rel="stylesheet" href="{{ url('/home/css/device_detail.css') }}">
<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
	<!-- 内容区域 -->
	<div id="category" class="container">
		<ul>
		@foreach($hickey as $fl)
			<li
			@if($fl -> id == $id)
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
	<div id="list" class="container">
		<ul class="list">
		
		
		@foreach($qxlist as $qx)
			<li>
				<a href="{{ url('/hickey/detail')}}/{{$qx -> id}}">
					<img src="{{ url('/updates')}}/{{$qx -> img}}" alt="">
					<div class="title">
						<p>型号：{{$qx -> htype}}</p>
						<p>名称：{{$qx -> hname}}</p>
					</div>
				</a>
			</li>
		
		@endforeach
		</ul>
		<!-- 分页 -->
		<div class="page">
			{!! $qxlist -> links() !!}
		</div>
	</div>


@endsection