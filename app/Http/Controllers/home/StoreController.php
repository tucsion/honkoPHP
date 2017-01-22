<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;

class StoreController extends Controller
{
    //商品列表
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
      $keshi = DB::table('hkyl_keshi') -> orderby('id') -> get();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id')-> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $scope = DB::table('hkyl_scope') -> orderBy('id') -> get();
      //首页导航栏状态
      $xuanzhe = 7;
      $res = DB::table('hkyl_goods As c1') 
      ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
      ->select('c1.*','c2.*',DB::raw("c1.id as id"))
      ->orderBy('c1.id')
      -> paginate(6);
      $rank = DB::table('hkyl_data As c1')
      ->LeftJoin('hkyl_goods As c2','c2.id','=','c1.gid')
      ->select('c1.*','c2.*',DB::raw("c1.id as id"))
      -> orderBy('c1.salenum','DESC')
      -> take(4) -> get(); 

      $i = 1;
     //保存选择的状态
      $sort = 'sort=0';
      $range = 'range=0';
      $xl = 'xl = 0';
      $jg = 'jg =0';
      session(['sort' => $sort]);
      session(['range' => $range]);
      session(['xl' => $xl]);
      session(['jg' => $jg]);
      if(empty(session('user')))
      {
        $scan ='';
      }else{
        $scan = DB::table('hkyl_scan As c1') 
        -> LeftJoin('hkyl_goods As c2','c2.id','=','c1.gid')
        -> select('c1.*','c2.*','c2.id as id')
        -> where('c1.uid',session('user') -> id) 
        -> orderBy('scantime','desc') 
        -> take(3) 
        -> get();
      }
     
    	return view('home.store.index',['set' => $set,'scan'=>$scan,'res'=>$res,'i'=>$i,'rank'=>$rank,'scope'=>$scope,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'sort'=>$sort,'jiaoyu'=>$jiaoyu,'range'=>$range,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'keshi' => $keshi,'xuanzhe' => $xuanzhe]);
    }
    public function goodlist($id)
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
      $scope = DB::table('hkyl_scope') -> orderBy('id') -> get();
      $rank = DB::table('hkyl_data As c1')
      ->LeftJoin('hkyl_goods As c2','c2.id','=','c1.gid')
      ->select('c1.*','c2.*',DB::raw("c1.id as id"))
      -> orderBy('c1.salenum','DESC')
      -> take(4) -> get(); 
      $zhi = substr($id,0,1);
      $i = 1;
      $s = substr(session('sort'),0,1);
      $r = substr(session('range'),0,1);
      $x = substr(session('xl'),0,1);
      $j = substr(session('jg'),0,1);
      
     
      if($zhi == $s)
      {
        session(['sort' => $id]);
       
      }elseif($zhi == $r)
      {
        session(['range' => $id]);
      }elseif($zhi == $x)
      {
        session(['xl' => $id]);
      }elseif($zhi == $j)
      {
        session(['jg' => $id]);
      }
     
      $sort = substr(strrchr(session('sort'), "="),1);
      $range = substr(session('range'),-1);
      $xl = substr(session('xl'),-1);
      $jg = substr(session('jg'),-1);
     
      if($sort != 0 )
      {
        if($range != 0)
        {
          if($xl != 0)
          {
            if($jg != 0)
            {
              if($jg == 1)
              {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.cid','=',$sort)
              ->where('c1.scope','=',$range)
              ->orderBy('c1.price')
              ->orderBy('c2.salenum','DESC')
              ->paginate(6);
              }elseif($jg == 2)
              {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.cid','=',$sort)
              ->where('c1.scope','=',$range)
              ->orderBy('c1.price','DESC')
              ->orderBy('c2.salenum','DESC')
              ->paginate(6);
              }
            }else{
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.cid','=',$sort)
              ->where('c1.scope','=',$range)
              ->orderBy('c2.salenum','DESC')
              ->paginate(6);
            }
          }else{
            if($jg != 0)
            {
              if($jg == 1)
              {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.cid','=',$sort)
              ->where('c1.scope','=',$range)
              ->orderBy('c1.price')
              ->paginate(6);
              }elseif($jg == 2)
              {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.cid','=',$sort)
              ->where('c1.scope','=',$range)
              ->orderBy('c1.price','DESC')
              ->paginate(6);
              }
            }else{
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.cid','=',$sort)
              ->where('c1.scope','=',$range)
              ->orderBy('c1.id')
              ->paginate(6);
            }
          }
        }else{
          if($xl != 0)
          {
            if($jg != 0)
            {
              if($jg == 1)
              {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.cid','=',$sort)
              ->orderBy('c1.price')
              ->orderBy('c2.salenum','DESC')
              ->paginate(6);
              }elseif($jg == 2)
              {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.cid','=',$sort)
              ->orderBy('c1.price')
              ->orderBy('c2.salenum','DESC')
              ->paginate(6);
              }
            }else{
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.cid','=',$sort)
              ->orderBy('c2.salenum','DESC')
              ->paginate(6);
            }
          }else{
          if($jg !=0)
          {
            if($jg == 1)
            {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.cid','=',$sort)
              ->orderBy('c1.price')
              ->paginate(6);
            }elseif($jg == 2)
            {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.cid','=',$sort)
              ->orderBy('c1.price','DESC')
              ->paginate(6);
            }
          }else{

            $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.cid','=',$sort)
              ->orderBy('c1.id')
              ->paginate(6);
            
          }
          }
        }
      }else{
        if($range != 0)
        {
          if($xl != 0){
            if($jg != 0)
            {
              if($jg == 1)
              {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.scope','=',$range)
              ->orderBy('c1.price')
              ->orderBy('c2.salenum','DESC')
              ->paginate(6);
              }elseif($jg == 2)
              {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.scope','=',$range)
              ->orderBy('c1.price','DESC')
              ->orderBy('c2.salenum','DESC')
              ->paginate(6);
              }
            }else{
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.scope','=',$range)
              ->orderBy('c2.salenum','DESC')
              ->paginate(6);
            }
          }else{
            if($jg != 0)
            {
              if($jg == 1)
              {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.scope','=',$range)
              ->orderBy('c1.price')
              ->paginate(6);
              }elseif($jg == 2)
              {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.scope','=',$range)
              ->orderBy('c1.price','DESC')
              ->paginate(6);
              }
            }else{
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->where('c1.scope','=',$range)
              ->orderBy('c1.id')
              ->paginate(6);
            }
          }
        }else{
          if($xl != 0)
          {
            if($jg != 0)
            {
              if($jg == 1)
              {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->orderBy('c1.price')
              ->orderBy('c2.salenum','DESC')
              ->paginate(6);
              }elseif($jg == 2)
              {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->orderBy('c1.price','DESC')
              ->orderBy('c2.salenum','DESC')
              ->paginate(6);
              }
            }else{
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->orderBy('c2.salenum','DESC')
              ->paginate(6);
              }
            }
          else{
            if($jg != 0)
            {
              if($jg == 1 )
              {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->orderBy('c1.price')
              ->paginate(6);
              }elseif($jg == 2)
              {
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->orderBy('c1.price','DESC')
              ->paginate(6);
              }
            }else{
              $res = DB::table('hkyl_goods As c1') 
              ->LeftJoin('hkyl_data As c2','c2.gid','=','c1.id')
              ->select('c1.*','c2.*',DB::raw("c1.id as id"))
              ->orderBy('c1.id')
              ->paginate(6);
            }
          }
        }
      }
        
          
      
      //首页导航栏状态
      $xuanzhe = 2;
      
      return view('home.store.goodlist',['set' => $set,'sort'=>$sort,'range'=>$range,'i'=>$i,'rank'=>$rank,'qiye'=>$qiye,'huiyi'=>$huiyi,'jiaoyu'=>$jiaoyu,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'scope'=>$scope,'keshi' => $keshi,'yangsheng'=>$yangsheng,'xuanzhe' => $xuanzhe,'res'=>$res]);
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
      $keshi = DB::table('hkyl_keshi') -> orderby('id') -> get();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id')-> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $scope = DB::table('hkyl_scope') -> orderBy('id') -> get();
      //首页导航栏状态
      $xuanzhe = 7;
      $xq =DB::table('hkyl_goods') -> where('id','=',$id) ->first();
      $gxq =DB::table('hkyl_data') -> where('gid','=',$id) -> first();
      $hit = $gxq -> hits + 1;
      $res = DB::table('hkyl_data') -> where('gid','=',$id) -> update(['hits' => $hit]);
      $scan = '';
      if(!empty(session('user')))
      {
        $uid = session('user') -> id;
        $scan['uid'] = $uid;
        $scan['gid'] = $id;
        $scan['scantime'] = time();
        $pd = DB::table('hkyl_scan') -> where('uid',$uid) -> orderBy('scantime','desc') -> first();
        if(empty($pd))
        {
          $liulan = DB::table('hkyl_scan') -> insert($scan);
        }elseif ($pd -> gid != $id) {
           $liulan = DB::table('hkyl_scan') -> insert($scan);
        }
       
      }
      $con = DB::table('hkyl_appraise') -> where('zjid',$id) -> where('type',1) -> count();
      $pingjia = DB::table('hkyl_appraise As c1')
      -> LeftJoin('hkyl_user As c2','c2.id','=','c1.uid')
      -> select('c1.*','c2.*')
       -> where('zjid',$id) 
       -> where('type',1) 
       -> paginate(5);
      return view('home.store.detail',['set' => $set,'scope'=>$scope,'gxq'=>$gxq,'pingjia'=>$pingjia,'con'=>$con,'xq'=>$xq,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'jiaoyu'=>$jiaoyu,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'keshi' => $keshi,'xuanzhe' => $xuanzhe]);
    }
    public function goodscar(Request $request)
    {
       $data=$request->except('_token');
       $number = $data['number'];
       if(empty(session('user')))
       {
        return json_encode($uid = 0);
       }
       if(session('user') -> utp != 1)
       {
        return json_encode($uid = 3);
       }
       $data['uid'] = session('user') -> id;
       $pd = DB::table('hkyl_goodscar') -> where('uid',$data['uid']) -> where('gid',$data['gid'])->first();
       if(empty($pd))
       {
        $res = DB::table('hkyl_goodscar') -> insert($data);
      }else{
        $data['number'] = $pd -> number + $number;
        $res =DB::table('hkyl_goodscar') -> where('id',$pd -> id)-> update($data);
      }
        
       if($res)
       {
          return json_encode($uid = 1);
       }else{
          return json_encode($uid = 2);
       }

    }
    public function goodsc($id)
    {
      if(empty(session('user')))
      {
        return back() -> with(['login' => '还未登录']);
      }
      if(session('user') -> utp != 1)
      {
         return back() -> with(['utp1' => '还未登录']);
      }
      $data = '';
      $uid = session('user') -> id;
      $good = DB::table('hkyl_goods') -> where('id',$id) -> first();
      $favname = $good -> gname;
      $gid = $id;
      $type = 2;
      $data['uid'] =$uid;
      $data['favname'] = $favname;
      $data['gid'] = $gid;
      $data['type'] = $type;
      $pd = DB::table('hkyl_myfavorite') -> where('uid',$uid) -> where('favname',$good -> gname) ->first();
      if($pd)
      {
        return back() -> with(['sc'=>'已被收藏过']);
      }
      $res = DB::table('hkyl_myfavorite') -> insert($data);

      if($res)
      {
        return redirect('/store/detail/'.$gid)->with(['goodsc'=>'收藏成功']);
      }else{
        return back() -> with(['goodscd' => '收藏失败']);
      }
    }
}
    


    


