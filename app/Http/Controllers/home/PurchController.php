<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;

class PurchController extends Controller
{
    //企业采购 
    public function caigou(Request $request)
    {   
      $data = $request -> except('_token');
      
      $data['qyid'] = session('user') -> id;
      $data['purtime'] = time();
      $pd = DB::table('hkyl_purch') -> where('qyid',$data['qyid']) -> where('gid',$data['gid']) ->first();
      if(empty($pd))
      {
        $res = DB::table('hkyl_purch') -> insert($data);
      }else{
        $onum = $pd -> number;
        $n['number'] = $onum + $data['number'];
        $n['purtime'] = time();
        $xg = DB::table('hkyl_purch') -> where('id',$pd->id) -> update($n);  
      }
      return back()->with(['purch'=>'采购成功']);
    }
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
      $banner = DB::table('hkyl_banner') -> where('id','=','2') -> first();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;

      $qyid = session('user') -> id;
      $purch = DB::table('hkyl_purch As c1')
      -> leftJoin('hkyl_hickey As c2','c2.id','=','c1.gid')
      -> select('c1.*','c2.*','c1.id as id') 
      -> where('c1.qyid',$qyid) 
      -> paginate(10);
     $count = DB::table('hkyl_purch') -> where('qyid',$qyid) -> count();
      return view('home.purch.index',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'purch'=>$purch,'yangsheng'=>$yangsheng,'count'=>$count,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    
    public function delete(Request $request)
    {
      $id = $request -> id;
      $qyid = session('user') -> id;
      $res = DB::table('hkyl_purch') -> where('qyid',$qyid) -> delete($id);
      if($res)
      {
        return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'删除失败']);
      }
    }
    public function add()
    {
      $qyid = session('user') -> id;
      $caigou = DB::table('hkyl_purch') -> where('qyid',$qyid) -> get();
      if(empty($caigou))
      {
        return back() -> with(['cg'=>'物品为空无法生成采购单']);
      }
      $data['cgnum'] = 'C'.rand(1000,9999).time();
      $data['cgtime'] = time();
      $data['qyid'] = $qyid;
      $cg = DB::table('hkyl_caigou') -> insert($data);
      if($cg)
      {
          foreach($caigou as $cg)
          {
            $xq['cgnum'] = $data['cgnum'];
            $xq['gid'] = $cg -> gid;
            $xq['number'] = $cg -> number ;
            $cgxq = DB::table('hkyl_cgxq') -> insert($xq);
            $sc = DB::table('hkyl_purch') -> delete($cg -> id);
          }
          return redirect('/purch/cg')->with(['cg'=>'订单创建成功']);
      }else
      {
          return back() ->with(['cgd'=>'订单创建失败']);
      }
      
    }
    public function cg()
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

      $qyid = session('user') -> id;
      $purch = DB::table('hkyl_caigou')
      -> where('qyid',$qyid) 
      -> paginate(10);
      $count = DB::table('hkyl_caigou') -> where('qyid',$qyid) -> count();
      return view('home.purch.cg',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'purch'=>$purch,'yangsheng'=>$yangsheng,'count'=>$count,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function del(Request $request)
    {
      $id = $request -> id;
      $cg = DB::table('hkyl_caigou') -> where('id',$id) -> first();
      $del = DB::table('hkyl_caigou') -> delete($id);
      if($del)
      {
        $xq = DB::table('hkyl_cgxq') -> where('cgnum',$cg -> cgnum) -> get();
        foreach ($xq as $cgxq) {
          $delete = DB::table('hkyl_cgxq') -> delete($cgxq -> id);
        }
        return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'删除失败']);
      }
    }
    public function cgxq($id)
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

      
      $purch = DB::table('hkyl_caigou') -> where('id',$id) -> first();

      $cgxq =DB::table('hkyl_cgxq As c1') 
      -> leftJoin('hkyl_hickey As c2','c2.id','=','c1.gid')
      -> select('c1.*','c2.*')
      -> where('c1.cgnum',$purch -> cgnum) 
      -> get();

      return view('home.purch.cgxq',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'purch'=>$purch,'cgxq'=>$cgxq,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function qysc(Request $request)
    {
      $gid = $request -> id;
      $qyid = session('user') -> id;
      $pd  = DB::table('hkyl_qysc') -> where('gid',$gid) -> where('qyid',$qyid) -> first();
      if($pd)
      {
         return response()->json(['status'=> 0 ,'msg'=>'已被收藏过']);
      }
      $data['qyid'] = $qyid;
      $data['gid'] = $gid;
      $sc = DB::table('hkyl_qysc') -> insert($data);
      if($sc)
      {
         return response()->json(['status'=> 1 ,'msg'=>'收藏成功']);
       }else{
         return response()->json(['status'=> 0 ,'msg'=>'收藏失败']);
       }
    }
    public function sc()
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
      $good = DB::table('hkyl_qysc As c1') 
      -> LeftJoin('hkyl_hickey As c2','c1.gid','=','c2.id')
      -> select('c1.*','c2.*','c1.id as id')
      -> where('c1.qyid',$id) 
      -> paginate(10);
      $count = DB::table('hkyl_qysc') -> where('qyid',$id) -> count();
      return view('home.purch.sc',['set' => $set,'good'=>$good,'count'=>$count,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function deletegoods(Request $request)
    {
      $id = $request -> id;
     
      $res = DB::table('hkyl_qysc') -> delete($id);
      if($res)
        {
           return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
        }else{
           return response()->json(['status'=> 0 ,'msg'=>'删除失败']);
        }
    }
    public function ajax()
    {
      $res= DB::table('hkyl_winmsd') -> where('wstate','0') -> first();
      if($res)
      {
        return response()->json(['status'=> 1]);
      }else{
        return response()->json(['status'=> 0]);
      }
    }
}
    


