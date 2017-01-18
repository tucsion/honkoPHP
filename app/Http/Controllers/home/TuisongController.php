<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;
use Crypt;

class TuisongController extends Controller
{
 
    public function ajax()
    {
      $uid = session('user') -> id;
      $tuisong = DB::table('hkyl_tuisong') -> where('state','0') -> where('zjid',$uid) -> first();
      
      if($tuisong)
      {
        return response() -> json(['state'=>1]);
      }else{
        return response() -> json(['state'=>0]);
      }
    }
    public function xitong()
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
      $banner = DB::table('hkyl_banner') -> where('id','=','2') -> first();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;

      $uid = session('user') -> id;
      $ts = DB::table('hkyl_tuisong As c1')
      ->leftJoin('hkyl_disease As c2','c2.id','=','c1.bid')
      ->leftJoin('hkyl_cases As c3','c3.id','=','c2.cid')
      -> leftJoin('hkyl_user As c4','c4.id','=','c3.uid')
      -> select('c1.*','c2.*','c3.*','c4.headurl','c1.id as id')
       -> where('c1.zjid',$uid) 
       ->get();

       $keshi = DB::table('hkyl_keshi') -> get();
      
       return view('home.tuisong.xitong',['set' => $set,'qiye'=>$qiye,'keshi'=>$keshi,'huiyi'=>$huiyi,'ts'=>$ts,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function delete(Request $request)
    {
      $id = $request -> id;
       $res = DB::table('hkyl_tuisong') -> delete($id);
       if($res)
       {
        return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'删除失败']);
      }
    }
    public function deletegz(Request $request)
    {
      $id = $request -> id;
       $res = DB::table('hkyl_follow') -> delete($id);
       if($res)
       {
        return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'删除失败']);
      }
    }
    public function follow(Request $request)
    {
      $id = $request -> id;
      $zjid = session('user') -> id;
      $time = time();
      $bid = DB::table('hkyl_tuisong') -> where('id',$id) -> value('bid');
      $data['bid'] = $bid;
      $data['zjid'] = $zjid;
      $data['gztime'] = $time;
      $gz = DB::table('hkyl_follow') -> where('zjid',$zjid) -> where('bid',$bid) -> first();
      if(!empty($gz))
      {
        return response() -> json(['status'=> 0 ,'msg'=>'已经关注过此病例']);
      }
      $res = DB::table('hkyl_follow') -> insert($data);
      if($res)
      {
        $aa['state'] =1;
        $aa = DB::table('hkyl_tuisong') ->where('id',$id) -> update($aa);
        return response()->json(['status'=> 1 ,'msg'=>'关注成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'关注失败']);
      }
    }
    public function gz()
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
      $banner = DB::table('hkyl_banner') -> where('id','=','2') -> first();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;

      $uid = session('user') -> id;
      $gz = DB::table('hkyl_follow As c1')
      -> leftJoin('hkyl_disease As c2','c2.id','=','c1.bid')
      -> leftJoin('hkyl_user As c3','c3.id','=','c2.uid')
      -> leftJoin('hkyl_cases As c4','c4.id','=','c2.cid')
      -> select('c1.*','c2.*','c4.*','c3.headurl','c1.id as id') 
      -> where('c1.zjid',$uid) 
      -> paginate(10);
      
      $keshi = DB::table('hkyl_keshi') -> get();
      return view('home.tuisong.gz',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'keshi'=>$keshi,'gz'=>$gz,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function blxq($id)
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
      $banner = DB::table('hkyl_banner') -> where('id','=','2') -> first();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;

      
      $bl =  DB::table('hkyl_disease') -> where('id',$id) -> first();
      if(empty($bl))
      {
       return back() -> with(['blxq'=>'地址添加成功']);
      }
       if(!empty($bl -> baogaoimg))
      
      {
        $bl -> baogaoimg = unserialize($bl -> baogaoimg);
      }
      if(!empty($bl->meteimg))
      {
        $bl -> meteimg = unserialize($bl->meteimg);
       
      }
      if(!empty($bl-> emrimg))
      {
        $bl -> emrimg = unserialize($bl->emrimg);
        
      }
      $rw = DB::table('hkyl_cases') -> where('id',$bl -> cid) -> first();
      return view('home.tuisong.blxq',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'bl'=>$bl,'rw'=>$rw,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);

    }
}
    


