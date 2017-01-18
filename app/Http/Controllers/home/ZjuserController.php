<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;
use Crypt;

class ZjuserController extends Controller
{
 
    public function base()
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

      $id = session('user') -> id;
      $user = DB::table('hkyl_user') -> where('id',$id) ->first();
      $keshi = DB::table('hkyl_keshi') -> where('pid','0') -> get();
      return view('home.zjuser.base',['set' => $set,'user'=>$user,'qiye'=>$qiye,'keshi'=>$keshi,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function editzl(Request $request)
    {

      $data = $request -> except('_token');

      $id = session('user') -> id;
     
      unset($data['face']);
      if(!empty($data['keshi']))
      {
        $keshi = $data['keshi'];
      }
      if(!empty($keshi))
      {
        $a = implode(',',$keshi);
        $data['keshi'] = $a;
      }
      if(!empty($data['chuzhen']))
        {
            $chuzhen = $data['chuzhen'];
        }
        

        if(!empty($chuzhen)){
            $c = implode(',', $chuzhen);
            $data['chuzhen'] =$c;
        }
      $res = DB::table('hkyl_user') -> where('id','=',$id) -> update($data);
      if($res)
      {
         return redirect('/home/zjuser/base')->with(['editzl'=>'地址添加成功']);
      }else{
         return back() -> with(['editzld'=>'地址添加成功']);
      }
    }
   
}
    


