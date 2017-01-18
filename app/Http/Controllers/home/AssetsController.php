<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;

class AssetsController extends Controller
{
    //收入管理
    public function income()
    {   
      //查询所有分类
      $set = DB::table('hkyl_set') -> first();
      $expert = DB::table('hkyl_cate') -> where('pid','=','2') -> orderBy('id') -> get() ;
      $train = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> get();
      $ys = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> get();
      $hickey = DB::table('hkyl_cate') -> where('pid','=','5') -> orderBy('id') -> get();
      $procure = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> get();
      $goods = DB::table('hkyl_cate') -> where('pid','=','9') -> orderBy('id') -> get();
      $health = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> get();
      $banner = DB::table('hkyl_banner') -> where('id','=','4') -> first();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;
      //页面数据
      $uid = session('user') -> id;
      $income = DB::table('hkyl_income') 
      -> where('zjid',$uid) 
      ->paginate(10);

      $price = DB::table('hkyl_user') -> where('id',$uid) -> value('price');
    	return view('home.assets.income',['set' => $set,'huiyi'=>$huiyi,'qiye'=>$qiye,'price'=>$price,'income'=>$income,'jiaoyu'=>$jiaoyu,'yangsheng'=>$yangsheng,'banner' => $banner,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function draw(Request $request)
    {
      //查询所有分类
      $set = DB::table('hkyl_set') -> first();
      $expert = DB::table('hkyl_cate') -> where('pid','=','2') -> orderBy('id') -> get() ;
      $train = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> get();
      $ys = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> get();
      $hickey = DB::table('hkyl_cate') -> where('pid','=','5') -> orderBy('id') -> get();
      $procure = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> get();
      $goods = DB::table('hkyl_cate') -> where('pid','=','9') -> orderBy('id') -> get();
      $health = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> get();
      $banner = DB::table('hkyl_banner') -> where('id','=','4') -> first();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;

      $uid = session('user') -> id;
      $price = DB::table('hkyl_user') -> where('id',$uid) -> value('price');
      return view('home.assets.draw',['set' => $set,'huiyi'=>$huiyi,'qiye'=>$qiye,'price'=>$price,'jiaoyu'=>$jiaoyu,'yangsheng'=>$yangsheng,'banner' => $banner,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function drawadd(Request $request)
    {
      $data = $request -> except('_token');
      $data['zjid'] = session('user') -> id;
      $data['time'] = time();
      $data['drawnum'] = 'T'.rand(1000,9999).time();
      $price = $data['draw'];
      $oprice = DB::table('hkyl_user') -> where('id',session('user') ->id) -> value('price');
      if($oprice < $price)
      {
        return back() -> with(['tx'=>'提现金额不能大于账户余额']);
      }
      $p['price'] = $oprice - $price;
      $xgp = DB::table('hkyl_user') -> where('id',session('user') -> id) -> update($p);
      $res = DB::table('hkyl_draw') ->insert($data);
      if($res)
      {
        return redirect('/assets/porder')->with(['tx'=>'地址添加成功']);
      }else{
        return back() -> with(['txd'=>'提现金额不能大于账户余额']);
      }
    }
    public function porder()
    {
       //查询所有分类
      $set = DB::table('hkyl_set') -> first();
      $expert = DB::table('hkyl_cate') -> where('pid','=','2') -> orderBy('id') -> get() ;
      $train = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> get();
      $ys = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> get();
      $hickey = DB::table('hkyl_cate') -> where('pid','=','5') -> orderBy('id') -> get();
      $procure = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> get();
      $goods = DB::table('hkyl_cate') -> where('pid','=','9') -> orderBy('id') -> get();
      $health = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> get();
      $banner = DB::table('hkyl_banner') -> where('id','=','4') -> first();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;

      $uid = session('user') -> id;
      $price = DB::table('hkyl_user') -> where('id',$uid) -> value('price');
      $draw = DB::table('hkyl_draw') -> where('zjid',$uid) -> paginate(10);
      $count =DB::table('hkyl_draw') -> where('zjid',$uid) -> count();
      return view('home.assets.porder',['set' => $set,'huiyi'=>$huiyi,'qiye'=>$qiye,'count'=>$count,'draw'=>$draw,'price'=>$price,'jiaoyu'=>$jiaoyu,'yangsheng'=>$yangsheng,'banner' => $banner,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function delete(Request $request)
    {
      $id = $request -> id;
      $draw = DB::table('hkyl_draw') -> where('id',$id) -> first();
      if($draw -> state != 0)
      {
        return response()->json(['status'=> 0 ,'msg'=>'订单已通过审核,无法删除']);
      }
      $price = $draw -> draw;
      $res = DB::table('hkyl_draw') ->delete($id);
      if($res)
      {
        $uid = session('user') -> id;
        $oprice = DB::table('hkyl_user') -> where('id',$uid) -> value('price');
        $data['price'] = $oprice +$price;
        $xg = DB::table('hkyl_user') -> where('id',$uid) -> update($data);
        return response()->json(['status'=> 1 ,'msg'=>'订单取消成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'订单取消失败']);
      }
    }
}
    


