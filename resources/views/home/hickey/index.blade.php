 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='康复社-康复器械园';
</script>
<link rel="stylesheet" href="{{ url('/home/css/device.css') }}">
<link rel="stylesheet" href="{{ url('/home/css/device_index.css') }}">
<link rel="stylesheet" href="{{ url('/home/css/device_detail.css') }}">
<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
	
	<!-- 内容区域 -->
	<div id="device" class="container">
		<ul>
		@foreach($hickey as $qixie)
			<li>
				<a href="{{ url('/hickey/qxlist')}}/{{$qixie -> id}}">
					<img src="{{ url('/updates')}}/{{$qixie -> img}}" alt="">
					<span class="title">{{ $qixie -> cate }}</span>
				</a>
			</li>
		@endforeach	
		</ul>
	</div>

@endsection