<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


class GoodscarController extends Controller
{
    public function car(){
      if(session('user') -> utp != 1)
      {
        return redirect('/')->with(['utp'=>'请以患者身份登录购买']);
      }
       //询所有分类
      $uid = session('user') -> id;
      $set = DB::table('hkyl_set') -> first();
      $expert = DB::table('hkyl_cate') -> where('pid','=','2') -> orderBy('id') -> get() ;
      $train = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> get();
      $ys = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> get();
      $hickey = DB::table('hkyl_cate') -> where('pid','=','5') -> orderBy('id') -> get();
      $procure = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> get();
      $goods = DB::table('hkyl_cate') -> where('pid','=','9') -> orderBy('id') -> get();
      $health = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> get();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id')-> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;
      $car = DB::table('hkyl_goodscar As c1')
      -> leftjoin('hkyl_goods As c2','c2.id','=','c1.gid')
      -> select('c1.*','c2.*')
      -> where('c1.uid',$uid)
      -> orderBy('c1.id')
      -> get();
      $user = DB::table('hkyl_user') -> where('id',$uid) -> first();
      $jf = $user -> jfnum - $user -> userjf;
        return view('home.goodscar.car',['set' => $set,'car'=>$car,'jf'=>$jf,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function carqr(Request $request)
    {
          $uid = session('user') -> id;
          $set = DB::table('hkyl_set') -> first();
          $expert = DB::table('hkyl_cate') -> where('pid','=','2') -> orderBy('id') -> get() ;
          $train = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> get();
          $ys = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> get();
          $hickey = DB::table('hkyl_cate') -> where('pid','=','5') -> orderBy('id') -> get();
          $procure = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> get();
          $goods = DB::table('hkyl_cate') -> where('pid','=','9') -> orderBy('id') -> get();
          $health = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> get();
          $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id')-> first();
          $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
          $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
          $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
          $xuanzhe = 1;
        $data = $request -> except('_token');
        if(empty($data['xuanze']))
        {
            return back() -> with(['goodsqrd' => '未选择商品,订单生成失败']);
        }
        $count = count($data['xuanze']);
       
        $zprice = '';
        for($i=0;$i<$count;$i++)
        {
            $good[$i]['gid'] = $data['proId'][$i];
            $wpid = $data['proId'][$i];
            $wp = DB::table('hkyl_goods') -> where('id',$wpid) -> first();
            $good[$i]['gname'] = $wp -> gname;
            $good[$i]['price'] = $wp -> price;
            $good[$i]['img'] = $wp -> img;
            $good[$i]['number'] = $data['proNum'][$i];
            $zprice += $wp -> price * $data['proNum'][$i];

        }
       
        $address = DB::table('hkyl_address') -> where('uid',$uid) -> where('state',1) ->first();
        if(empty($address)){
            $address = DB::table('hkyl_address') -> where('uid',$uid) -> orderBy('id','DESC') -> first();
        }
        $jf = substr($data['jf'],1);

        return view('home.goodscar.carqr',['set' => $set,'zprice'=>$zprice,'address'=>$address,'good'=>$good,'jf'=>$jf,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
       
    }
    public function myorder(Request $request)
    {
         $data = $request -> except('_token');
         $uid = session('user') -> id;

         $onumber = 'G'.rand(1000,9999).time();
         $ordertime = time();
         $price = $data['zj'];
         $aid = $data['dzid'];
         $jf = $data['jf'] * 1000;
         $order = [];
         if(!empty($data['fpid'])){
          $order['bill'] = $data['fpid'];
          unset($data['fapiao']);
         }else{
          unset($data['fpid']);
         }
         $order['onumber'] = $onumber;
         $number = $onumber;
         $order['uid'] = $uid;
         $order['ordertime'] = $ordertime;
         $order['price']  = $price;
         $order['aid'] = $aid;
         $order['usejf'] = $jf;
         $count = count($data['gid']);
         $res = DB::table('hkyl_myorder') -> insert($order);
         if($res)
         {
            for($i=0;$i<$count;$i++){
                $dd['gid'] = $data['gid'][$i];
                $dd['unumber'] = $number;
                $dd['num'] = $data['number'][$i];
                $xq = DB::table('hkyl_orderxq') -> insert($dd);
                $carid = DB::table('hkyl_goodscar') -> where('gid',$data['gid'][$i]) -> first();
                $sc = DB::table('hkyl_goodscar') -> delete($carid -> id);
            }
           return redirect('/order/goods')->with(['order'=>'订单创建成功']);
         }else{
            return back() ->with(['orderd'=>'订单创建成功']);
         }
        
    }
    public function buy(Request $request)
    {
      if(empty(session('user')))
       {
        return json_encode($uid = 1);
       }
       if(session('user') -> utp != 1)
       {
        return json_encode($uid = 2);
       }
        $data = $request -> except('_token');
        $uid = session('user') -> id;
        $data['uid'] = $uid;
        $number = $data['number'];
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
        return json_encode($state= 0);
      }else{
        return json_encode($state= 3);
      }
    }
    public function delete($gid)
    {
        $uid = session('user') -> id;
        $res = DB::table('hkyl_goodscar') -> where('uid',$uid) -> where('gid',$gid) -> first();
        if($res){
            $sc = DB::table('hkyl_goodscar') -> delete($res -> id);
        }
        if($sc)
        {
            return json_encode($state= 0);
        }else
        {
            return json_encode($state= 1);
        }
        
    }
    public function select()
    {
        $id = session('user') -> id;
        $address = DB::table('hkyl_address') -> where('uid',$id) -> get();
        return view('home.goodscar.select',['address' => $address]);
    }
    public function pd()
    {
        $id = session('user') -> id;
        $bill = DB::table('hkyl_bill') -> where('uid',$id) -> get();
        return view('home.goodscar.pd',['bill' => $bill]);
    }
    public function bill()
    {
      $uid = session('user') -> id;
      $bill = DB::table('hkyl_bill') -> where('uid',$uid) ->orderBy('id','DESC')-> first();
      return json_encode($bill);
    }
}
    


