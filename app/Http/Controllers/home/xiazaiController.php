<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


class XiazaiController extends Controller
{
    public function pay($id)
    {
      $data = [];
      $xq =[];
        $uid = session('user') -> id;
        $gid = $id;
        $servetime =time();
        $servenum = 'X'.rand(1000,9999).time();
        $type = 1;
        $data['uid'] = $uid;
        $data['servenum'] = $servenum;
        $data['servetime'] =$servetime;
        $data['price'] = '10.00';
        $data['state'] = 0;
        $data['type'] = $type;
        $xq['servenum'] = $servenum;
        $xq['gid'] = $gid;
        $xq['uid'] = $uid;
        

        $res = DB::table('hkyl_myserve') -> insert($data);
        $da = DB::table('hkyl_servexq') -> insert($xq);
        if($res)
        {
          return redirect('/xiazai/ddxq/'.$data['servenum']);
        }
    }
    public function ddxq($num)
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
      $keshi = DB::table('hkyl_keshi') -> orderby('id') -> get();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id')-> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xq = DB::table('hkyl_myserve As c1') 
      -> leftJoin('hkyl_servexq As c2','c2.servenum','=','c1.servenum')
      -> leftJoin('hkyl_doctor As c3','c3.id','=','c2.gid')
      -> leftJoin('hkyl_user As c4','c4.id','=','c3.uid')
      -> select('c1.*','c4.uname','c3.name')
      -> where('c1.servenum',$num) 
      -> first();
      //首页导航栏状态
      $xuanzhe = 1;
      return view('home.xiazai.ddxq',['set' => $set,'xq'=>$xq,'qiye'=>$qiye,'huiyi'=>$huiyi,'jiaoyu'=>$jiaoyu,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'keshi' => $keshi,'yangsheng'=>$yangsheng,'xuanzhe' => $xuanzhe]);       
    }
    public function queren($id)
    {
      $set = DB::table('hkyl_set') -> first();
      $expert = DB::table('hkyl_cate') -> where('pid','=','2') -> orderBy('id') -> get() ;
      $train = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> get();
      $ys = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> get();
      $hickey = DB::table('hkyl_cate') -> where('pid','=','5') -> orderBy('id') -> get();
      $procure = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> get();
      $goods = DB::table('hkyl_cate') -> where('pid','=','9') -> orderBy('id') -> get();
      $health = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> get();
      $keshi = DB::table('hkyl_keshi') -> orderby('id') -> get();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id')-> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      //首页导航栏状态
      $xuanzhe = 1;
      $dd = DB::table('hkyl_myserve') -> where('id',$id) -> first();
      return view('home.xiazai.queren',['set' => $set,'dd'=>$dd,'qiye'=>$qiye,'huiyi'=>$huiyi,'jiaoyu'=>$jiaoyu,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'keshi' => $keshi,'yangsheng'=>$yangsheng,'xuanzhe' => $xuanzhe]);  
    }
    public function fanhui()
    {
      $set = DB::table('hkyl_set') -> first();
      $expert = DB::table('hkyl_cate') -> where('pid','=','2') -> orderBy('id') -> get() ;
      $train = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> get();
      $ys = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> get();
      $hickey = DB::table('hkyl_cate') -> where('pid','=','5') -> orderBy('id') -> get();
      $procure = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> get();
      $goods = DB::table('hkyl_cate') -> where('pid','=','9') -> orderBy('id') -> get();
      $health = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> get();
      $keshi = DB::table('hkyl_keshi') -> orderby('id') -> get();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id')-> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      //首页导航栏状态
      $xuanzhe = 1;
    
      return view('home.xiazai.fanhui',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'jiaoyu'=>$jiaoyu,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'keshi' => $keshi,'yangsheng'=>$yangsheng,'xuanzhe' => $xuanzhe]);  
    }

}
    


