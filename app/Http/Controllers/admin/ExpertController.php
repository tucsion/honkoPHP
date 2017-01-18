<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use Crypt;
class Expertcontroller extends Controller
{
	
    //专家信息
    public function index(Request $request)

    {

        //搜索+分页
        //
        
        $data = DB::table('hkyl_user') 
        -> where ('phone' , 'like' , '%'.$request -> input('keywords').'%')
        -> where ('uname' , 'like' , '%'.$request -> input('keyword').'%')
        -> where ('utp',2)
        -> paginate($request -> input('num',10));
        

        //列表
        return view('admin.expert.index',['data' => $data,'request' => $request -> all()]);

    }
    public function add()

    {
        $res = DB::table('hkyl_cate')-> where('pid','=',2)->get();
        
        return view('admin.expert.add',['res'=>$res]);

    }
    public function insert(Request $request)
    {
        $this->validate($request,[
            'relname'=> 'required|',
            'uname'=>'required|min:4|max:10',
            'phone' =>'required|numeric',
            'email' =>'required|email',
            'upwd' => 'required|min:6|max:18',
            'repassword'=>'required|same:upwd',

            
            ],[
            'relname.required'=>'姓名不能为空',
            'uname.min'=>'昵称不小于3位',
            'uname.max'=>'昵称不大于10位',
            'phone.required'=>'手机号码不能为空',
            'phone.numeric'=>'手机号码格式不正确',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            'upwd.required' => '密码不能为空',
            'upwd.min' => '密码不能小于6位',
            'upwd.max'=>'密码不能大于18位',
            'repassword.required'=>'确认密码不能为空',
            'repass.same'=>'确认密码不一致',

            ]);
        $data=$request->except('_token','repassword');

        if(!empty($data['chuzhen']))
        {
            $chuzhen = $data['chuzhen'];
        }
        

        if(!empty($chuzhen)){
            $c = implode(',', $chuzhen);
            $data['chuzhen'] =$c;
        }
        
         //判断图片是否上传
        if($request->hasFile('headurl'))
        {
            if ($request-> file('headurl')->isValid())
            {


                $imgs = './updates/';
                $oldpath = $request -> file('headurl') -> getClientOriginalExtension();
                
                $filename = time().mt_rand(100000,999999);
                $request -> file('headurl') -> move($imgs,$filename.'.'.$oldpath);
                
                
                $data['headurl'] = $filename.'.'.$oldpath;
                
            }
        }
        if ($request->hasFile('cardpic1'))
         {
            
            if ($request-> file('cardpic1')->isValid())
            {   
                
               $imgs = './updates/';

                $oldpath = $request -> file('cardpic1') -> getClientOriginalExtension();
                
                $filename = time().mt_rand(100000,999999);
                $request -> file('cardpic1') -> move($imgs,$filename.'.'.$oldpath);
              
                $data['cardpic1'] = $filename.'.'.$oldpath;
                
            }
        }
        $data['upwd']=Crypt::encrypt($data['upwd']);
        $data['addtime'] = time();
        $data['utp'] = 2;
        $res=DB::table('hkyl_user')->insert($data);
        if($res){
            return redirect('/admin/expert/index')->with(['useradd'=>'数据添加成功']);
        }else{
            return back()->with(['useradd'=>'添加数据失败']);
        }
        
        
        
    }

    //信息修改
    public function edit($id)
    {
        $data=DB::table('hkyl_user')->where('id',$id)->first();
        $res = DB::table('hkyl_cate')-> where('pid','=',2)->get();
        $keshi = DB::table('hkyl_cate') -> where('pid','=','24') -> get();
      
        return view('admin.expert.edit',['data'=>$data,'res' => $res,'keshi' => $keshi]);
    }
    public function update(Request $request)
    {
        
        $this->validate($request,[
            'relname'=> 'required|',
            'uname'=>'required|min:2|max:10',
            'phone' =>'required|numeric',
            'email' =>'required|email',
            
            'repassword'=>'same:upwd',

            
            ],[
            'relname.required'=>'姓名不能为空',
            'uname.min'=>'昵称不小于2位',
            'uname.max'=>'昵称不大于10位',
            'phone.required'=>'手机号码不能为空',
            'phone.numeric'=>'手机号码格式不正确',
            'email.required' => '邮箱不能为空',
            'email.email' => '邮箱格式不正确',
            
            'repass.same'=>'确认密码不一致',

            ]);



      $data= $request->except('_token','repassword');
        $id = $data['id'];
         if(!empty($data['chuzhen']))
        {
            $chuzhen = $data['chuzhen'];
        }
        

        if(!empty($chuzhen)){
            $c = implode(',', $chuzhen);
            $data['chuzhen'] =$c;
        }
      //判断图片是否上传
        if($request->hasFile('headurl'))
        {
            if ($request-> file('headurl')->isValid())
            {


                $imgs = './updates/';
                $oldpath = $request -> file('headurl') -> getClientOriginalExtension();
                
                $filename = time().mt_rand(100000,999999);
                $request -> file('headurl') -> move($imgs,$filename.'.'.$oldpath);
                
                
                $data['headurl'] = $filename.'.'.$oldpath;
                
            }
        }else
        {
             unset($data['url']);
        }
        if ($request->hasFile('cardpic1'))
         {
            
            if ($request-> file('cardpic1')->isValid())
            {   
                
               $imgs = './updates/';

                $oldpath = $request -> file('cardpic1') -> getClientOriginalExtension();
                
                $filename = time().mt_rand(100000,999999);
                $request -> file('cardpic1') -> move($imgs,$filename.'.'.$oldpath);
              
                $data['cardpic1'] = $filename.'.'.$oldpath;
                
            }
        }else
        {
             unset($data['pic1']);
        }

      
        if(!empty($data['upwd']))
        {
            $data['upwd'] = Crypt::encrypt($data['upwd']);
        }else
        {
            $data['upwd'] = '';
        }
      
      
        $data['addtime'] = time();
        $data['utp'] = 2;
        $res = DB::table('hkyl_user') -> where('id',$id)->update($data);
     
        if($res)
            {
                
                return redirect('/admin/expert/index')->with(['user2edit'=>'医生信息修改成功']);
            }else
            {
                return back() -> with(['user2edit' => '医生信息修改失败']);
            }
     
    }
    //删除
    public function delete($id)
    {
        $res = DB::table('hkyl_user')->delete($id);
        if($res)
        {
            return redirect('/admin/expert/index')->with(['user2del'=>'数据删除成功']);
        }else{
            return back()->with(['user2del'=>'数据删除失败']);
        }
    }
}
