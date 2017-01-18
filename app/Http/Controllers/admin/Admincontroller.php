<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Crypt;
class Admincontroller extends Controller
{
	//管理员列表
    public function index(Request $request)
    {
    	$data = DB::table('hkyl_admin') -> paginate(10);
    	
    	
        
        
    	//列表
    	return view('admin.admin.index',['data' => $data,]);
    }
    
   	//数据添加
     public function add()
    {
    	return view('admin.admin.add');
    }
    public function insert(Request $request)
    {

    	// dd($request->all());
    	$this->validate($request,[
    		'username'=> 'required|min:2|max:10',
    		'password'=>'required|min:6|max:18',
    		'repass'=>'required|same:password',
    		
    		],[
    		'username.required'=>'用户名不能为空',
    		'username.min'=>'用户名不小于2位',
    		'username.max'=>'用户名不大于10位',
    		'password.required'=>'密码不能为空',
    		'password.min'=>'密码不能小于6位',
    		'password.max'=>'密码不能大于18位',
    		'repass.required'=>'确认密码不能为空',
    		'repass.same'=>'确认密码不一致',

    		]);
    	$data=$request->except('_token','repass');
    	
    	$data['password']=Crypt::encrypt($data['password']);
    	$data['addtime'] = time();
    	
    	
    	$res=DB::table('hkyl_admin')->insert($data);
    	
    	if($res){
    		return redirect('/admin/admin/index')->with(['info'=>'数据添加成功']);
    	}else{
    		return back()->with(['info'=>'添加数据失败']);
    	}

    }
    //数据修改
    public function edit($id)
   	{
      $data=DB::table('hkyl_admin')->where('id',$id)->first();
      return view('admin.admin.edit',['data'=>$data]);
   	}

   	public function update(Request $request)
   	{

   		$this->validate($request,[
    		'username'=> 'required|min:2|max:10',
    		'password'=>'required|',
    		'newpassword'=>'required',
    		'repassword'=>'required|same:newpassword',
    		
    		],[
    		'username.required'=>'用户名不能为空',
    		'username.min'=>'用户名不小于2位',
    		'username.max'=>'用户名不大于10位',
    		'password.required'=>'密码不能为空',
    		'newpassword.required' => '新密码不能为空',
    		'repassword.required'=>'确认密码不能为空',
    		'repassword.same'=>'确认密码不一致',

    		]);

      $data= $request->except('_token','repassword');
     
      $id = $data['id'];
      $res = DB::table('hkyl_admin') -> where('id',$id) -> first();
     
      $pass = $res -> password;
      
      $oldpass = Crypt::decrypt($pass);
      $newpass = $data['password'];
      $username = $data['username'];
      $state = $data['status'];
      $password = $data['newpassword'];
      if($oldpass == $newpass)
      {
      	$password = Crypt::encrypt($password);
      	$data = DB::table('hkyl_admin') -> where('id',$id)->update(['username'=> $username,'type' => $state,'password' =>$password]);
      	if($data)
    		{
    			return redirect('/admin/admin/index')->with(['uppass'=>'管理员信息修改成功']);
    		}else
    		{
    			return back() -> with(['uppass' => '管理员信息修改失败']);
    		}
      }else
      {
      	return back() ->  with(['false' => '原密码输入不正确']);
      }
      
   	}
   	//数据删除
   	 public function delete($id)
   	{
      $res = DB::table('hkyl_admin')->delete($id);
      if($res)
      {
        return redirect('/admin/admin/index')->with(['info'=>'数据删除成功']);
      }else{
        return back()->with(['info'=>'数据删除失败']);
      }
   	}
}
