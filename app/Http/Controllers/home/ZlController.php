<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;

class ZlController extends Controller
{
    //康复资讯
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
      $banner = DB::table('hkyl_banner') -> where('id','=','4') -> first();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;
      //页面数据
      $uid = session('user') -> id;
      $wz = DB::table('hkyl_doctor') -> where('uid',$uid) -> paginate(15);
      
    	return view('home.zl.index',['set' => $set,'huiyi'=>$huiyi,'qiye'=>$qiye,'wz'=>$wz,'jiaoyu'=>$jiaoyu,'yangsheng'=>$yangsheng,'banner' => $banner,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function add()
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
      $banner = DB::table('hkyl_banner') -> where('id','=','4') -> first();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;

      return view('home.zl.add',['set' => $set,'huiyi'=>$huiyi,'qiye'=>$qiye,'jiaoyu'=>$jiaoyu,'yangsheng'=>$yangsheng,'banner' => $banner,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function insert(Request $request)
    {
      $data = $request->except('_token');
      $uid = session('user') -> id;
      $data['uid'] = $uid;
      $res = DB::table('hkyl_doctor') -> insert($data);
      $jf = DB::table('hkyl_user') -> where('id',$uid) -> value('jfnum');
      $num['jfnum'] = $jf + 300;
      $jifen = DB::table('hkyl_user') -> where('id',$uid) -> update($num);
      $add['uid'] = $uid;
      $add['operateid'] = 11;
      $add['operatetime'] = time();
      $add['addup'] = 300;
      $xgadd = DB::table('hkyl_addupxq') -> insert($add);
      if($res)
      {
        return redirect('/home/zl/index')->with(['tj'=>'数据添加成功']);
      }else{
         return back()->with(['tjd'=>'文章添加失败']);
      }
      
    }
    

    
}
    


