<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;
use Crypt;

class MessageController extends Controller
{
    //系统消息
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
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;

     
      $xitong = DB::table('hkyl_winmsd') -> paginate(10);
      return view('home.message.xitong',['set' => $set,'qiye'=>$qiye,'xitong'=>$xitong,'huiyi'=>$huiyi,'jiaoyu'=>$jiaoyu,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'yangsheng'=>$yangsheng,'xuanzhe' => $xuanzhe]);  
    }
    public function xitongxq(Request $request)
    {
      $id = $request -> id;
      $xq = DB::table('hkyl_winmsd') -> where('id',$id) -> first();
      return view('home.message.xitongxq',['xq' => $xq]);
    }
    public function ajaxupdate()
    {
      
      $id = $_GET['id'];
      
      $res = DB::table('hkyl_winmsd') -> where('id',$id) -> update('wstate',1);
    }
    public function myword()
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
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;

      $uid = session('user') -> id;
      $word = DB::table('hkyl_message As c1') 
      -> leftJoin('hkyl_user As c2','c2.id','=','c1.zjid')
      -> select('c1.*','c2.uname')
      -> where('c1.uid',$uid)
      -> where('c1.type','!=',3)
      -> orderBy('messtime','desc')
      -> paginate(5);

      return view('home.message.myword',['set' => $set,'qiye'=>$qiye,'word'=>$word,'huiyi'=>$huiyi,'jiaoyu'=>$jiaoyu,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'yangsheng'=>$yangsheng,'xuanzhe' => $xuanzhe]); 
    }
    public function mywordxq(Request $request)
    {
      $id = $request -> id;
      $data['state'] = 1;
      $res = DB::table('hkyl_message') -> where('id',$id) -> update($data);
      if($res)
      {
        return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'删除成功']);
      }
    }
    public function deal()
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
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;
      $uid = session('user') -> id;
      $deal = DB::table('hkyl_mynews') -> where('uid',$uid) -> orderBy('newstime','desc') ->paginate(5);
      return view('home.message.deal',['set' => $set,'qiye'=>$qiye,'deal'=>$deal,'huiyi'=>$huiyi,'jiaoyu'=>$jiaoyu,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'yangsheng'=>$yangsheng,'xuanzhe' => $xuanzhe]); 
    }
    public function dealxq(Request $request)
    {
      $id = $request -> id;
      $xq = DB::table('hkyl_mynews') -> where('id',$id) -> first();
      $data['newsstate'] = 1;
      $res = DB::table('hkyl_mynews') -> where('id',$id) -> update($data);
      return view('home.message.dealxq',['xq' => $xq]);
    }
    public function deleteword(Request $request)
    {

      $id = $request -> id ;
      $res = DB::table('hkyl_message') ->delete($id);
      if($res)
      {
         return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'删除失败']);
      }
    }
    public function deletedeal(Request $request)
    {

      $id = $request -> id ;
      $res = DB::table('hkyl_mynews') ->delete($id);
      if($res)
      {
         return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'删除失败']);
      }
    }
    public function zixun()
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
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;

      $uid = session('user') -> id;
      $bl = DB::table('hkyl_disease') -> where('uid',$uid) -> get();
      
      return view('home.message.zixun',['set' => $set,'qiye'=>$qiye,'bl'=>$bl,'huiyi'=>$huiyi,'jiaoyu'=>$jiaoyu,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'yangsheng'=>$yangsheng,'xuanzhe' => $xuanzhe]);  
    }
}

    


