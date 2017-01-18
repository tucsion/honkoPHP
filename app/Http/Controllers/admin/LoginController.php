<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Crypt;

class LoginController extends Controller
{
	//登陆视图
    public function login()
    {
        if(empty(session('admin')))
        {
            return view('admin.login');
        }else{
            return view('admin.index');
        }
    	
    }

    //处理登陆
    public function dologin(Request $request)
    {
        
    	$scode = session('milkcaptcha');
        $rcode = $request -> input('captcha');
        if($scode != $rcode)
        {
            return back() -> with(['info' => '验证码错误']);
        }
        //判断数据合法性
        $this->validate($request,[
            'password'=>'required|',
            'username'=>'required'
            ],[
            'password.required'=>'密码不能为空',
            
            'username.required'=>'邮箱不能为空'

            ]);
        $data = $request->except('_token','captcha');
        $res = DB::table('hkyl_admin') -> where('username',$data['username']) -> first();
        //dd($res);
       
        if($res)
        {

            
            $password = Crypt::decrypt($res -> password);
            if($password != $data['password'])
            {
                return back()->with(['info'=>'密码错误']);
            }
            //把数据存到session
            session(['admin' => $res]);
            
            $ip = $_SERVER["REMOTE_ADDR"];
            $datetime = time();
            $id = $res -> id;
            $edit = DB::table('hkyl_admin') -> where('id',$id) -> update(['loginip'=> $ip,'datetime' => $datetime]);
            if($edit)
            {
                 return redirect('/admin/index')->with(['info'=>'登陆成功']);
            }
           
        }else
        {
            return back()->with(['info'=>'账号错误或者不存在！']);
        }
    }
    //退出
    public function logout()
    {
    	session() -> forget('admin');
    	return redirect('/admin/login')->with(['info'=>'退出成功']);
    }


}
