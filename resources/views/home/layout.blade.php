<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>康复社-首页</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    
    <link rel="stylesheet" type="text/css" href="{{ url('/home/layui/css/layui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/home/css/common.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/home/css/index.css') }}">
    
    <script src="{{ url('http://libs.baidu.com/jquery/1.8.0/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/home/layui/layui.js')}}"></script>
    <script type="text/javascript">
        layui.use('element');
        
    </script>

    
    
   

</head>
<body>
@if(session('sskong'))
<script type="text/javascript">
        alert('请输入关键字搜索');
</script>
@endif
    <!-- 头部 -->
    <div id="head">
        <div class="top">
            <h1><a href="#"><img src="{{ url('/updates')}}/{{$set -> logo1}}" alt=""></a></h1>
            <div class="topMember">
            @if(session('user'))
            <a id="memberIndex" href ="{{ url('/home/user/index')}}">会员中心</a>
            @else
                <a href="{{ url('/home/login')}}">登录</a> | 
                <a href="#">注册</a>
            @endif
            </div>
            <div id="search">
                <form action="{{ url('/home/find')}}" method="post">
                {{ csrf_field() }}
                    <input type="text" name="find" value="">
                    <div class="btn">
                        <i class="layui-icon"><button>&#xe615;</button></i>
                    </div>
                </form>
            </div>
        </div>
        <!-- 导航 -->
        <div id="nav">
            <ul class="layui-nav container" lay-filter="">


                <li  
                @if($xuanzhe == 1)
                 class="layui-nav-item layui-this" 
                @elseif($xuanzhe != 1)
                  class= "layui-nav-item" 
                @endif
                >
                    <a href="{{ url('/')}}">首页</a>
                </li>
                <li 
                @if($xuanzhe == 2)
                 class="layui-nav-item layui-this" 
                @elseif($xuanzhe != 2)
                  class= "layui-nav-item" 
                @endif
                >
                    <a href="{{ url('/expert/index') }}">专家团队</a>
                    <dl class="layui-nav-child">
                    @foreach($expert as $experts)
                        <dd><a href="{{ url('/expert/zjlist') }}/zc={{$experts -> id}}">{{ $experts -> cate }}</a></dd>
                    @endforeach 
                    </dl>
                </li>
                <li 
                @if($xuanzhe == 3)
                 class="layui-nav-item layui-this" 
                @elseif($xuanzhe != 3)
                  class= "layui-nav-item" 
                @endif>
                    <a href="{{ url('/train/index') }}/{{$jiaoyu -> id}}">教育与培训</a>
                    <dl class="layui-nav-child">
                    @foreach($train as $trains)
                        <dd><a href="{{ url('/train/index') }}/{{$trains -> id}}">{{ $trains -> cate }}</a></dd>
                    @endforeach 
                    </dl>
                </li>
                <li 
                @if($xuanzhe == 4)
                 class="layui-nav-item layui-this" 
                @elseif($xuanzhe != 4)
                  class= "layui-nav-item" 
                @endif>
                    <a href="{{ url('/health/index') }}/{{$yangsheng -> id}}">养生养老</a>
                    <dl class="layui-nav-child">
                    @foreach($ys as $res)
                        <dd><a href="{{ url('/health/index') }}/{{$res -> id}}">{{ $res -> cate }}</a></dd>
                    @endforeach 
                    </dl>
                </li>
                <li 
                @if($xuanzhe == 5)
                 class="layui-nav-item layui-this" 
                @elseif($xuanzhe != 5)
                  class= "layui-nav-item" 
                @endif>
                    <a href="{{ url('/hickey/index') }}">康复器械园</a>
                    <dl class="layui-nav-child">
                    @foreach($hickey as $h)
                        <dd><a href="{{ url('/hickey/qxlist')}}/{{$h -> id}}">{{ $h -> cate }}</a></dd>
                    @endforeach 
                    </dl>
                </li>
                <li
                @if($xuanzhe == 6)
                 class="layui-nav-item layui-this" 
                @elseif($xuanzhe != 6)
                  class= "layui-nav-item" 
                @endif>
                    <a href="{{ url('/procure/index') }}/{{$qiye -> id}}">企业采购</a>
                    <dl class="layui-nav-child">
                    @foreach($procure as $procures)
                        <dd><a href="{{ url('/procure/index') }}/{{$procures -> id}}">{{ $procures -> cate }}</a></dd>
                    @endforeach 
                    </dl>
                </li>
                <li  
                @if($xuanzhe == 7)
                class="layui-nav-item layui-this" 
                @elseif($xuanzhe != 7)
                  class= "layui-nav-item" 
                @endif>
                    <a href="{{ url('/store/index') }}">网上商城</a>
                    <dl class="layui-nav-child">
                    @foreach($goods as $goodss)
                        <dd><a href="{{ url('/store/goodlist') }}/sort={{ $goodss -> id }}">{{ $goodss -> cate }}</a></dd>
                    @endforeach 
                    </dl>
                </li>
                <li  
                @if($xuanzhe == 8)
                    class="layui-nav-item layui-this" 
                @elseif($xuanzhe != 8)
                    class= "layui-nav-item" 
                @endif>
                    <a href="{{ url('/info/index') }}/{{$huiyi -> id}}">康复资讯</a>
                    <dl class="layui-nav-child">
                    @foreach($health as $healths)
                        <dd><a href="{{ url('/info/index') }}/{{$healths -> id}}">{{ $healths -> cate }}</a></dd>
                    @endforeach 
                    </dl>
                </li>
            </ul>
        </div>
    </div>

@yield('banner')

    <div id="footer">
        <div class="footer">
            <div class="box1">
                <ul>
                    <li><a href="{{ url('/contact/maps')}}">网站地图</a></li>
                    <li><a href="{{ url('/contact/index')}}/68">法律声明</a></li>
                    <li><a href="{{ url('/contact/links')}}">友情链接</a></li>
                    <li><a href="{{ url('/contact/index')}}/62">康复中心</a></li>
                    <li><a href="{{ url('/contact/index')}}/65">人才招聘</a></li>
                </ul>
                <div class="address">
                    <p>地址：{{$set -> address}}</p>
                    <p>电话：{{ $set -> tel }}  邮箱： {{$set -> email}}</p>
                </div>
            </div>
            <div class="line"></div>
            <div class="box2">
                <ul>
                    <li><a href="{{url('http://weibo.com')}}"><img src="{{ url('/home/images/xinlangweibo.png') }}" alt=""></a></li>
                    <li><a href="http://wpa.qq.com/msgrd?V=3&uin=2037990239&Site=客服&Menu=yes"><img src="{{ url('/home/images/qq.png') }}" alt=""></a></li>
                    <li><a href="{{url('http://t.qq.com')}}"><img src="{{ url('/home/images/tengxunweibo.png') }}" alt=""></a></li>
                    <li id="weixin"><a href="javascript:void(0);"><img src="{{ url('/home/images/weixin.png') }}" alt=""></a></li>
                </ul>
            </div>
            <div class="line"></div>
            <div class="box3">
                <img src="{{ url('/updates')}}/{{$set -> logo2}}" alt="康复社">
            </div>
        </div>
        <div class="bottom">
            {{$set -> news }} 技术支持：<a href="{{ url('http://www.tucsion.com/')}}">图森品牌</a>
        </div>
    </div>
    <div id="quickBar">
        <dl>
            <dd><a href="javascript:void(0);"><img src="{{url('/home/images/top1.gif') }}" alt=""></a></dd><!-- 回到顶部 -->
            <dd><a href="/home/user/index"><img src="{{url('/home/images/top2.png') }}" alt=""></a></dd><!-- 个人中心 -->
            <dd><a href="javascript:void(0);" id="quickTel"><img src="{{url('/home/images/topTel.png') }}" alt=""></a></dd><!-- 电话 -->
            <dd><a href="{{url('/goodscar/car')}}"><img src="{{url('/home/images/top4.png') }}" alt=""></a></dd><!-- 购物车 -->
            <dd><a href="http://wpa.qq.com/msgrd?V=3&uin=2037990239&Site=客服&Menu=yes"><img src="{{url('/home/images/top6.png') }}" alt=""></a></dd><!-- QQ -->
        </dl>
    </div>

    <script type="text/javascript">
        layui.use(['element','layer'],function(){
            var layer = layui.layer;
        }); 
        //微信
        $('#weixin').on('mouseover', function() {
            layer.tips('<img src="/home/images/erwm.jpeg">', '#weixin', {
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


</body>
</html>