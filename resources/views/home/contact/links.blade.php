 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='康复社-友情链接';
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
  @foreach($link as $links)
    <li>
        <a href="{{$links -> yqlink}}" target="_blank">
        <p style="text-align: center;">{{$links -> yqname}}</p>
        <img src="{{url('/updates')}}/{{$links -> yqpic}}" style="width:200px;height: 100px;"></a>
    </li>
   @endforeach
  </ul>
  </div>


	

@endsection