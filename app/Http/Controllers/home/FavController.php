<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;
use Crypt;

class FavController extends Controller
{
    //收藏的专家
    public function zj()
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
      $zj = DB::table('hkyl_myfavorite As c1') 
      -> LeftJoin('hkyl_user As c2','c1.gid','=','c2.id')
      -> LeftJoin('hkyl_cate As c3','c3.id','=','c2.zhicheng')
      -> select('c1.*','c2.*','c1.id as id','c3.cate as zhicheng')
      -> where('c1.uid',$id) 
      -> where('type',1) 
      ->  paginate(10);

      $keshi = DB::table('hkyl_keshi') -> get();


      return view('home.fav.zj',['set' => $set,'zj'=>$zj,'keshi'=>$keshi,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function deletezj(Request $request)
    {
      $id = $request -> id;
      $res = DB::table('hkyl_myfavorite') -> delete($id);
      if($res)
      {
        return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'删除失败']);
      }
    }
    //收藏的物品
    public function goods()
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
      $good = DB::table('hkyl_myfavorite As c1') 
      -> LeftJoin('hkyl_goods As c2','c1.gid','=','c2.id')
      -> select('c1.*','c2.*','c1.id as id')
      -> where('c1.uid',$id) 
      -> where('type',2) 
      -> paginate(10);
      return view('home.fav.goods',['set' => $set,'good'=>$good,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function deletegoods(Request $request)
    {
      $id = $request -> id;
      $res = DB::table('hkyl_myfavorite') -> delete($id);
      if($res)
      {
        return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'删除失败']);
      }
    }
    //收藏的文章
    public function wz()
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
      $wz = DB::table('hkyl_myfavorite As c1') 
      -> LeftJoin('hkyl_doctor As c2','c1.gid','=','c2.id')
      -> LeftJoin('hkyl_user As c3','c2.uid','=','c3.id')
      -> LeftJoin('hkyl_servexq As c4','c4.gid','=','c2.id')
      -> select('c1.*','c2.*','c1.id as id','c3.uname as zjname','c3.id as zjid','c4.state as status')
      -> where('c1.uid',$id) 
      -> where('c1.type',3) 
      -> paginate(10);
      return view('home.fav.wz',['set' => $set,'wz'=>$wz,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function deletewz(Request $request)
    {
      $id = $request -> id;
      $res = DB::table('hkyl_myfavorite') -> delete($id);
      if($res)
      {
        return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'删除失败']);
      }
    }
}

    


