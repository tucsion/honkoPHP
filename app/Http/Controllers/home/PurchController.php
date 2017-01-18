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
    }
    
}
    


