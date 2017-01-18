 @extends('home.layout')
 @section('banner')
<script type="text/javascript">
    document.title='康复社-首页搜索';
</script>

<style>
    {{ date_default_timezone_set('PRC') }} 
</style> 
<link rel="stylesheet" href="{{ url('/home/css/shared.css') }}">
<link rel="stylesheet" href="{{ url('/home/css/style.css') }}">
	

  <div class="map_body">

</div><div class="daod">当前位置：<a href="index.php">首页</a> > 搜索</div>

<div class="sscont">

            
<table width="100%" border="0" cellpadding="0" cellspacing="6">
              <tr>
                <td>系统搜索到约有<strong style="color:#F00">21</strong>项符合<strong style="color:#F00">培训</strong>的查询结果</td>
              </tr>
</table>
</div>
  </div>


	

@endsection