
$(function(){
	//积分操作
	$('.jifen_money').text(Math.floor(parseFloat($('.jifen').text())/parseFloat($('.jifen_guize').text())));

	$('#jifen').bind('click', function() {
		if (this.checked) {
			if (parseFloat($('.jifen_money').text()) > parseFloat($('.heji').val())) {
				alert('订单金额必须大于兑换金额');
				$(this).removeAttr('checked');
				$('.jifen_money2').val(0);
				return false;
			}
			$('.jifen_money2').val('-' + $('.jifen_money').text()).parents('tr').show('slow');
		}else{
			$('.jifen_money2').val(0).parents('tr').hide();
		}
	});

	var check_jifen = function(){
		if (parseFloat($('input.heji').val()) + parseFloat($('.jifen_money2').val()) < 0) {
			$('#jifen').attr('checked', false);
			$('.jifen_money2').val(0).parents('tr').hide();
			$('#total').val(parseFloat($('input.heji').val()) + parseFloat($('.jifen_money2').val()));
		}
	}
	//全选
	$('#checkAll').on('click', function() {
		if(this.checked){   
			$(this).prop("checked", true); 
			$('.checkOne').prop("checked", true); 
		}else{   
			$(this).prop("checked", false);
			$('.checkOne').prop("checked", false);
			$('#jife').attr('checked', false);
		}  
	});


	//选中的时候函数
	var sum = function(){
		$('input.heji').val(0);
		$('table .checkOne').each(function(index, el) {
			if (this.checked) {
				var temp = parseFloat($('input.heji').val()) + parseFloat($(this).parents('tr').find('.xiaoji').val());
				$('input.heji').val(temp);
			}
		});
		$('#total').val(parseFloat($('input.heji').val()) + parseFloat($('.jifen_money2').val()));
	}

	//初始化小计
	$('.xiaoji').each(function() {
		$(this).val(parseInt($(this).parents('tr').find('.proNum').val()) * parseInt($(this).parents('tr').find('.danjia').val()) );
		console.log($(this).parents('tr').find('.danjia').val());
	});


	$('input[type=checkbox]').change(function() {
		sum();
		check_jifen();
	});

	//产品数量改变
	//初始化数量为1,并失效减
	$.each($('.proNum'), function(index,val) {
		if (parseInt(val.value) > 1) {
			$(this).siblings('.min').removeClass('layui-btn-disabled');
		}
	});
    //数量增加操作
    $(".add").click(function(){
    	var t = $(this).siblings('.proNum');    
        t.val(parseInt(t.val())+1);
        if (parseInt(t.val())!=1){
            $(this).siblings('.min').removeClass('layui-btn-disabled');
        }
    }) 
    //数量减少操作
    $(".min").click(function(){
    	var t = $(this).siblings('.proNum'); 
        if (parseInt(t.val()) == 1){
        	$(this).addClass('layui-btn-disabled');
        	return;
        }
      	t.val(parseInt(t.val())-1);
      	if (parseInt(t.val()) == 1) {
      		$(this).addClass('layui-btn-disabled');
      	}
    })

    $('.min,.add').on('click', function() {
    	$(this).parents('tr').find('.xiaoji').val(parseInt($(this).siblings('.proNum').val())*parseInt($(this).parents('tr').find('.danjia').val()));
    	sum();
    	check_jifen();
    });

    //删除产品
    $('.delBtn').on('click', function() {
    	$(this).parents('tr').remove();
    	sum();
    	check_jifen();
    	var gid  = $(this).attr('characterId');
    	$.ajax({
		  	url : '/goodscar/delete/'+gid,
			async:false,
			type : 'get',
			dataType : 'json',
			success : function(res){
					if(res == 0)
					{
						alert('删除成功')
					}else{
							alert('删除失败,请重试');
					}
				}
    });
    });

	
});