layui.use(['element','layer','laypage'],function(){
	var layer = layui.layer,laypage = layui.laypage;


//页面跳转函数
var changePage = function(menu,data){
	$.ajax({
		type : "get",
		async : true,  //同步请求
		url : menu,
		data : data,
		timeout:1000,
		beforeSend:function(){
			index = layer.load(1,{
				// shade: [0.5, '#000']
			});
		},
		success:function(dates){
			layer.close(index);
			$("#main").html(dates);//要刷新的div
		},
		error: function() {
			layer.close(index);
			layer.msg("加载失败，请稍后再试！",{
				shade : [0.3, '#000'],
				shadeClose: true, //开启遮罩关闭
			});
        }
	})
}
});

