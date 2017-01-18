<div class="character">
	<form class="layui-form" action="{{ url('/ill/insert')}}" method="post">
	{{ csrf_field() }}
		<!-- 姓名 -->
		<div class="layui-form-item">
			<label class="layui-form-label">真实姓名</label>
			<div class="layui-input-inline">
				<input type="text" name="cname" required lay-verify="required" placeholder="请输入真实姓名" autocomplete="off" class="layui-input">

			</div>
		</div>
		<!-- 出生年月 -->
		<div class="layui-form-item">
			<label class="layui-form-label">出生年月</label>
			<div class="layui-input-inline">
				<div class="layui-inline">
					<input class="layui-input" placeholder="出生年月" name='cbir' lay-verigy="required" readonly onclick="layui.laydate({elem: this})">
				</div>
			</div>
		</div>
		<!-- 性别 -->
		<div class="layui-form-item">
			<label class="layui-form-label">性别</label>
			<div class="layui-input-block">
				<input name="csex" value="男" title="男" checked="checked" type="radio">
				<input name="csex" value="女" title="女" type="radio">
			</div>
		</div>
		<!-- 婚否 -->
		<div class="layui-form-item">
			<label class="layui-form-label">婚姻状况</label>
			<div class="layui-input-block">
				<input name="state" value="未婚" title="未婚" checked="checked" type="radio">
				<input name="state" value="已婚" title="已婚" type="radio">
			</div>
		</div>
		<!-- 民族 -->
		<div class="layui-form-item">
			<label class="layui-form-label">民族</label>
			<div class="layui-input-inline">
				<select name="nation" id="national">
					<option value="" id="character_nation">请选择民族</option>
				</select>
			</div>
		</div>
		<!-- 职业 -->
		<div class="layui-form-item">
			<label class="layui-form-label">职业</label>
			<div class="layui-input-inline">
				<input type="text" name="job" placeholder="请填写职业" autocomplete="off" class="layui-input">
			</div>
		</div>
		<!-- 地域选择 -->
		<div class="layui-form-item">
                <label class="layui-form-label">选择地区</label>
                <div class="layui-input-inline">
                    <select name="province" id="province" lay-filter="province" lay-verify="required">
                        <option value="">请选择省</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="city" id="city" lay-filter="city" lay-verify="required">
                        <option value="">请选择市</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="county" id="area" lay-filter="area" lay-verify="required">
                        <option value="">请选择县/区</option>
                    </select>
                </div>
        </div>
		<!-- 详细地址 -->
		<div class="layui-form-item">
			<label class="layui-form-label">详细地址</label>
			<div class="layui-input-block">
				<input type="text" name="caddress" required  lay-verify="" placeholder="详细地址" class="layui-input">
			</div>
		</div>
		<!-- 住院时间 -->
		<div class="layui-form-item">
			<label class="layui-form-label">住院时间</label>
			<div class="layui-input-inline">
				<div class="layui-inline">
					<input class="layui-input" placeholder="住院时间" name='intime' lay-verify="required" readonly onclick="layui.laydate({elem: this})">
				</div>
			</div>
		</div>

		<div class="layui-form-item">
			<div class="layui-input-block">
				<button class="layui-btn" lay-submit lay-filter="">提交</button>
				<button type="reset" class="layui-btn layui-btn-primary">重置</button>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript" src="{{ url('/home/js/national.js') }}"></script>
<script type="text/javascript" src="{{url('/home/js/area2.js')}}"></script>
<script type="text/javascript" src="{{url('/home/js/getArea.js')}}"></script>
<script type="text/javascript">
	layui.use(['laydate','form'],function(){
		var laydate = layui.ladate,form = layui.form();
		form.render();
	});
	//城市联动
	var areaData = Area;
	var $form;
	var form;
	var $;
	var pp = '';
	layui.use(['jquery', 'form'], function() {
	  

	   $ = layui.jquery;
	   form = layui.form();
	   $form = $('form');
	   loadProvince(pp);

	   //修改页面
	   if (pp) {
	       var index1 = pp.split('_')[2];
	       var index2 = cc.split('_')[2];

	       loadCity(areaData[index1].mallCityList,cc);
	       loadArea((areaData[index1].mallCityList)[index2],aa);
	       loadArea(((areaData[index1].mallCityList)[index2]).mallAreaList,aa);
	   }
	});
</script>
