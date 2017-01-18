<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;
use Crypt;

class ServeController extends Controller
{
    //商品订单
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
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;
      
      $uid = session('user') -> id;
      $order = DB::table('hkyl_myorder As c1')
      -> leftJoin('hkyl_address As c2','c2.id','=','c1.aid')
      -> select('c1.*','c2.uname')
      -> where('c1.uid',$uid)
      -> paginate(5) ;

      return view('home.order.goods',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'order'=>$order,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    //服务订单
    public function serve()
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

      $id = session('user') -> id;
      $serve = DB::table('hkyl_myserve')
      -> where('uid',$id)  
      -> orderBy('id')
      -> paginate(5);
      
      return view('home.order.serve',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'serve'=>$serve,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    } 
    
    //订单删除
    public function delete(Request $request)
    {
      $id = $request -> id;
      $dd = DB::table('hkyl_myorder') -> where('id',$id) -> first();
      $number = $dd -> onumber;
      $xq = DB::table('hkyl_orderxq') -> where('unumber',$number)-> get();
      $res = DB::table('hkyl_myorder') -> delete($id);
      if($res)
      {
         foreach($xq as $goodxq)
         {
          $data = DB::table('hkyl_orderxq') ->delete($goodxq -> id);
         }
      }
      if($data)
      {
        return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'删除失败']);
      }
    }
    //服务订单删除
    public function deleteser(Request $request)
    {

      $id = $request -> id;
      $serve = DB::table('hkyl_myserve') -> where('id',$id) ->first();
      $servenum = $serve -> servenum;
      if($serve -> type == 1)
      {
        $xq = DB::table('hkyl_servexq') -> where('servenum',$servenum) -> first();
        if($xq -> state == 1)
        {
          $res = DB::table('hkyl_myserve') -> delete($serve -> id);

        }else{
          $d = DB::table('hkyl_servexq') -> delete($xq -> id);
          $res = DB::table('hkyl_myserve') -> delete($serve ->id );
        }
       
      }
      if($serve -> type == 0)
      {
        $xq = DB::table('hkyl_myserve') -> where('servenum',$servenum) -> first();
        $d = DB::table('hkyl_servexq') -> delete($xq -> id);
        $res = DB::table('hkyl_myserve') -> delete($serve -> id);
      }
      if($res)
      {
        return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'删除失败']);
      }
    }
    //商品订单详情
    public function goodsxq($id)
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
      $sp = DB::table('hkyl_myorder') -> where('id',$id) -> first();
      $xq = DB::table('hkyl_orderxq As c1') 
      -> leftJoin('hkyl_goods As c2','c2.id','=','c1.gid')
      -> select('c1.*','c2.*')
      -> where('c1.unumber',$sp -> onumber) 
      -> get();
      $dz = DB::table('hkyl_address') -> where('id',$sp -> aid) -> first();
      if(!empty($sp -> bill))
      {
        $fp = DB::table('hkyl_bill') -> where('id',$sp -> bill) -> first();
        return view('home.order.goodsxq',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'fp'=>$fp,'dz'=>$dz,'sp'=>$sp,'xq'=>$xq,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
      }
      return view('home.order.goodsxq',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'dz'=>$dz,'sp'=>$sp,'xq'=>$xq,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
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
      $order = DB::table('hkyl_myorder') -> where('id',$id) -> first();
      $xq = DB::table('hkyl_orderxq As c1') 
      -> leftJoin('hkyl_goods As c2','c2.id','=','c1.gid')
      -> select('c1.*','c2.gname')
      -> where('c1.unumber',$order -> onumber) 
      -> get();
     
     foreach($xq as $goodxq)
     {
      $gname[] = $goodxq -> gname;  
     }
     
     $xqname = implode(',',$gname);
     
       return view('home.order.queren',['set' => $set,'order'=>$order,'xqname'=>$xqname,'qiye'=>$qiye,'huiyi'=>$huiyi,'jiaoyu'=>$jiaoyu,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'keshi' => $keshi,'yangsheng'=>$yangsheng,'xuanzhe' => $xuanzhe]);     
    }
    public function serveqr($id)
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

      $serve = DB::table('hkyl_myserve') -> where('id',$id) -> first();
      
      
        return view('home.order.serveqr',['set' => $set,'serve' =>$serve,'qiye'=>$qiye,'huiyi'=>$huiyi,'jiaoyu'=>$jiaoyu,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'keshi' => $keshi,'yangsheng'=>$yangsheng,'xuanzhe' => $xuanzhe]); 
 
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
    public function sx(Request $request)
    {
      $data = $request -> except('_token');
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
      
        $state = $data['status'];
      
      if(!empty($data['start']))
      {
        $start = strtotime($data['start']);
      }else{
        $start = '';
      }
      if(!empty($data['end']))
      {
        $end = strtotime($data['end']);
      }else{
        $end = '';
      }
      
      if($state == "")
      {
         
        if(empty($data['start']))
        {
          if(empty($data['end']))
          {
            $order = DB::table('hkyl_myorder As c1')
            -> where('c1.uid',$uid)
            -> paginate(5) ;
          }else{
            $order = DB::table('hkyl_myorder As c1')
            -> where('c1.uid',$uid)
            -> where('c1.ordertime','<',$end)
            -> paginate(5) ;
          }
        }else{
          if(empty($data['end']))
          {
            $order = DB::table('hkyl_myorder As c1')
            -> where('c1.uid',$uid)
            -> where('c1.ordertime','>',$start)
            -> paginate(5) ;
          }else{
            $order = DB::table('hkyl_myorder As c1')
            -> where('c1.uid',$uid)
            -> where('c1.ordertime','<',$end)
            -> where('c1.ordertime','>',$start)
            -> paginate(5) ;
          }
        }
      }else{
        
        if(empty($data['start']))
        {

          if(empty($data['end']))
          {
           
            $order = DB::table('hkyl_myorder As c1')
            -> where('c1.uid',$uid)
            -> where('c1.state','=',$state)
            -> paginate(5) ;
            
           
          }else{
            $order = DB::table('hkyl_myorder As c1')
            -> where('c1.uid',$uid)
            -> where('c1.state','=',$state)
            -> where('c1.ordertime','<',$end)
            -> paginate(5) ;
          }
        }else{
          if(empty($data['end']))
          {
            $order = DB::table('hkyl_myorder As c1')
            -> where('c1.uid',$uid)
            -> where('c1.state','=',$state)
            -> where('c1.ordertime','>',$start)
            -> paginate(5) ;
          }else{

            $order = DB::table('hkyl_myorder As c1')
            -> where('c1.uid',$uid)
            -> where('c1.state','=',$state)
            -> where('c1.ordertime','>',$start)
            -> where('c1.ordertime','<',$end)
            -> paginate(5) ;
          }
        }
      }
      

      return view('home.order.goodss',['set' => $set,'qiye'=>$qiye,'state'=>$state,'start'=>$start,'end'=>$end, 'huiyi'=>$huiyi,'order'=>$order,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function sersx(Request $request)
    {
      $data = $request -> except('_token');
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
      
        $state = $data['status'];
      
      if(!empty($data['start']))
      {
        $start = strtotime($data['start']);
      }else{
        $start = '';
      }
      if(!empty($data['end']))
      {
        $end = strtotime($data['end']);
      }else{
        $end = '';
      }
      
      if($state == "")
      {
         
        if(empty($data['start']))
        {
          if(empty($data['end']))
          {
            $serve = DB::table('hkyl_myserve')
            -> where('uid',$uid)
            -> paginate(5) ;
          }else{
            $serve = DB::table('hkyl_myserve')
            -> where('uid',$uid)
            -> where('servetime','<',$end)
            -> paginate(5) ;
          }
        }else{
          if(empty($data['end']))
          {
            $serve = DB::table('hkyl_myserve')
            -> where('uid',$uid)
            -> where('servetime','>',$start)
            -> paginate(5) ;
          }else{
            $serve = DB::table('hkyl_myserve')
            -> where('uid',$uid)
            -> where('servetime','<',$end)
            -> where('servetime','>',$start)
            -> paginate(5) ;
          }
        }
      }else{
        
        if(empty($data['start']))
        {

          if(empty($data['end']))
          {
           
            $serve = DB::table('hkyl_myserve')
            -> where('uid',$uid)
            -> where('state','=',$state)
            -> paginate(5) ;
            
           
          }else{
            $serve = DB::table('hkyl_myserve')
            -> where('uid',$uid)
            -> where('state','=',$state)
            -> where('servetime','<',$end)
            -> paginate(5) ;
          }
        }else{
          if(empty($data['end']))
          {
            $serve = DB::table('hkyl_myserve')
            -> where('uid',$uid)
            -> where('state','=',$state)
            -> where('servetime','>',$start)
            -> paginate(5) ;
          }else{

            $serve = DB::table('hkyl_myserve')
            -> where('uid',$uid)
            -> where('state','=',$state)
            -> where('servetime','>',$start)
            -> where('servetime','<',$end)
            -> paginate(5) ;
          }
        }
      }
      

      return view('home.order.serves',['set' => $set,'qiye'=>$qiye,'state'=>$state,'start'=>$start,'end'=>$end, 'huiyi'=>$huiyi,'serve'=>$serve,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function servexq($id)
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
      $xq = DB::table('hkyl_myserve') -> where('id',$id) -> first();

      if($xq -> type == 1)
      {
        $wz = DB::table('hkyl_servexq') -> where('servenum',$xq -> servenum) -> where('uid',$uid) -> first();
        
        $wzxq = DB::table('hkyl_doctor') -> where('id',$wz -> gid) -> first();
        $zj = DB::table('hkyl_user') -> where('id',$wzxq -> uid) -> first();
        return view('home.order.servexq',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'zj'=>$zj,'wzxq'=>$wzxq,'xq'=>$xq,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
      }
      if($xq -> type == 0)
      {
        $zxxq = DB::table('hkyl_servexq') -> where('servenum',$xq -> servenum) -> where('uid',$uid) -> first(); 
        $zj = DB::table('hkyl_user') -> where('id',$zxxq -> zjid) -> first();
        $bl = DB::table('hkyl_disease') -> where('id',$zxxq -> illid) -> first();
        return view('home.order.servexq',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'zj'=>$zj,'bl'=>$bl,'xq'=>$xq,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);

      }
    }
}

    


