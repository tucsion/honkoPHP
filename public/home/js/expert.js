$(function(){

	// 左边栏效果
	$('.sideMenu > ul > li').mouseover(function() {
		$(this).addClass('active').siblings('li').removeClass('active');
	});

	//弹窗插件
	layui.use('layer',function(){
		var layer = layui.layer;
		var user = $("#user").val();
		//付费咨询，弹出一个iframe层
		$('.expert_btn2').on('click', function(){
			if(!user)
			{
				
				alert('还未登录，请登录');
				return false;
			}
			var id = $(this).attr('user');
			layer.open({
				type: 2,
				title: '在线咨询专家',
				shadeClose: true, //点击遮罩关闭层
				area : ['800px' , '520px'],
				content: '/expert/zixun/'+id,
				btn : ['取消'],
				
			});
		});

		//免费留言
		$('.expert_btn1').on('click', function() {
			
			layer.open({
				type : 1 ,
				scrollbar: false, //屏蔽浏览器滚动
				title : '免费给专家留言',
				shadeClose : true,
				area : ['800px'],
				content : $('#guest'),
				btn : ['提交','取消'],
				yes : function(index){
					layer.load(1, {
						shade: [0.5,'#fff'] //0.1透明度的白色背景
					});
				}
			});
		});
		$('.guestBtn').on('click', function() {
			layer.open({
				id : 'guest_tanchuang',
				type : 1,
				scrollbar:false,
				title : '给专家留言',
				area : ['800px','250px'],
				content : $('#guest'),
				shadeClose : true
			});
		});

	});


});