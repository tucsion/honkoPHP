<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;

class ExpertController extends Controller
{
    //首页
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
      $user = DB::table('hkyl_user') 
      -> where('utp','=','2') 
      ->where('isrz','=','1')
      -> orderBy('id') -> paginate(3);
      if(session('user'))
      {
        $userid = session('user') -> id;
      }else{
        $userid = '';
      }
      $num = DB::table('hkyl_user') ->where('utp','=','2') -> where('isrz','=','1') -> count() ;
      $wz = DB::table('hkyl_doctor As c1') 
      -> LeftJoin('hkyl_user As c2','c1.uid','=','c2.id')
      ->select('c1.*','c2.*',DB::raw("c1.id as id","c2.uid as uid"))

      -> orderBy('addtime','DESC')
      ->take(4) -> get(); 
      //首页导航栏状态
      $xuanzhe = 2;

     //保存选择的状态
      $zc = 'zc=0';
      $kesi = 'keshi=0';
      $py = 'py=1';
      session(['zc' => $zc]);
      session(['kesi' => $kesi]);
      session(['py' => $py]);

    	return view('home.expert.index',['set' => $set,'qiye'=>$qiye,'zc'=>$zc,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'kesi'=>$kesi,'py'=>$py,'jiaoyu'=>$jiaoyu,'num' => $num,'wz'=>$wz,'user'=>$user,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'userid'=>$userid,'health'=>$health,'keshi' => $keshi,'xuanzhe' => $xuanzhe]);
    }
    public function zjlist($id)
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
      $wz = DB::table('hkyl_doctor As c1') 
      -> LeftJoin('hkyl_user As c2','c1.uid','=','c2.id')
      ->select('c1.*','c2.*',DB::raw("c1.id as id","c2.uid as uid"))
      -> orderBy('addtime','DESC')
      ->take(4) -> get(); 

      $zhi = substr($id,0,1);
      $yke = substr(session('kesi'),0,1);
      $yzc = substr(session('zc'),0,1);
      $ypy = substr(session('py'),0,1);
      if($zhi == $yke)
      {
        session(['kesi' => $id]);
       
      }elseif($zhi == $yzc)
      {
        session(['zc' => $id]);
      }elseif($zhi == $ypy)
      {
        session(['py' => $id]);
      }
      $zhichen = substr(strrchr(session('zc'), "="),1);
      
      $kes = substr(session('kesi'),-1);
      $py = substr(session('py'),-1);
      
      if($zhichen != 0 ){

        if($kes != 0){
          if($py != 1){
             $user = DB::table('hkyl_user') 
            ->where('utp','=','2') 
            ->where('isrz','=','1')
            ->where('keshi','like','%'.$kes.'%')
            ->where('zhicheng','=',$zhichen)
            ->where('pinyin','like',$py.'%')
            -> orderBy('id') -> paginate(3);
            $num = DB::table('hkyl_user') 
            ->where('utp','=','2') 
            -> where('isrz','=','1')
            ->where('keshi','like','%'.$kes.'%')
            ->where('zhicheng','=',$zhichen)
            ->where('pinyin','like',$py.'%')
            -> count() ;
          }else
          {
             $user = DB::table('hkyl_user') 
            ->where('utp','=','2') 
            ->where('isrz','=','1')
            ->where('keshi','like','%'.$kes.'%')
            ->where('zhicheng','=',$zhichen)
            -> orderBy('id') -> paginate(3);
            $num = DB::table('hkyl_user') 
            ->where('utp','=','2') 
            -> where('isrz','=','1')
            ->where('keshi','like','%'.$kes.'%')
            ->where('zhicheng','=',$zhichen)
            -> count() ;
          }
        }else{
          if($py != 1)
          {
             $user = DB::table('hkyl_user') 
            ->where('utp','=','2') 
            ->where('isrz','=','1')
            ->where('zhicheng','=',$zhichen)
            ->where('pinyin','like',$py.'%')
            -> orderBy('id') -> paginate(3);
            $num = DB::table('hkyl_user') 
            ->where('utp','=','2') 
            -> where('isrz','=','1')
            ->where('zhicheng','=',$zhichen)
            ->where('pinyin','like',$py.'%')
            -> count() ;
          }else
          {
            $user = DB::table('hkyl_user') 
            ->where('utp','=','2') 
            ->where('isrz','=','1')
            ->where('zhicheng','=',$zhichen)
            -> orderBy('id') -> paginate(3);
            $num = DB::table('hkyl_user') 
            ->where('utp','=','2') 
            -> where('isrz','=','1')
            ->where('zhicheng','=',$zhichen)
            -> count() ;
          }
        }
      }else
      {

        if($kes != 0){

          if($py != 1){
            $user = DB::table('hkyl_user') 
            -> where('utp','=','2') 
            ->where('isrz','=','1')
            ->where('keshi','like','%'.$kes.'%')
            ->where('pinyin','like',$py.'%')
            -> orderBy('id') -> paginate(3);
            $num = DB::table('hkyl_user') 
            ->where('utp','=','2') 
            -> where('isrz','=','1')
            ->where('keshi','like','%'.$kes.'%')
            ->where('pinyin','like',$py.'%')
            -> count() ;
          }else{
            $user = DB::table('hkyl_user') 
            ->where('utp','=','2') 
            ->where('isrz','=','1')
            ->where('keshi','like','%'.$kes.'%')
            ->orderBy('id') -> paginate(3);
            $num = DB::table('hkyl_user') 
            ->where('utp','=','2') 
            -> where('isrz','=','1')
            ->where('keshi','like','%'.$kes.'%')
            -> count() ;
          }
        }else{

          if($py !=  1){
            
            $user = DB::table('hkyl_user') 
            ->where('utp','=','2') 
            ->where('isrz','=','1')
            ->where('pinyin','like',$py.'%')
            ->orderBy('id') -> paginate(3);
            $num = DB::table('hkyl_user') 
            ->where('utp','=','2') 
            -> where('isrz','=','1')
            ->where('pinyin','like',$py.'%')
            -> count() ;
            
          }else{
            $user = DB::table('hkyl_user') 
            -> where('utp','=','2') 
            ->where('isrz','=','1')
            -> orderBy('id') -> paginate(3);
            $num = DB::table('hkyl_user') 
            ->where('utp','=','2') 
            -> where('isrz','=','1')
            -> count() ;
          }
      }
      }
     
      
      //首页导航栏状态
      $xuanzhe = 2;
      
      return view('home.expert.zjlist',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'num' => $num,'jiaoyu'=>$jiaoyu,'wz'=>$wz,'user'=>$user,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'keshi' => $keshi,'yangsheng'=>$yangsheng,'xuanzhe' => $xuanzhe,'zhichen' =>$zhichen,'kes'=>$kes,'py'=>$py]);
    }
    //专家详情
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
      $user = DB::table('hkyl_user') 
      -> where('id','=',$id) 
      -> first();
      $cate = DB::table('hkyl_cate') -> where('id','=',$user -> zhicheng) ->first();
      $wz = DB::table('hkyl_doctor') -> where('uid','=',$id) -> paginate(10);
      $num = DB::table('hkyl_doctor') -> where('uid','=',$id) -> count();
      $zc = DB::table('hkyl_info') -> where('cid','=','58') -> orderBy('addtime','DESC') -> take(4) ->get();
      $message = DB::table('hkyl_message As c1')
      -> leftJoin('hkyl_user As c2','c2.id','=','c1.uid')
      -> select('c1.*','c2.uname as uname','c2.headurl as headurl') 
      -> where('c1.zjid',$id) 
      -> orderBy('c1.messtime','DESC') 
      -> paginate(4);
      $co = DB::table('hkyl_message') -> where('zjid',$id) ->count();
      $pj = DB::table('hkyl_appraise As c1')
      -> leftJoin('hkyl_user As c2','c2.id','=','c1.uid')
      -> select('c1.*','c2.uname as uname','c2.headurl as headurl') 
      -> where('zjid',$id) 
      -> orderBy('time','DESC') 
      -> paginate(4);
      $con = DB::table('hkyl_appraise') -> where('zjid',$id) -> count();
      //首页导航栏状态
      $xuanzhe = 2;
      if(session('user'))
      {
        $userid = session('user') -> id;
      }else{
        $userid = '';
      }
      return view('home.expert.detail',['set' => $set,'id'=>$id,'userid'=>$userid,'pj'=>$pj,'co'=>$co,'con'=>$con,'message'=>$message,'zc'=>$zc,'num'=>$num,'qiye'=>$qiye,'wz'=>$wz,'user'=>$user,'cate'=>$cate,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'jiaoyu'=>$jiaoyu,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'keshi' => $keshi,'xuanzhe' => $xuanzhe]);
    }
    public function zixun($id)
    {

      $u = DB::table('hkyl_user') -> where('id','=',$id) -> first();
      $ser = DB::table('hkyl_sertype') -> get();
      $userid = session('user') -> id;
      $rw = DB::table('hkyl_cases') -> where('uid',$userid) -> get();

      return view('home.expert.zixun',['u' => $u,'ser'=>$ser,'rw'=>$rw]);
    }
    public function message(Request $request)
    {
      if(empty(session('user')))
      {
        return back()->with(['login'=>'请先登录']);
      }
     
      $data=$request->except('_token');
      if(empty($data['message']))
      {
       return back() -> with(['kong'=>'留言不能为空!']);
      }
      $id = $data['zjid'];
      $data['messtime'] = time();
      $data['uid'] = session('user') -> id;
      $res = DB::table('hkyl_message') -> insert($data);
      if($res)
      {
        return redirect('/expert/detail/'.$id)->with(['message'=>'数据添加成功']);
      }else
      {
        return back() -> with(['mess'=>'留言失败']);
      }
     
    }
    public function wenzang($id)
    {
      $wzid = $id;
      $wzdeail = DB::table('hkyl_doctor') -> where('id',$id) -> first();
      $id = $wzdeail-> uid;
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
      $user = DB::table('hkyl_user') 
      -> where('id','=',$id) 
      -> first();
      $cate = DB::table('hkyl_cate') -> where('id','=',$user -> zhicheng) ->first();
      $wz = DB::table('hkyl_doctor') -> where('id','=',$wzid) -> first();
      $num = DB::table('hkyl_doctor') -> where('uid','=',$id) -> count();
      $zc = DB::table('hkyl_info') -> where('cid','=','58') -> orderBy('addtime','DESC') -> take(4) ->get();
      $xuanzhe = 2;
      $pj = DB::table('hkyl_appraise As c1')
      -> leftJoin('hkyl_user As c2','c2.id','=','c1.uid')
      -> select('c1.*','c2.uname as uname','c2.headurl as headurl') 
      -> where('zjid',$wzid) 
      -> orderBy('time','DESC') 
      -> paginate(4);
      $con = DB::table('hkyl_appraise') -> where('zjid',$wzid) -> count();
     if(empty(session('user')))
     {
       return view('home.expert.wenzang',['set' => $set,'pj'=>$pj,'con'=>$con,'zc'=>$zc,'num'=>$num,'qiye'=>$qiye,'wz'=>$wz,'user'=>$user,'cate'=>$cate,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'jiaoyu'=>$jiaoyu,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'keshi' => $keshi,'xuanzhe' => $xuanzhe]);
     }else{
       $uid = session('user') -> id;
        $xq = DB::table('hkyl_servexq') -> where('uid',$uid) -> where('gid',$wzid) -> first();
        return view('home.expert.wenzang',['set' => $set,'xq'=>$xq,'pj'=>$pj,'con'=>$con,'wzdeail'=>$wzdeail,'zc'=>$zc,'num'=>$num,'qiye'=>$qiye,'wz'=>$wz,'user'=>$user,'cate'=>$cate,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'jiaoyu'=>$jiaoyu,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'keshi' => $keshi,'xuanzhe' => $xuanzhe]);
     }
    }
    public function wzsc($id)
    {
      if(empty(session('user')))
      {
        return back() -> with(['login' => '还未登录']);
      }
      $data = '';
      $data['gid'] = $id;
      $uid = session('user') -> id;
      $data['uid'] = $uid;
      $wzang = DB::table('hkyl_doctor') -> where('id',$id) -> first();
      $zjid = $wzang -> uid;
      $pd = DB::table('hkyl_myfavorite') -> where('uid',$uid) -> where('favname',$wzang -> name) ->first();
       if($pd)
      {
        return back() -> with(['sc'=>'已被收藏过']);
      }
      $data['favname'] = $wzang -> name;
      $data['type'] = 3;
      $res = DB::table('hkyl_myfavorite') -> insert($data);
      if($res)
      {
        return redirect('/expert/detail/'.$zjid)->with(['wzsc'=>'收藏成功']);
      }else{
        return back() -> with(['wzscd'=>'收藏失败']);
      }
    }
    public function zjsc($id)
    {
      if(empty(session('user')))
      {
        return back() -> with(['login' => '还未登录']);
      }
      if(session('user')->utp != 1)
      {
        return back() -> with(['utp' => '请先已患者身份登录']);
      }
      $data = '';
      $data['gid'] = $id;
      $uid = session('user') -> id;
      $data['uid'] = $uid;
      $zj = DB::table('hkyl_user') -> where('id',$id) -> first();
      $zjid = $zj -> id;
      $pd = DB::table('hkyl_myfavorite') -> where('uid',$uid) -> where('favname',$zj -> uname) ->first();

       if($pd)
      {
        return back() -> with(['sc'=>'已被收藏过']);
      }
      $data['favname'] = $zj -> uname;
      $data['type'] = 1;
      $res = DB::table('hkyl_myfavorite') -> insert($data);
      if($res)
      {
        return redirect('/expert/detail/'.$zjid)->with(['wzsc'=>'收藏成功']);
      }else{
        return back() -> with(['wzscd'=>'收藏失败']);
      }
    }
    public function jianjie($id)
    {
      $user = DB::table('hkyl_user') -> where('id',$id) -> first();
      return json_encode($user);
    }
    public function blxz($id)
    {
      $bl = DB::table('hkyl_disease') -> where('cid',$id) -> get();
      if(empty($bl))
      {
        return json_encode($bl = false);
      }else{
        return json_encode($bl);
      }
      
    }
    public function serve(Request $request)
    {
      $data=$request->except('_token');
      $sertype = $data['sertype'];
      $blid=$data['bl'];
      $rwid=$data['rw'];
      $zjid=$data['zjid'];
      $zx = DB::table('hkyl_sertype') -> where('id',$sertype) ->first(); 
      $uid = session('user') -> id;
      $servenum = 'Z'.rand(1000,9999).time();
      $servetime =time(); 
      $price = $zx -> tprice;
      $ser = '';
      $ser['uid'] =$uid;
      $ser['servenum'] = $servenum;
      $ser['servetime'] = $servetime;
      $ser['price'] = $price;
      $ser['type'] = 0;
      $ser['servetype'] = $sertype;
      $xq = '';
      $xq['servenum'] = $servenum;
      $xq['gid'] = $sertype;
      $xq['uid'] = $uid;
      $xq['illid'] = $blid;
      $xq['illname'] = $rwid;
      $xq['zjid'] = $zjid;
      $servexq= DB::table('hkyl_servexq') -> insert($xq);
      $res = DB::table('hkyl_myserve') -> insert($ser);
      if($res and $servexq)
      {
        return json_encode($state = 0);
      }else{
        return json_encode($state = 1);
      }
    }
}
    


