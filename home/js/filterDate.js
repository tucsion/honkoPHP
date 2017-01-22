layui.use(['laydate'],function(){
	var laydate = layui.laydate;

	var start = {
		max: laydate.now()
		,min: '1999-06-16 23:59:59'
		,istoday: false
		,choose: function(datas){
			end.min = datas; //开始日选好后，重置结束日的最小日期
			end.start = datas //将结束日的初始值设定为开始日
		}
	};

	var end = {
		max: laydate.now()
		,min: '1999-06-16 23:59:59'
		,istoday: false
		,choose: function(datas){
			start.max = datas; //结束日选好后，重置开始日的最大日期
		}
	};

	document.getElementById('date_start').onclick = function(){
		start.elem = this;
		laydate(start);
	}
	document.getElementById('date_end').onclick = function(){
		end.elem = this;
		laydate(end);
	}
});