
//加载省数据
function loadProvince(pp) {
 var proHtml = '';
 for (var i = 0; i < areaData.length; i++) {
     proHtml += '<option value="' + areaData[i].provinceCode + '_' + areaData[i].mallCityList.length + '_' + i + '">' + areaData[i].provinceName + '</option>';
 }
 //初始化省数据
 $form.find($('#province')).append(proHtml).val(pp);
 form.render();
 form.on('select(province)', function(data) {
     $form.find($('#area')).html('<option value="">请选择县/区</option>');
     var value = data.value;
     var d = value.split('_');
     var code = d[0];
     var count = d[1];
     var index = d[2];
     if (count > 0) {
         loadCity(areaData[index].mallCityList);
     } else {
         $form.find($('#city')).parent().hide();
     }
 });
}
  //加载市数据
 function loadCity(citys,cc) {
     var cityHtml = "<option value=''>请选择市</option>";
     for (var i = 0; i < citys.length; i++) {
         cityHtml += '<option value="' + citys[i].cityCode + '_' + citys[i].mallAreaList.length + '_' + i + '">' + citys[i].cityName + '</option>';
     }
     $form.find($('#city')).html(cityHtml).val(cc);
     form.render();
     form.on('select(city)', function(data) {
         var value = data.value;
         var d = value.split('_');
         var code = d[0];
         var count = d[1];
         var index = d[2];
         if (count > 0) {
             loadArea(citys[index].mallAreaList);
         } else {
             $form.find($('#area')).parent().hide();
         }
     });
 }
  //加载县/区数据
 function loadArea(areas,aa) {

     var areaHtml = "<option value=''>请选择县/区</option>";
     for (var i = 0; i < areas.length; i++) {
         areaHtml += '<option value="' + areas[i].areaCode + '">' + areas[i].areaName + '</option>';
     }
     $form.find($('#area')).html(areaHtml).val(aa);
     form.render();
     form.on('select(area)', function(data) {
         //console.log(data);
     });
 }