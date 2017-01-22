<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;

class RecordController extends Controller
{
    public function chat($illid,$zjid)
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

      $blxq = DB::table('hkyl_disease As c1')
      ->leftjoin('hkyl_user As c2','c2.id','=','c1.uid') 
      -> select('c1.*','c2.*','c1.id as id')
      -> where('c1.id',$illid) 
      -> first();
      $zj = DB::table('hkyl_user') -> where('id',$zjid) -> first();
      $zixun = DB::table('hkyl_zixun') -> where('bid',$illid) -> where('zjid',$zjid) ->orderBy('zxtime','desc') -> get();
      $state['state'] =1;
      $xg = DB::table('hkyl_zixun') -> where('bid',$illid) -> where('zjid',$zjid) ->where('type',1)-> update($state);
      return view('home.record.chat',['set' => $set,'zixun'=>$zixun,'qiye'=>$qiye,'blxq'=>$blxq,'zj'=>$zj,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function chatzj($illid,$zjid)
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

      $blxq = DB::table('hkyl_disease As c1')
      ->leftjoin('hkyl_user As c2','c2.id','=','c1.uid') 
      -> select('c1.*','c2.*','c1.id as id')
      -> where('c1.id',$illid) 
      -> first();
      $state['state'] =1;
      $xg = DB::table('hkyl_zixun') -> where('bid',$illid) -> where('zjid',$zjid) ->where('type',0)-> update($state);
      $zj = DB::table('hkyl_user') -> where('id',$zjid) -> first();
      $zixun = DB::table('hkyl_zixun') -> where('bid',$illid) -> where('zjid',$zjid) ->orderBy('zxtime','desc') -> get();

      return view('home.record.chatzj',['set' => $set,'zixun'=>$zixun,'qiye'=>$qiye,'blxq'=>$blxq,'zj'=>$zj,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    
    public function zixun(Request $request)
    {
      $data = $request -> except('_token');
      $onum = DB::table('hkyl_disease') -> where('id',$data['bid']) -> value('zxnum');
      if($onum == 0)
      {
        return  back() -> with(['zxs' => '咨询条数已用完,请先购买']);
      }
      $data['zxtime'] = time();
      $data['type'] = 0;
      $data['uid'] = session('user') -> id;
      $res = DB::table('hkyl_zixun') -> insert($data);
      if($res)
      {
        $num['zxnum'] = $onum -1;
        $xg = DB::table('hkyl_disease') -> where('id',$data['bid']) -> update($num);
        return back() -> with(['zx' => '咨询成功']);
      }else{
        return back() -> with(['zxd' => '咨询条数已用完,请先购买']);
      }
      
    }
    public function huifu(Request $request)
    {
      $data = $request -> except('_token');
      $uid = DB::table('hkyl_disease') -> where('id',$data['bid']) -> value('uid');
      $data['uid'] = $uid;
      $data['zxtime'] = time();
      $data['type'] = 1;
      $res = DB::table('hkyl_zixun') -> insert($data);
      if($res)
      {
        return back() -> with(['zx' => '回复成功']);
      }else{
        return back() -> with(['zxd' => '回复失败,请重试']);
      }
      
    }
    public function ajax($illid,$zjid)
    {
      $res = DB::table('hkyl_zixun') -> where('bid',$illid) -> where('zjid',$zjid) -> where('type',0) -> where('state',0) -> first();
      if($res)
      {
        return response()->json(['status'=> 1,'illid'=>$illid,'zjid'=>$zjid]);
      }else{
        return response()->json(['status'=> 0]);
      }
    }
    public function ajaxhf()
    {
      $uid = session('user') -> id;
      $res = DB::table('hkyl_zixun') -> where('zjid',$uid) -> where('type',0) -> where('state',0) -> first();
      if($res)
      {
         return response()->json(['status'=> 1]);
       }else{
         return response()->json(['status'=> 0]);
       }
    }
    public function ajaxzx()
    {
      $uid = session('user') -> id;
      $res = DB::table('hkyl_zixun') -> where('uid',$uid) -> where('type',1)-> where('state',0) -> first();
      if($res)
      {
         return response()->json(['status'=> 1]);
       }else{
         return response()->json(['status'=> 0]);
       }
    }
    public function ajaxzj($illid,$zjid)
    {
      $res = DB::table('hkyl_zixun') -> where('bid',$illid) -> where('zjid',$zjid) -> where('type',1) -> where('state',0) -> first();
      if($res)
      {
        return response()->json(['status'=> 1,'illid'=>$illid,'zjid'=>$zjid]);
      }else{
        return response()->json(['status'=> 0]);
      }
    }
    public function pj($id)
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

       return view('home.record.pj',['set' => $set,'id'=>$id,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function pjwz($id)
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

       return view('home.record.pjwz',['set' => $set,'id'=>$id,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function goodspj($id)
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

       return view('home.record.goodspj',['set' => $set,'id'=>$id,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function pjtj(Request $request)
    {
      $data = $request -> except('_token');
      $id = $data['id'];
      unset($data['id']);
      $uid = session('user') -> id;
      $serve  = DB::table('hkyl_myserve') -> where('id',$id) -> first();
      $servexq = DB::table('hkyl_servexq') -> where('servenum',$serve -> servenum) -> first();
      $data['zjid'] = $servexq -> zjid;
      $data['time'] = time();
      $data['uid'] = $uid;
      $data['servenum'] = $serve -> servenum;
      $data['type'] = 0;
      $res = DB::table('hkyl_appraise') -> insert($data);
      if($res)
      {
        $xgzj['pjstate'] = 1;
        $xg = DB::table('hkyl_myserve') -> where('id',$id) -> update($xgzj);
        return redirect('/order/serve')->with(['pjzj'=>'评价成功']);
      }else{
        return back() -> with(['pjzjd' => '评价失败,请重试']);
      }
     
    }
    public function wztj(Request $request)
    {
      $data = $request -> except('_token');
      $id = $data['id'];
      unset($data['id']);
      $uid = session('user') -> id;
      $serve  = DB::table('hkyl_myserve') -> where('id',$id) -> first();
      $servexq = DB::table('hkyl_servexq') -> where('servenum',$serve -> servenum) -> first();
      $data['zjid'] = $servexq -> gid;
      $data['time'] = time();
      $data['uid'] = $uid;
      $data['servenum'] = $serve -> servenum;
      $data['type'] = 2;
      $res = DB::table('hkyl_appraise') -> insert($data);
      if($res)
      {
        $xgwz['pjstate'] = 1;
        $xg = DB::table('hkyl_myserve') -> where('id',$id) -> update($xgwz);
        return redirect('/order/serve')->with(['pjzj'=>'评价成功']);
      }else{
        return back() -> with(['pjzjd' => '评价失败,请重试']);
      }
     
    }
    public function goodstj(Request $request)
    {
      $data = $request -> except('_token');
      $id = $data['id'];
      unset($data['id']);
      
      $goods = DB::table('hkyl_myorder') -> where('id',$id) -> first();
      $uid = session('user') -> id;
      $goodsxq = DB::table('hkyl_orderxq') -> where('unumber',$goods -> onumber) -> get();
      foreach($goodsxq as $xq)
      {
        $data['zjid'] = $xq -> gid;
        $data['time'] = time();
        $data['uid'] = $uid;
        $data['servenum'] = $xq -> unumber;
        $data['type'] = 1;
        $res = DB::table('hkyl_appraise') ->insert($data);
      }
      if($res)
      {
        $xggood['pjstate'] = 1;
        $xg = DB::table('hkyl_myorder') -> where('id',$id) -> update($xggood);
        return redirect('/order/goods')->with(['pjzj'=>'评价成功']);
      }else{
        return back() -> with(['pjzjd' => '评价失败,请重试']);
      }
    }
}
    


