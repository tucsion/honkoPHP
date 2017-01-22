layui.use(['form'],function(){
	var form = layui.form();
	
	//更换发货地址
	$('.addressList').on('click', function() {
		$.get('/goodscar/select', {}, function(str){
			layer.open({
				type: 1,
				title : '选择发货地址',
				shade : [0.3,'#000'],
				shadeClose : false,
				scrollbar : false,
				area: ['700px', '500px'],
				content: str,
				btn : ['关闭'],
			});
		});
	});

	//更换发票信息
	$('.fapiaoListBtn').on('click', function() {
		$.get('/goodscar/pd', {}, function(str){
			layer.open({
				type: 1,
				title : '选择发票信息',
				shade : [0.3,'#000'],
				shadeClose : false,
				scrollbar : false,
				area: ['700px', '500px'],
				content: str,
				btn : ['关闭'],
			});
		});
	});

	//拉取第一条发票信息
	form.on('radio(fapiao)', function(data) {
		if (data.value == '是') {
			if ($('.fapiaoList').find('input').val() == '') {
				$('.fapiao').find('.loading').show();
				$.ajax({
					url: '/goodscar/bill',
					type: 'post',
					dataType: 'json',
					data: {userId: '88'},
					success : function(data){
						if (data) {
							$('.fapiao').find('.loading').hide();
							$('.fapiaoList').show('slow');
							$('.fapiaoList').find('input').val(data.id);
							$('.fapiaoList').find('.fapiao_info_1').text(data.depict);
							$('.fapiaoList').find('.fapiao_info_2').text(data.billtype);
							$('.fapiaoList').find('.fapiao_info_3').text(data.billitem);
						}else{
							$('.fapiao').find('.loading').hide();
							$('.noFapiao').show();
						}
					}
				});
			}else{
				$('.fapiaoList').show();
			}
		}else{
			$('.fapiaoList,.noFapiao').hide();
		}
	});
});

