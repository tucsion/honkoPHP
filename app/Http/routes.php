<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



//后台
Route::group(['middleware' => 'login'],function(){

//后台首页
Route::get('/admin/index','Admin\Indexcontroller@index');


//基本信息管理
Route::get('/admin/set','Admin\Setcontroller@index');
Route::post('/admin/set/update','Admin\SetController@update');


//管理员管理
//管理员列表
Route::get('/admin/admin/index','Admin\Admincontroller@index');

//管理员添加
Route::get('/admin/admin/add','Admin\Admincontroller@add');
Route::post('/admin/admin/insert','Admin\Admincontroller@insert');

//管理员修改
Route::get('/admin/admin/edit/{id}','Admin\Admincontroller@edit');
Route::post('/admin/admin/update','Admin\Admincontroller@update');
Route::get('/admin/admin/delete/{id}','Admin\Admincontroller@delete');

//图片管理
//轮播图管理	
Route::get('/admin/pic/index','Admin\Picturecontroller@index');
Route::get('/admin/pic/add','Admin\Picturecontroller@add');
Route::post('/admin/pic/insert','Admin\Picturecontroller@insert');
Route::get('/admin/pic/edit/{id}','Admin\PictureController@edit');
Route::post('/admin/pic/update','Admin\PictureController@update');
Route::get('/admin/pic/delete/{id}','Admin\PictureController@delete');
//banner图管理
Route::get('/admin/banner/index','Admin\Bannercontroller@index');
Route::get('/admin/banner/add','Admin\Bannercontroller@add');
Route::post('/admin/banner/insert','Admin\Bannercontroller@insert');
Route::get('/admin/banner/edit/{id}','Admin\BannerController@edit');
Route::post('/admin/banner/update','Admin\BannerController@update');
Route::get('/admin/banner/delete/{id}','Admin\BannerController@delete');


//友情链接管理
Route::get('/admin/link/index','Admin\Linkcontroller@index');
Route::get('/admin/link/add','Admin\Linkcontroller@add');
Route::post('/admin/link/insert','Admin\Linkcontroller@insert');
Route::get('/admin/link/edit/{id}','Admin\LinkController@edit');
Route::post('/admin/link/update','Admin\LinkController@update');
Route::get('/admin/link/delete/{id}','Admin\LinkController@delete');


//分类管理
Route::resource('/admin/cate','Admin\Catecontroller');

//信息管理
Route::resource('/admin/keshi','Admin\Keshicontroller');
Route::resource('/admin/xitong','Admin\Xitongcontroller');
Route::get('/admin/xitong/edit/{id}','Admin\Goodscontroller@editxt');
Route::post('/admin/xitong/updatext','Admin\Goodscontroller@updatext');



//商品管理
Route::get('/admin/goods/index', 'Admin\GoodsController@index');
Route::get('/admin/goods/add','Admin\Goodscontroller@add');
Route::post('/admin/goods/insert','Admin\Goodscontroller@insert');
Route::get('/admin/goods/edit/{id}','Admin\GoodsController@edit');
Route::post('/admin/goods/update','Admin\GoodsController@update');
Route::get('/admin/goods/delete/{id}','Admin\GoodsController@delete');
//器械管理
Route::get('/admin/hickey/index', 'Admin\HickeyController@index');
Route::get('/admin/hickey/add','Admin\Hickeycontroller@add');
Route::post('/admin/hickey/insert','Admin\Hickeycontroller@insert');
Route::get('/admin/hickey/edit/{id}','Admin\HickeyController@edit');
Route::post('/admin/hickey/update','Admin\HickeyController@update');
Route::get('/admin/hickey/delete/{id}','Admin\HickeyController@delete');
//商品属性管理
Route::resource('/admin/scope','Admin\Scopecontroller');
Route::resource('/admin/vender','Admin\Vendercontroller');
Route::resource('/admin/agent','Admin\Agentcontroller');

//文章管理
//教育与培训
Route::get('/admin/train/index', 'Admin\TrainController@index');
Route::get('/admin/train/add','Admin\Traincontroller@add');
Route::post('/admin/train/insert','Admin\Traincontroller@insert');
Route::get('/admin/train/edit/{id}','Admin\TrainController@edit');
Route::post('/admin/train/update','Admin\TrainController@update');
Route::get('/admin/train/delete/{id}','Admin\TrainController@delete');
//养生养老
Route::get('/admin/health/index', 'Admin\HealthController@index');
Route::get('/admin/health/add','Admin\Healthcontroller@add');
Route::post('/admin/health/insert','Admin\Healthcontroller@insert');
Route::get('/admin/health/edit/{id}','Admin\HealthController@edit');
Route::post('/admin/health/update','Admin\HealthController@update');
Route::get('/admin/health/delete/{id}','Admin\HealthController@delete');
//企业采购
Route::get('/admin/procure/index', 'Admin\ProcureController@index');
Route::get('/admin/procure/add','Admin\Procurecontroller@add');
Route::post('/admin/procure/insert','Admin\Procurecontroller@insert');
Route::get('/admin/procure/edit/{id}','Admin\ProcureController@edit');
Route::post('/admin/procure/update','Admin\ProcureController@update');
Route::get('/admin/procure/delete/{id}','Admin\ProcureController@delete');
//康复资讯
Route::get('/admin/info/index', 'Admin\InfoController@index');
Route::get('/admin/info/add','Admin\Infocontroller@add');
Route::post('/admin/info/insert','Admin\Infocontroller@insert');
Route::get('/admin/info/edit/{id}','Admin\InfoController@edit');
Route::post('/admin/info/update','Admin\InfoController@update');
Route::get('/admin/info/delete/{id}','Admin\InfoController@delete');
//联系我们
Route::get('/admin/lianxi/index', 'Admin\LianxiController@index');
Route::get('/admin/lianxi/add','Admin\Lianxicontroller@add');
Route::post('/admin/lianxi/insert','Admin\Lianxicontroller@insert');
Route::get('/admin/lianxi/edit/{id}','Admin\LianxiController@edit');
Route::post('/admin/lianxi/update','Admin\LianxiController@update');
Route::get('/admin/lianxi/delete/{id}','Admin\LianxiController@delete');
//医生文章管理
Route::get('/admin/doctor/index', 'Admin\DoctorController@index');
Route::get('/admin/doctor/delete/{id}','Admin\DoctorController@delete');


//会员信息管理
//患者管理
Route::get('/admin/patient/index', 'Admin\PatientController@index');
Route::get('/admin/patient/add','Admin\Patientcontroller@add');
Route::post('/admin/patient/insert','Admin\Patientcontroller@insert');
Route::get('admin/patient/delete/{id}','Admin\PatientController@delete');
Route::get('admin/patient/edit/{id}','Admin\PatientController@edit');
Route::post('/admin/patient/update','Admin\PatientController@update');

//专家管理
Route::get('/admin/expert/index', 'Admin\ExpertController@index');
Route::get('/admin/expert/add','Admin\Expertcontroller@add');
Route::post('/admin/expert/insert','Admin\Expertcontroller@insert');
Route::get('admin/expert/delete/{id}','Admin\ExpertController@delete');
Route::get('admin/expert/edit/{id}','Admin\ExpertController@edit');
Route::post('/admin/expert/update','Admin\ExpertController@update');

//企业管理
Route::get('/admin/firm/index', 'Admin\FirmController@index');
Route::get('/admin/firm/add','Admin\Firmcontroller@add');
Route::post('/admin/firm/insert','Admin\Firmcontroller@insert');
Route::get('admin/firm/delete/{id}','Admin\FirmController@delete');
Route::get('admin/firm/edit/{id}','Admin\FirmController@edit');
Route::post('/admin/firm/update','Admin\FirmController@update');

//数据统计
Route::get('/admin/tongji/users', 'Admin\TongjiController@users');


//会员商品订单
Route::get('/admin/myorder/index', 'Admin\MyorderController@index');
Route::get('admin/myorder/delete/{id}','Admin\MyorderController@delete');
Route::post('admin/myorder/ajaxupdate','Admin\MyorderController@ajaxupdate');
Route::get('/admin/myorder/detail/{id}', 'Admin\MyorderController@detail');

//会员服务订单
Route::get('/admin/myserve/index', 'Admin\MyserveController@index');
Route::get('admin/myserve/delete/{id}','Admin\MyserveController@delete');
Route::get('/admin/myserve/detail/{id}', 'Admin\MyserveController@detail');

//会员资料订单
Route::get('/admin/mydata/index', 'Admin\MydataController@index');
Route::get('admin/mydata/delete/{id}','Admin\MydataController@delete');
Route::get('/admin/mydata/detail/{id}', 'Admin\MydataController@detail');

//医生提现订单
Route::get('/admin/mydeal/index', 'Admin\MydealController@index');
Route::get('admin/mydeal/delete/{id}','Admin\MydealController@delete');


//留言管理
Route::get('/admin/message/index', 'Admin\MessageController@index');
Route::get('/admin/message/detail/{id}', 'Admin\MessageController@detail');
Route::get('admin/message/delete/{id}','Admin\MessageController@delete');

//评论管理
Route::get('/admin/comment/index', 'Admin\CommentController@index');
Route::get('/admin/comment/detail/{id}', 'Admin\CommentController@detail');
Route::get('admin/comment/delete/{id}','Admin\CommentController@delete');



});


//登录
Route::get('/admin/login', 'Admin\LoginController@login');
Route::post('/admin/dologin', 'Admin\LoginController@dologin');

//验证码
Route::get('/kit/captcha/{tmp}', 'Admin\KitController@captcha');

//退出
Route::get('/admin/logout', 'Admin\LoginController@logout');


//网站首页
Route::get('/', 'Home\IndexController@index');



//专家列表
Route::get('/expert/index', 'Home\ExpertController@index');
Route::get('/expert/zjlist/{id}', 'Home\ExpertController@zjlist');
Route::get('/expert/detail/{id}', 'Home\ExpertController@detail');
Route::get('/expert/zixun/{id}','Home\Expertcontroller@zixun');
Route::post('/expert/doliuyan','Home\Expertcontroller@doliuyan');
Route::post('/expert/message','Home\Expertcontroller@message');
Route::post('/expert/messagehf','Home\Expertcontroller@messagehf');
Route::get('/expert/wenzang/{id}','Home\Expertcontroller@wenzang');
Route::get('/expert/wzsc/{id}','Home\Expertcontroller@wzsc');
Route::get('/expert/zjsc/{id}','Home\Expertcontroller@zjsc');
Route::get('/expert/jianjie/{id}','Home\Expertcontroller@jianjie');
Route::get('/expert/blxz/{id}','Home\Expertcontroller@blxz');
Route::post('/expert/serve','Home\Expertcontroller@serve');

//教育与培训
Route::get('/train/index/{id}', 'Home\TrainController@index');
Route::get('/train/detail/{id}','Home\TrainController@detail');

//养生养老
Route::get('/health/index/{id}', 'Home\HealthController@index');
Route::get('/health/detail/{id}','Home\HealthController@detail');

//企业采购
Route::get('/procure/index/{id}', 'Home\ProcureController@index');
Route::get('/procure/detail/{id}','Home\ProcureController@detail');

//康复资讯
Route::get('/info/index/{id}', 'Home\InfoController@index');
Route::get('/info/detail/{id}','Home\InfoController@detail');

//康复器械园
Route::get('/hickey/index','Home\Hickeycontroller@index');
Route::get('/hickey/qxlist/{id}','Home\Hickeycontroller@qxlist');
Route::get('/hickey/detail/{id}','Home\Hickeycontroller@detail');

//网上商城
Route::get('/store/index', 'Home\StoreController@index');
Route::get('/store/goodlist/{id}', 'Home\StoreController@goodlist');
Route::get('/store/detail/{id}', 'Home\StoreController@detail');
Route::post('/store/goodscar','Home\StoreController@goodscar');
Route::get('/expert/goodsc/{id}','Home\Storecontroller@goodsc');

//首页搜索
Route::post('/home/find','Home\Findcontroller@find');

//联系我们
Route::get('/contact/index/{id}','Home\ContactController@index');
//网站地图
Route::get('/contact/maps','Home\ContactController@maps');
//友情链接
Route::get('/contact/links','Home\ContactController@links');

//前台登录
Route::get('/home/login','Home\LoginController@login');
Route::post('/home/dologin','Home\LoginController@dologin');
Route::get('/home/logout','Home\LoginController@logout');

//会员中心
Route::get('/home/user/index','Home\UserController@index');
Route::get('/home/user/main','Home\UserController@main');
//基本资料
Route::get('/home/user/base','Home\UserController@base');
Route::post('/home/user/editzl','Home\UserController@editzl');
Route::post('/home/user/img','Home\UserController@img');
Route::get('/home/zjuser/base','Home\ZjuserController@base');
Route::post('/home/zjuser/editzl','Home\ZjuserController@editzl');
Route::get('/home/qyuser/base','Home\QyuserController@base');
Route::post('/home/qyuser/editzl','Home\QyuserController@editzl');

//地址管理
Route::get('/home/user/address','Home\UserController@address');
Route::post('/home/user/editadd','Home\UserController@editadd');
Route::get('/home/user/snat/{id}','Home\UserController@snat');
Route::post('/home/user/updateadd','Home\UserController@updateadd');
Route::get('/home/user/deleteadd/{id}','Home\UserController@deleteadd');

//发票管理
Route::get('/home/user/bill','Home\UserController@bill');
Route::post('/home/user/addbill','Home\UserController@addbill');
Route::get('/home/user/editbill/{id}','Home\UserController@editbill');
Route::post('/home/user/updatebill','Home\UserController@updatebill');
Route::get('/home/user/deletebill/{id}','Home\UserController@deletebill');

//企业采购
Route::post('/purch/caigou','Home\PurchController@caigou');
Route::get('/purch/index','Home\PurchController@index');
Route::post('/purch/delete','Home\PurchController@delete');
Route::get('/purch/add','Home\PurchController@add');
Route::get('/purch/cg','Home\PurchController@cg');
Route::post('/purch/del','Home\PurchController@del');
Route::get('/purch/cgxq/{id}','Home\PurchController@cgxq');
Route::post('/purch/qysc','Home\PurchController@qysc');
Route::get('purch/sc','Home\PurchController@sc');
Route::post('/purch/deletegoods','Home\PurchController@deletegoods');
Route::get('/purch/ajax','Home\PurchController@ajax');
//认证管理
Route::get('/home/user/rz','Home\UserController@rz');
Route::post('/home/user/rzadd','Home\UserController@rzadd');

//修改密码
Route::get('/home/user/pass','Home\UserController@pass');
Route::post('/home/user/passedit','Home\UserController@passedit');

//消息动态
Route::get('/home/user/ajaxupdate','Home\UserController@ajaxupdate');

//系统推送
Route::get('/home/tuisong/ajax','Home\TuisongController@ajax');
Route::get('/home/tuisong/xitong','Home\TuisongController@xitong');
Route::post('/home/tuisong/delete','Home\TuisongController@delete');
Route::post('/home/tuisong/deletegz','Home\TuisongController@deletegz');
Route::get('/home/tuisong/blxq/{id}','Home\TuisongController@blxq');
Route::post('/home/tuisong/follow','Home\TuisongController@follow');
Route::get('/home/tuisong/gz','Home\TuisongController@gz');

//资料列表
Route::get('/home/zl/index','Home\ZlController@index');
Route::get('/home/zl/add','Home\ZlController@add');
Route::post('/home/zl/insert','Home\ZlController@insert');

//服务订单
Route::get('/home/zjser/index','Home\ZjserController@index');
Route::post('/zjser/sersx','Home\ZjserController@sersx');
Route::get('/zjser/servexq/{id}','Home\ZjserController@servexq');

//财务管理
Route::get('/assets/income','Home\AssetsController@income');
Route::get('/assets/draw','Home\AssetsController@draw');
Route::post('/assets/drawadd','Home\AssetsController@drawadd');
Route::get('/assets/porder','Home\AssetsController@porder');
Route::post('/assets/delete','Home\AssetsController@delete');

//病例管理
Route::get('/ill/man','Home\IllController@man');
Route::get('/ill/add','Home\IllController@add');
Route::post('/ill/edit','Home\IllController@edit');
Route::post('/ill/update','Home\IllController@update');
Route::post('/ill/delete','Home\IllController@delete');
Route::post('/ill/casedel','Home\IllController@casedel');
Route::post('/ill/insert','Home\IllController@insert');
Route::post('/ill/detail','Home\IllController@detail');
Route::post('/ill/casexq','Home\IllController@casexq');
Route::get('/ill/cases','Home\IllController@cases');
Route::get('/ill/caseadd','Home\IllController@caseadd');
Route::get('/ill/select','Home\IllController@select');
Route::post('/ill/img','Home\IllController@img');
Route::post('/ill/deleteimg','Home\IllController@deleteimg');
Route::get('/ill/xieyi','Home\IllController@xieyi');
Route::post('/ill/caseinsert','Home\IllController@caseinsert');
Route::get('/ill/caseedit/{id}','Home\IllController@caseedit');
Route::post('/ill/caseupdate','Home\IllController@caseupdate');

//订单管理
Route::get('/order/serve','Home\ServeController@serve');
Route::get('/order/goods','Home\ServeController@goods');
Route::get('/order/good','Home\ServeController@good');
Route::post('/order/delete','Home\ServeController@delete');
Route::post('/order/deleteser','Home\ServeController@deleteser');
Route::get('/order/goodsxq/{id}','Home\ServeController@goodsxq');
Route::get('/order/queren/{id}','Home\ServeController@queren');
Route::get('/order/fanhui','Home\ServeController@fanhui');
Route::post('/order/sx','Home\ServeController@sx');
Route::post('/order/sersx','Home\ServeController@sersx');
Route::get('/order/servexq/{id}','Home\ServeController@servexq');
Route::get('/order/serveqr/{id}','Home\ServeController@serveqr');

//个人收藏
//专家
Route::get('/fav/zj','Home\FavController@zj');
Route::post('/fav/deletezj','Home\FavController@deletezj');
//器械
Route::get('/fav/goods','Home\FavController@goods');
Route::post('/fav/deletegoods','Home\FavController@deletegoods');
//文章
Route::get('/fav/wz','Home\FavController@wz');
Route::post('/fav/deletewz','Home\FavController@deletewz');

//积分等级
Route::get('/mymark/index','Home\MymarkController@index');
Route::get('/mymark/addrule','Home\MymarkController@addrule');
Route::get('/mymark/level','Home\MymarkController@level');

//消息中心
Route::get('/message/xitong','Home\MessageController@xitong');
Route::post('/message/xitongxq','Home\MessageController@xitongxq');
Route::get('/message/ajaxupdate','Home\MessageController@ajaxupdate');
Route::get('/message/myword','Home\MessageController@myword');
Route::post('/message/mywordxq','Home\MessageController@mywordxq');
Route::post('/message/deleteword','Home\MessageController@deleteword');
Route::get('/message/deal','Home\MessageController@deal');
Route::post('/message/dealxq','Home\MessageController@dealxq');
Route::post('/message/deletedeal','Home\MessageController@deletedeal');
Route::get('/message/zixun','Home\MessageController@zixun');
Route::get('/message/huifu','Home\MessageController@huifu');

//咨询专家
Route::get('/record/chat/{illid}/{zjid}','Home\RecordController@chat');
Route::post('/record/zixun','Home\RecordController@zixun');
Route::get('/record/ajax/{illid}/{zjid}','Home\RecordController@ajax');
Route::get('/record/ajaxzj/{illid}/{zjid}','Home\RecordController@ajaxzj');
Route::post('/record/huifu','Home\RecordController@huifu');
Route::get('/record/ajaxhf','Home\RecordController@ajaxhf');
Route::get('/record/ajaxzx','Home\RecordController@ajaxzx');
Route::get('/record/chatzj/{illid}/{zjid}','Home\RecordController@chatzj');
//评价
Route::get('/record/pj/{id}','Home\RecordController@pj');
Route::post('/record/pjtj','Home\RecordController@pjtj');
Route::get('/record/pjwz/{id}','Home\RecordController@pjwz');
Route::post('/record/wztj','Home\RecordController@wztj');
Route::get('/record/goodspj/{id}','Home\RecordController@goodspj');
Route::post('/record/goodstj','Home\RecordController@goodstj');
//专家登录
Route::get('/home/zjuser/index','Home\ZjuserController@index');

//文章支付页
Route::get('/xiazai/pay/{id}','Home\XiazaiController@pay');
Route::get('/xiazai/ddxq/{num}','Home\XiazaiController@ddxq');
Route::get('/xiazai/queren/{id}','Home\XiazaiController@queren');
Route::get('/xiazai/fanhui','Home\XiazaiController@fanhui');

//购物车
Route::get('/goodscar/car','Home\GoodscarController@car');
Route::post('/goodscar/carqr','Home\GoodscarController@carqr');
Route::post('/goodscar/myorder','Home\GoodscarController@myorder');
Route::post('/goodscar/buy','Home\GoodscarController@buy');
Route::get('/goodscar/delete/{gid}','Home\GoodscarController@delete');
Route::get('/goodscar/select','Home\GoodscarController@select');
Route::post('/goodscar/bill','Home\GoodscarController@bill');
Route::get('/goodscar/pd','Home\GoodscarController@pd');
//支付宝支付处理
Route::get('/alipay/pay/{id}','Home\AlipayController@pay');
Route::get('/alipay/goodspay/{id}','Home\AlipayController@goodspay');
//支付后跳转页面
Route::get('/alipay/re','Home\AlipayController@re');
