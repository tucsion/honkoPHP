<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;
use Crypt;

class UserController extends Controller
{
    //会员中心
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
      //页面数据
      $id = session('user') -> id;
      if(session('user') -> utp  == 1)
      {
        $count = DB::table('hkyl_mynews') -> where('newsstate','0') -> where('uid',$id) -> count();
      }
      if(session('user') -> utp == 2)
      {
        $count = DB::table('hkyl_mynews') -> where('newsstate','0') -> where('uid',$id) -> count();
      }
      if(session('user') -> utp == 3)
      {
        $count = DB::table('hkyl_winmsd') -> where('wstate','0')  -> count();
      }
      $user = DB::table('hkyl_user') -> where('id','=',$id) -> first();
      $order = DB::table('hkyl_myorder') -> where('uid','=',$id) -> orderBy('ordertime','DESC') -> take(2) -> get();
      $serve = DB::table('hkyl_myserve') -> where('uid','=',$id) -> orderBy('servetime','DESC') -> take(2) -> get();
        
    	return view('home.user.index',['set' => $set,'user' =>$user,'count'=>$count,'order'=>$order,'serve'=>$serve,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'jiaoyu'=>$jiaoyu,'banner' => $banner,'expert' => $expert,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    //基本资料
    public function base()
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
      $user = DB::table('hkyl_user') -> where('id',$id) ->first();
      return view('home.user.base',['set' => $set,'user'=>$user,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function editzl(Request $request)
    {

      $data = $request -> except('_token');
      $id = session('user') -> id;
      
      unset($data['face']);
      $res = DB::table('hkyl_user') -> where('id','=',$id) -> update($data);
      if($res)
      {
         return redirect('/home/user/base')-> with(['editzl'=>'地址添加成功']);
      }else{
         return back() -> with(['editzld'=>'地址添加成功']);
      }
    }
    public function img(Request $request)
    {
      $id =session('user') -> id;
      if ($request->hasFile('file')){
        if ($request-> file('file')->isValid()){
          $img = DB::table('hkyl_user') ->where('id',$id) -> first() -> headurl;

          $oldimg= './updates/'.$img;
          $oldpath = $request -> file('file') -> getClientOriginalExtension();
          $filename = time().mt_rand(100000,999999);
          $request -> file('file') -> move('./updates',$filename.'.'.$oldpath);
          if(!empty($img)){
            if(file_exists($oldimg))
                { 
                  
                    unlink($oldimg);
                }
                
                
            }
          }
                $headurl = $filename.'.'.$oldpath;
                $data['headurl'] = $headurl;
                $url = "/updates/".$headurl;
      }
      if ($request->hasFile('file1')){
        if ($request-> file('file1')->isValid()){
          $img = DB::table('hkyl_user') ->where('id',$id) -> first() -> cardpic1;

          $oldimg= './updates/'.$img;
          $oldpath = $request -> file('file1') -> getClientOriginalExtension();
          $filename = time().mt_rand(100000,999999);
          $request -> file('file1') -> move('./updates',$filename.'.'.$oldpath);
          if(!empty($img)){
            if(file_exists($oldimg))
                { 
                   
                    unlink($oldimg);
                }
                
                
            }
          }
                $cardpic1 = $filename.'.'.$oldpath;
                $data['cardpic1'] = $cardpic1;
                $url = "/updates/".$cardpic1;
      }
      if ($request->hasFile('file2')){
        if ($request-> file('file2')->isValid()){
          $img = DB::table('hkyl_user') ->where('id',$id) -> first() -> cardpic2;

          $oldimg= './updates/'.$img;
          
          $oldpath = $request -> file('file2') -> getClientOriginalExtension();
          $filename = time().mt_rand(100000,999999);
          $request -> file('file2') -> move('./updates',$filename.'.'.$oldpath);
          if(!empty($img)){

            if(file_exists($oldimg))
                { 
                   
                    unlink($oldimg);
                }
                
                
            }
          }
                $cardpic2 = $filename.'.'.$oldpath;
                $data['cardpic2'] = $cardpic2;
                $url = "/updates/".$cardpic2;
      }
      $res = DB::table('hkyl_user') -> where('id','=',$id) -> update($data);

      if($res)
      {
        return response()->json(['url'=>$url]);
      }
    }
    //地址列表
    public function address()
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
      //页面数据
      $id = session('user') -> id;
      $add = DB::table('hkyl_address') -> where('uid',$id) -> paginate(5);
      return view('home.user.address',['set' => $set,'add'=>$add,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    
    public function editadd(Request $request)
    {
      $data = $request -> except('_token');
      $id = session('user') -> id;
      if(empty($data['state']))
      {
        $data['state'] = 0;
      }else{
        $data['state'] = 1; 
      }
      if($data['state'] = 1)
      {
        $user = DB::table('hkyl_address') -> where('uid',$id) -> get();
        $state['state'] = 0;
        
        foreach($user as $u ){
          $a = DB::table('hkyl_address') -> where('id',$u -> id) -> update($state) ;
        }
  
      }
     
      $data['uid'] = $id;
      $res = DB::table('hkyl_address') -> insert($data);
      if($res){
            return redirect('/home/user/address')->with(['editadd'=>'地址添加成功']);
        }else{
            return back()->with(['editad'=>'添加地址失败']);
        }
    }
    public function snat($id)
    {
      
      $add = DB::table('hkyl_address') -> where('id',$id) -> first();
      return view('/home/user/snat',['add' => $add]);
    }
    public function updateadd(Request $request)
    {

      $data = $request -> except('_token');
      
      $id = $data['id'];
      unset($data['id']);
      if(empty($data['state']))
      {
        $data['state'] = 0;
      }else{
        $data['state'] = 1; 
      }
      if($data['state'] = 1)
      {
        $user = DB::table('hkyl_address') -> where('uid',$id) -> get();
        $state['state'] = 0;
        
        foreach($user as $u ){
          $a = DB::table('hkyl_address') -> where('id',$u -> id) -> update($state) ;
        }
  
      }
      $res = DB::table('hkyl_address') -> where('id',$id) -> update($data);
      if($res){
           return response()->json(['status'=>1]);
        }else{
          return response()->json(['status'=>0]);
        }

    }
    public function deleteadd($id)
    { 

      $res = DB::table('hkyl_address') -> delete($id);
      if($res){
        return redirect('/home/user/address') -> with(['deleteadd'=>'删除成功']);
      }
    }
    //认证管理
    public function rz()
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
      $user = DB::table('hkyl_user') -> where('id',$id) ->first();
       return view('home.user.rz',['set' => $set,'user'=>$user,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function rzadd(Request $request)
    {
      $data = $request -> except('_token');
      $id = session('user') -> id;
      if(empty($data['zjtype']))
      {
        return back() ->with(['zj'=>'证件类型未选择']);
      }
      $res = DB::table('hkyl_user') -> where('id','=',$id) -> update($data);
      if($res)
      {
        return redirect('/home/user/rz')->with(['rz'=>'修改成功']);
      }
    }
    //修改密码
    public function pass()
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
       return view('home.user.pass',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function passedit(Request $request)
    {
      $this->validate($request,[
            
            'pass'=>'same:newpassword',
            'newpassword' => 'min:6|max:12',
            ],[
            'pass.same'=>'确认密码不一致',
            'newpassword.min' =>'新密码不能少于6位',
            'newpassword.max' => '新密码不能大于12位',
            ]);
      $data=$request->except('_token','pass');
      
      $id = session('user') -> id;
      $user = DB::table('hkyl_user') -> where('id',$id) -> first();
      $oldpass = Crypt::decrypt($user -> upwd);

      if($oldpass != $data['password']){
        return redirect('/home/user/index')->with(['pass'=>'原密码不正确']);
      }
     
      $pass['upwd'] = $data['newpassword']; 
      
      
      $pass['upwd'] = Crypt::encrypt($pass['upwd']);
      
     
      $res = DB::table('hkyl_user') -> where('id',$id) -> update($pass);
      if($res)
      {
        return redirect('/home/user/pass')->with(['pass'=>'修改成功']);
      }
    }
    public function ajaxupdate()
    {
      $uid = session('user') -> id;
      $res = DB::table('hkyl_winmsd') -> where('wstate','0') -> first();
      $aa = DB::table('hkyl_mynews') -> where('newsstate','0')  ->where('uid',$uid) -> first();
      $ly = DB::table('hkyl_message') -> where('state','0')  ->where('uid',$uid) -> first();
      if($aa)
      {
        if($res)
        {
          if($ly)
          {
            return response() -> json(['state'=>1,'status'=>1,'stat'=>1]);
          }else{
            return response() -> json(['state'=>1,'status'=>1,'stat'=>0]);
          }
          
        }else{
          if($ly)
          {
            return response() -> json(['state'=>1,'status'=>0,'stat'=>1]);
          }else{
            return response() -> json(['state'=>1,'status'=>0,'stat'=>0]);
          }
          
        } 
      }else
      {
        if($res)
        {
          if($ly)
          {
            return response() -> json(['state'=>0,'status'=>1,'stat'=>1]);
          }else{
            return response() -> json(['state'=>0,'status'=>1,'stat'=>0]);
          }
          
        }else{
          if($ly)
          {
            return response() -> json(['state'=>0,'status'=>0,'stat'=>1]);
          }else{
            return response() -> json(['state'=>0,'status'=>0,'stat'=>0]);
          }
          
        } 
      }
    }
    public function bill()
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
      $bill = DB::table('hkyl_bill') -> where('uid',$id) -> paginate(5);
      return view('home.user.bill',['set' => $set,'qiye'=>$qiye,'bill'=>$bill,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function addbill(Request $request)
    {
      $data = $request -> except('_token');
      $id = session('user') -> id;  
      $data['uid'] = $id;
      $res = DB::table('hkyl_bill') -> insert($data);
      if($res){
            return redirect('/home/user/bill')->with(['addbill'=>'发票信息添加成功']);
        }else{
            return back()->with(['addbilld'=>'添加发票信息失败']);
        }
    }
    public function editbill($id)
    {
      $bill = DB::table('hkyl_bill') -> where('id',$id) -> first();
      return view('/home/user/editbill',['bill' => $bill]);
    }
    public function updatebill(Request $request)
    {
      $data = $request -> except('_token');
      
      $id = $data['id'];
      unset($data['id']);
      unset($data['billtype']);
      unset($data['billitem']);
      $res = DB::table('hkyl_bill') -> where('id',$id) -> update($data);
      if($res)
      {
         return response()->json(['status'=>1]);
      }
    }
    public function deletebill($id)
    {
      $res = DB::table('hkyl_bill') -> delete($id);
      if($res){
        return redirect('/home/user/bill') -> with(['deletebill'=>'删除成功']);
      }
    }
}
    


