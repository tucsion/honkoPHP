<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;

class HealthController extends Controller
{
    //养生养老
    public function index($id)
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
      $banner = DB::table('hkyl_banner') -> where('id','=','3') -> first();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $fenlei = DB::table('hkyl_cate') -> where('id','=',$id)-> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 4;
      //页面数据
      $wz = DB::table('hkyl_health') -> where('cid','=',$id) -> orderBy('addtime') -> paginate(5);
      $wzhang = DB::table('hkyl_health') -> where('cid','=',$id) -> orderBy('addtime') -> first();
      
      
    	return view('home.health.index',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'wz'=>$wz,'jiaoyu'=>$jiaoyu,'wzhang'=>$wzhang,'id'=>$id,'fenlei'=>$fenlei,'yangsheng'=>$yangsheng,'banner' => $banner,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function detail($id)
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
      $banner = DB::table('hkyl_banner') -> where('id','=','3') -> first();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $detail  = DB::table('hkyl_health') -> where('id','=',$id)-> first();
      $fenlei = DB::table('hkyl_cate') -> where('id','=',$detail -> cid)-> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 4;
      //页面数据
      $shang = DB::table('hkyl_health') -> where('id','=','$id - 1') ->first();
      $xia = DB::table('hkyl_health') -> where('id','=','$id + 1') ->first();
      
       
      
      return view('home.health.detail',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'shang'=>$shang,'xia'=>$xia,'detail'=>$detail,'id'=>$id,'fenlei'=>$fenlei,'jiaoyu'=>$jiaoyu,'banner' => $banner,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }

    
}
    


