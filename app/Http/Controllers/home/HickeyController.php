<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;

class HickeyController extends Controller
{
    //康复器械园
    public function index()
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
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 5;
      
      
      
    	return view('home.hickey.index',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'jiaoyu'=>$jiaoyu,'yangsheng'=>$yangsheng,'banner' => $banner,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function qxlist($id)
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
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 5;
      //页面数据
      $qx =DB::table('hkyl_cate') -> where('id','=',$id) -> first();
      $qxlist = DB::table('hkyl_hickey') -> where('cid','=',$id) -> orderBy('id') -> paginate(8);
       
      
      return view('home.hickey.qxlist',['set' => $set,'qiye'=>$qiye,'qx'=>$qx,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'jiaoyu'=>$jiaoyu,'banner' => $banner,'expert' => $expert,'train' => $train,'ys' => $ys,'id'=>$id,'qxlist'=>$qxlist,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
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
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 5;
      //页面数据
      $xq =DB::table('hkyl_hickey') -> where('id','=',$id) -> first();
      $flei = DB::table('hkyl_cate') -> where('id','=',$xq -> cid) -> first();
      $fenlei = DB::table('hkyl_scope') -> where('id','=',$xq -> scope) -> first();
      $vender = DB::table('hkyl_vender') -> where('id','=',$xq -> vender) -> first();
      $agent = DB::table('hkyl_agent') -> where('id','=',$xq -> agent) -> first();
      
      return view('home.hickey.detail',['set' => $set,'flei'=>$flei,'agent'=>$agent,'fenlei'=>$fenlei,'vender'=>$vender,'qiye'=>$qiye,'xq'=>$xq,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'jiaoyu'=>$jiaoyu,'banner' => $banner,'expert' => $expert,'train' => $train,'ys' => $ys,'id'=>$id,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }


    
}
    


