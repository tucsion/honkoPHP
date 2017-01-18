<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use Crypt;
class Patientcontroller extends Controller
{
	
    //患者信息
    public function index(Request $request)

    {

        //搜索+分页
        //
        
        $data = DB::table('hkyl_user') 
        -> where ('phone' , 'like','%'.$request -> input('keywords').'%')
        -> where ('utp',1)
        -> paginate($request -> input('num',10));
        

        //列表
        return view('admin.patient.index',['data' => $data,'request' => $request -> all()]);

    }
    public function add()

    {

        return view('admin.patient.add');

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
       
        //判断图片是否上传
        if($request->hasFile('cardpic1'))
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
        if ($request->hasFile('cardpic2'))
         {
            
            if ($request-> file('cardpic2')->isValid())
            {   
                
               $imgs = './updates/';

                $oldpath = $request -> file('cardpic2') -> getClientOriginalExtension();
                
                $filename = time().mt_rand(100000,999999);
                $request -> file('cardpic2') -> move($imgs,$filename.'.'.$oldpath);
              
                $data['cardpic2'] = $filename.'.'.$oldpath;
                
            }
        }
        $data['upwd']=Crypt::encrypt($data['upwd']);
        $data['addtime'] = time();
        $data['utp'] = 1;
        
        $res=DB::table('hkyl_user')->insert($data);
        if($res){
            return redirect('/admin/patient/index')->with(['user2add'=>'数据添加成功']);
        }else{
            return back()->with(['user2add'=>'添加数据失败']);
        }


    }

    //信息修改
    public function edit($id)
    {
      $data=DB::table('hkyl_user')->where('id',$id)->first();
      
      return view('admin.patient.edit',['data'=>$data]);
    }
    public function update(Request $request)
    {
        
        $this->validate($request,[

            'repassword'=>'same:upwd',
 
            ],[

            'repassword.same'=>'确认密码不一致',

            ]);

      $data= $request->except('_token','repassword');
        $id = $data['id'];
        //判断图片是否上传
      if($request->hasFile('cardpic1'))
        {
             unset($data['pic1']);
                $img = DB::table('hkyl_user') -> where('id',$id) -> first() -> cardpic1;
               
                $oldimg= './updates/'.$img;
                
                $imgs = './updates/';
                $oldpath = $request -> file('cardpic1') -> getClientOriginalExtension();
                
                $filename = time().mt_rand(100000,999999);
                $request -> file('cardpic1') -> move($imgs,$filename.'.'.$oldpath);
                if(file_exists($oldimg))
                { 
                    
                    
                   
                    unlink($oldimg);
                   
                }
                
                $data['cardpic1'] = $filename.'.'.$oldpath;
                
            }
        else{
            
            
            unset($data['pic1']);
           
        }
        if ($request->hasFile('cardpic2'))
         {
            
            if ($request-> file('cardpic2')->isValid())
            {   
                unset($data['cardpic2']);
                $img = DB::table('hkyl_user') -> where('id',$id) -> first() -> cardpic2;
               $oldimg= './updates/'.$img;
               $imgs = './updates/';

                $oldpath = $request -> file('cardpic2') -> getClientOriginalExtension();
                
                $filename = time().mt_rand(100000,999999);
                $request -> file('cardpic2') -> move($imgs,$filename.'.'.$oldpath);

                if(file_exists($oldimg))
                { 
                    
                   
                   
                    unlink($oldimg);
                    
                }
                
                
                $data['cardpic2'] = $filename.'.'.$oldpath;
                
            }
        }else{
           
            unset($data['pic2']);
        }

      
        if(!empty($data['upwd']))
        {
            $data['upwd'] = Crypt::encrypt($data['upwd']);
        }else
        {
            $data['upwd'] = '';
        }
      
      
     $res = DB::table('hkyl_user') -> where('id',$id)->update($data);
     
        if($res)
            {
                
                return redirect('/admin/patient/index')->with(['user'=>'患者信息修改成功']);
            }else
            {
                return back() -> with(['user' => '患者信息修改失败']);
            }
     
    }
    //删除
    public function delete($id)
    {
        $res = DB::table('hkyl_user')->delete($id);
        if($res)
        {
            return redirect('/admin/patient/index')->with(['info'=>'数据删除成功']);
        }else{
            return back()->with(['info'=>'数据删除失败']);
        }
    }
}
