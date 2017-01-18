 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='康复社-网站地图';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
<link rel="stylesheet" href="{{ url('/home/css/shared.css') }}">
<link rel="stylesheet" href="{{ url('/home/css/style.css') }}">
	
	<!-- banner -->
	<div class="banners" style="background-image:url('{{url('/updates/')}}/{{$banner -> img}}')"></div>


  <div class="map_body">
  <ul>
    <li>
      <h3><a href="{{ url('/expert/index') }}">专家团队</a></h3>
      		@foreach($expert as $expertd)
                 <p><a href="{{ url('/expert/zjlist') }}/zc={{$expertd -> id}}">{{ $expertd -> cate }}</a> </p>
            @endforeach
    </li>
    <li>
      <h3><a href="{{ url('/train/index') }}/{{$jiaoyu -> id}}">研究与培训</a></h3>
      		@foreach($train as $traind)
		     	<p><a href="{{ url('/train/index') }}/{{$traind -> id}}">{{ $traind -> cate }}</a></p>
		    @endforeach
	</li>
    <li>
      <h3><a href="{{ url('/health/index') }}/{{$yangsheng -> id}}">养生养老</a></h3>
      		@foreach($ys as $es)
	           	<p><a href="{{ url('/health/index') }}/{{$es -> id}}">{{ $es -> cate }}</a></p>
	        @endforeach
    </li>
    <li>
      <h3><a href="{{ url('/hickey/index') }}">康复器械园</a></h3>
			@foreach($hickey as $hick)
	          	<p><a href="{{ url('/hickey/qxlist')}}/{{$hick -> id}}">{{ $hick -> cate }}</a></p>
	        @endforeach       
    </li>
    <li>
      <h3><a href="{{ url('/procure/index') }}/{{$qiye -> id}}">企业采购</a></h3>
      		@foreach($procure as $procured)
		        <p><a href="{{ url('/procure/index') }}/{{$procured -> id}}">{{ $procured -> cate }}</a></p>
		    @endforeach
    </li>
    <li><h3><a href="{{ url('/store/index') }}">网上商城</a></h3>
    		@foreach($goods as $goodsd)
         		<p><a href="{{ url('/store/goodlist') }}/sort={{ $goodsd -> id }}">{{ $goodsd -> cate }}</a> </p>
         	@endforeach        
    </li>
    <li><h3><a href="{{ url('/info/index') }}/{{$huiyi -> id}}">康复资讯</a></h3>
    		@foreach($health as $healthd)
         		<p><a href="{{ url('/info/index') }}/{{$healthd -> id}}">{{ $healthd -> cate }}</a> </p>
         	@endforeach 
    </li>
    <li><h3><a href="{{ url('/contact/index') }}/{{$lianxius -> id}}">联系我们</a></h3>
    		@foreach($lianxi as $lianxis)
      			<p><a href="{{ url('/contact/index') }}/{{$lianxis -> id}}">{{$lianxis -> cate}}</a></p>
      		@endforeach
    </li>
     <li style="width:80px;"><h3><a href="{{ url('/contact/maps')}}">网站地图</a></h3>
     <p><h3><a href="{{ url('/contact/links')}}">友情链接</a></h3></p>
     </li>        
    <div style="clear:both"></div>
  </ul>
  </div>


	

@endsection