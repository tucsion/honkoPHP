<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;
use Crypt;

class LoginController extends Controller
{


    public function login()
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
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id')-> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;

        return view('home.login',['set' => $set,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    public function dologin(Request $request)
    {
        
        $scode = session('milkcaptcha');
        
        $rcode = $request -> input('captcha');
        $utp = $request -> input('utp');
        if($utp  == 0)
        {
            return back() -> with(['info' => '身份未选择']);
        }
        if($scode != $rcode)
        {
            return back() -> with(['yz' => '验证码错误']);
        }

        $this->validate($request,[
            'phone'=>'bail|required|regex:/^1[34578][0-9]{9}$/',
            'upwd' =>'bail|required|min:6|max:14'
            ],[
            'phone.required' => '手机号不能为空',
            'phone.regex'=>'手机号格式不正确',
            'upwd.required'=> '密码不能为空',
            'upwd.min'=> '密码不能少于6位',
            'upwd.max'=> '密码不能超过14位',
            ]);
        $data = $request->except('_token','captcha');
        $res = DB::table('hkyl_user') -> where('phone',$data['phone']) -> first();
        
        if($res)
        {

           $password = Crypt::decrypt($res -> upwd);
            
            
            if($password != $data['upwd'])
            {
                return back()->with(['mm'=>'密码错误']);
            }
          $sf = DB::table('hkyl_user') -> where('phone',$data['phone']) -> value('utp');
          if($data['utp'] != $sf)
          {
                return back()->with(['sf'=>'身份不匹配']);
          }
            //把数据存到session
            session(['user' => $res]);
            
            
            if($res -> utp == 1)
            {
            $id = $res -> id;

            $edit = DB::table('hkyl_user') -> where('id',$id) -> update(['iszaixian'=> 1]);
          
            
                 return redirect('/home/user/index')->with(['lo'=>'登陆成功']);
            }
            if($res -> utp == 2)
            {
              $id = $res -> id;
              $edit = DB::table('hkyl_user') -> where('id',$id) -> update(['iszaixian'=> 1]);
              return  redirect('/home/user/index')->with(['lo'=>'登陆成功']);
            }
            if($res -> utp == 3)
            {
               return  redirect('/home/user/index')->with(['lo'=>'登陆成功']);
            }
           
        }else
        {
            return back()->with(['zh'=>'账号错误或者不存在！']);
        }
        
    }
    public function logout()
    {
      session() -> forget('user');
      return redirect('/')->with(['info'=>'退出成功']);
    }
}
