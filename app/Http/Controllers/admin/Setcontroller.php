<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Crypt;

class SetController extends Controller
{
	//管理列表
    public function index()
    {
        $data =  DB::table('hkyl_set') -> where('id',1) -> first();
        
    	return view('admin.set.add',['data' => $data]);
    }

    //处理修改
    public function update(Request $request)
    {
    	$data = $request ->except('_token');
        
        //处理图片
        if ($request->hasFile('logo1'))
         {
            
            if ($request-> file('logo1')->isValid())
            {   
                 unset($data['pic1']);
                $img = DB::table('hkyl_set') -> where('id',1) -> first() -> logo1;
               
                $oldimg= './updates/'.$img;
                
                $imgs = './updates/';
                $oldpath = $request -> file('logo1') -> getClientOriginalExtension();
                
                $filename = time().mt_rand(100000,999999);
                $request -> file('logo1') -> move($imgs,$filename.'.'.$oldpath);
                if(file_exists($oldimg))
                { 
                    
                    
                   
                    unlink($oldimg);
                   
                }
                
                $data['logo1'] = $filename.'.'.$oldpath;
                
            }
        }else{
            
            $data['logo1'] = $data['pic1'];
            unset($data['pic1']);
           
        }
        if ($request->hasFile('logo2'))
         {
            
            if ($request-> file('logo2')->isValid())
            {   
                unset($data['pic2']);
                $img = DB::table('hkyl_set') -> where('id',1) -> first() -> logo2;
               $oldimg= './updates/'.$img;
               $imgs = './updates/';

                $oldpath = $request -> file('logo2') -> getClientOriginalExtension();
                
                $filename = time().mt_rand(100000,999999);
                $request -> file('logo2') -> move($imgs,$filename.'.'.$oldpath);

                if(file_exists($oldimg))
                { 
                    
                   
                   
                    unlink($oldimg);
                    
                }
                
                
                $data['logo2'] = $filename.'.'.$oldpath;
                
            }
        }else{
            $data['logo2'] = $data['pic2'];
            unset($data['pic2']);
        }
        if ($request->hasFile('map'))
         {
            
            if ($request-> file('map')->isValid())
            {   
                unset($data['map2']);
                $img = DB::table('hkyl_set') -> where('id',1) -> first() -> map;
                $oldimg= './updates/'.$img;
                $imgs = './updates/';
                $oldpath = $request -> file('map') -> getClientOriginalExtension();
                
                $filename = time().mt_rand(100000,999999);
                $request -> file('map') -> move($imgs,$filename.'.'.$oldpath);
                if(file_exists($oldimg))
                { 
                    
                    
                   
                    unlink($oldimg);

                }
                
                
                $data['map'] = $filename.'.'.$oldpath;
                
            }
        }else{
            $data['map'] = $data['map2'];
            unset($data['map2']);
        }
        $data['intro'] = strip_tags($data['intro']);
        $data['intro'] = trim($data['intro']);
        $res = DB::table('hkyl_set') -> where('id',1) -> update($data);
       
             if($res)
             {
                return redirect('/admin/set') -> with(['info'=>'修改成功']);

             }else{
                return back() ->with(['info'=>'修改失败']);
             }
    }



}
