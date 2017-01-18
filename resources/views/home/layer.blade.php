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
                <form>
                    <input type="text">
                    <div class="btn">
                        <i class="layui-icon">&#xe615;</i>
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
                    @foreach($train as $train)
                        <dd><a href="{{ url('/train/index') }}/{{$train -> id}}">{{ $train -> cate }}</a></dd>
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
                    @foreach($procure as $procure)
                        <dd><a href="{{ url('/procure/index') }}/{{$procure -> id}}">{{ $procure -> cate }}</a></dd>
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
                    @foreach($goods as $goods)
                        <dd><a href="{{ url('/store/goodlist') }}/sort={{ $goods -> id }}">{{ $goods -> cate }}</a></dd>
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
                    @foreach($health as $health)
                        <dd><a href="{{ url('/info/index') }}/{{$health -> id}}">{{ $health -> cate }}</a></dd>
                    @endforeach 
                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <!-- 内容区域 -->
    <div id="member" class="container">
        <!-- 左边栏菜单 -->
        <div id="menu" class="greenBox">
        @if(session('user')->utp == 1)
            <dl>
                <dt class="headTitle">资料管理</dt>
                <dd><a href="{{url('/home/user/base')}}"><i class="layui-icon">&#xe623;</i> 基础资料</a></dd>
                <dd><a href="{{url('/home/user/address')}}"><i class="layui-icon">&#xe623;</i> 地址管理</a></dd>
                <dd><a href="{{url('/home/user/bill')}}" ><i class="layui-icon">&#xe623;</i> 发票管理</a></dd>
                <dd><a href="{{url('/home/user/rz')}}"><i class="layui-icon">&#xe623;</i> 认证管理</a></dd>
                <dd><a href="{{url('/home/user/pass')}}"><i class="layui-icon">&#xe623;</i> 修改密码</a></dd>
            </dl>
            <dl>
                <dt class="headTitle">病历管理</dt>
                <dd><a href="{{url('/ill/man')}}"><i class="layui-icon">&#xe623;</i> 人物管理</a></dd>
                <dd><a href="{{url('/ill/cases')}}"><i class="layui-icon">&#xe623;</i> 病历管理</a></dd>
            </dl>
            <dl>
                <dt class="headTitle">订单管理</dt>
                <dd><a href="{{url('/order/serve')}}"><i class="layui-icon">&#xe623;</i> 服务订单</a></dd>
                <dd><a  href="{{url('/order/goods')}}" ><i class="layui-icon">&#xe623;</i> 商城订单</a></dd>
            </dl>
            <dl>
                <dt class="headTitle">我的收藏</dt>
                <dd><a href="{{url('/fav/zj')}}"><i class="layui-icon">&#xe623;</i> 收藏的专家</a></dd>
                <dd><a href="{{url('/fav/goods')}}"><i class="layui-icon">&#xe623;</i> 收藏的器械</a></dd>
                <dd><a href="{{url('/fav/wz')}}"><i class="layui-icon">&#xe623;</i> 收藏的资料</a></dd>
            </dl>
            <dl>
                <dt class="headTitle">积分等级</dt>
                <dd><a href="{{url('/mymark/index')}}"><i class="layui-icon">&#xe623;</i> 我的积分</a></dd>
                <dd><a href="{{url('/mymark/addrule')}}"><i class="layui-icon">&#xe623;</i> 积分规则</a></dd>
            </dl>
            <dl>
                <dt class="headTitle">消息中心</dt>
                <dd><a href="{{url('/message/xitong')}}" ><i class="layui-icon">&#xe623;</i>&nbsp;系统消息&nbsp;<small id='winmsd' style="color:red; display:none;float: right;margin-right: 10px;">新</small></a></dd>
                <dd><a href="{{url('/message/deal')}}"><i class="layui-icon">&#xe623;</i>&nbsp;交易提醒&nbsp;<small id='deal' style="color:red; display:none;float: right;margin-right: 10px;">新</small></a></dd>
                <dd><a href="{{url('/message/zixun')}}"><i class="layui-icon">&#xe623;</i> 专家回复</a></dd>
                <dd><a  href="{{url('/message/myword')}}"><i class="layui-icon">&#xe623;</i>&nbsp;我的留言&nbsp;<small id='myword' style="color:red; display:none;float: right;margin-right: 10px;">新</small></a></dd>
            </dl>
        @endif
        @if(session('user') -> utp == 2)
            <dl>
                <dt class="headTitle">资料管理</dt>
                <dd><a href="{{url('/home/zjuser/base')}}"><i class="layui-icon">&#xe623;</i> 基础资料</a></dd>
                <dd><a href="{{url('/home/user/rz')}}"><i class="layui-icon">&#xe623;</i> 认证管理</a></dd>
                <dd><a href="{{url('/home/user/pass')}}"><i class="layui-icon">&#xe623;</i> 修改密码</a></dd>
                <dd><a href="{{ url('/expert/detail')}}/{{session('user') -> id}}"><i class="layui-icon">&#xe623;</i> 个人主页</a></dd>
            </dl>
            <dl>
                <dt class="headTitle">关注的病人</dt>
                <dd><a href="{{url('/home/tuisong/gz')}}"><i class="layui-icon">&#xe623;</i> 关注的病人</a></dd>
                <dd><a href="{{url('/home/tuisong/xitong')}}"><i class="layui-icon">&#xe623;</i>&nbsp;系统推送&nbsp;<small id='tuisong' style="color:red; display:none;float: right;margin-right: 10px;">新</small></a></dd>
            </dl>
             <dl>
                <dt class="headTitle">学术资料</dt>
                <dd><a href="{{url('/home/zl/index')}}"><i class="layui-icon">&#xe623;</i> 资料列表</a></dd>
                <dd><a href="{{url('/home/zl/add')}}"><i class="layui-icon">&#xe623;</i> 发布资料</a></dd>
            </dl>
            <dl>
                <dt class="headTitle">积分等级</dt>
                <dd><a href="{{url('/mymark/index')}}"><i class="layui-icon">&#xe623;</i> 我的积分</a></dd>
                <dd><a href="{{url('/mymark/addrule')}}"><i class="layui-icon">&#xe623;</i> 积分规则</a></dd>
                <dd><a href="{{url('/mymark/level')}}"><i class="layui-icon">&#xe623;</i> 等级规则</a></dd>
            </dl>
             <dl>
                <dt class="headTitle">订单管理</dt>
                <dd><a href="{{url('/home/zjser/index')}}"><i class="layui-icon">&#xe623;</i> 服务订单</a></dd>
            </dl>
             <dl>
                <dt class="headTitle">财务管理</dt>
                <dd><a href="{{url('/assets/porder')}}"><i class="layui-icon">&#xe623;</i> 提现订单</a></dd>
                <dd><a href="{{url('/assets/income')}}"><i class="layui-icon">&#xe623;</i> 收入管理</a></dd>
            </dl>
            <dl>
                <dt class="headTitle">消息中心</dt>
                <dd><a href="{{url('/message/xitong')}}" ><i class="layui-icon">&#xe623;</i>&nbsp;系统消息&nbsp;<small id='winmsd' style="color:red; display:none;float: right;margin-right: 10px;">新</small></a></dd>
                <dd><a href="{{url('/message/deal')}}"><i class="layui-icon">&#xe623;</i>&nbsp;患者交流&nbsp;<small id='deal' style="color:red; display:none;float: right;margin-right: 10px;">新</small></a></dd>
            </dl>
        @endif
        @if(session('user') -> utp == 3)
        <dl>
                <dt class="headTitle">资料管理</dt>
                <dd><a href="{{url('/home/qyuser/base')}}"><i class="layui-icon">&#xe623;</i> 基础资料</a></dd>
                <dd><a href="{{url('/home/user/pass')}}"><i class="layui-icon">&#xe623;</i> 修改密码</a></dd>
        </dl>
        <dl>
                <dt class="headTitle">采购单管理</dt>
                <dd><a href="{{url('/home/user/base')}}"><i class="layui-icon">&#xe623;</i> 历史采购单</a></dd>
                <dd><a href="{{url('/home/user/address')}}"><i class="layui-icon">&#xe623;</i> 收藏的商品</a></dd>
                <dd><a href="{{url('/purch/index')}}" ><i class="layui-icon">&#xe623;</i> 未完成采购单</a></dd>
                <dd><a href="{{url('/home/user/bill')}}" ><i class="layui-icon">&#xe623;</i> 发票管理</a></dd>
        </dl>
        <dl>
                <dt class="headTitle">消息中心</dt>
                <dd><a href="{{url('/message/xitong')}}" ><i class="layui-icon">&#xe623;</i>&nbsp;系统消息&nbsp;<small id='winmsd' style="color:red; display:none;float: right;margin-right: 10px;">新</small></a></dd>
        </dl>
        @endif
            <dl>
                <dt class="headTitle">其他</dt>
                <dd><a href="{{url('/home/logout')}}"><i class="layui-icon">&#xe623;</i> 退出登录</a></dd>
            </dl>
        </div>
        <div id="main" class="greenBox">
@yield('center')
    </div>
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
        layui.use(['form'],function(){
        var form = layui.form();
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
    @if(session('user') -> utp == 1)
    <script type="text/javascript">
        $(function(){
        setInterval(aa,10000);
        function aa()
        {
        $.ajax({
                url : '{{url('/home/user/ajaxupdate')}}',
                async:false,
                type : 'get',
                dataType : 'json',
                success : function(res){
                            if(res.status == 1)
                            {
                                
                                var winmsd = document.getElementById('winmsd');
                                winmsd.style.display = 'block';
                            }
                            if(res.status == 0)
                            {
                                  
                                var winmsd = document.getElementById('winmsd');
                                winmsd.style.display = 'none';
                            }
                            if(res.state == 1)
                            {
                                  
                                var deal = document.getElementById('deal');
                                deal.style.display = 'block';
                            }
                            if(res.state == 0)
                            {
                                 
                                var deal = document.getElementById('deal');
                                deal.style.display = 'none';
                            }
                            if(res.stat == 1)
                            {
                                var deal = document.getElementById('myword');
                                deal.style.display = 'block';
                            }
                            if(res.stat == 0)
                            {
                                var deal = document.getElementById('myword');
                                deal.style.display = 'none';
                            }
                        }

        });
        }
    });
    </script>
    @endif
    @if(session('user') -> utp == 2)
    <script type="text/javascript">
        $(function(){
        setInterval(aa,10000);
        function aa()
        {
        $.ajax({
                url : '{{url('/home/tuisong/ajax')}}',
                async:false,
                type : 'get',
                dataType : 'json',
                success : function(res){
                            if(res.state == 1)
                            {
                                
                                var tuisong = document.getElementById('tuisong');
                                tuisong.style.display = 'block';
                            }
                            if(res.state == 0)
                            {
                                 var tuisong = document.getElementById('tuisong');
                                tuisong.style.display = 'none';
                            }
                        }

        });
        }
    });
    </script>
    @endif
</body>
</html>