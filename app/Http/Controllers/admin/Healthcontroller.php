<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class Healthcontroller extends Controller
{
    //文章添加
    public function add()
    {
        $data= DB::table('hkyl_cate')
        ->orderBy('id')
        ->where('pid','=','4')
        ->get();
         return view('admin.health.add',['data'=>$data]);

    }

    //添加数据
    public function insert(Request $request)
    {
         $data = $request -> except('_token');
         if(empty($data['seoname']))
         {
            $data['seoname'] = $data['name'];

         }
         if(empty($data['seo']))
         {
            $data['seo'] = $data['name'];
         }
         $data['depict'] = trim($data['depict']);
         if(empty($data['depict']))
         {
            
            $data['depict'] = strip_tags($data['news']);
            $data['depict'] = str_limit($data['depict'] ,$limit = 400);
            $data['depict'] = trim($data['depict']);
         }
         
       
         //上传图片
        if ($request->hasFile('img'))
         {
         	if ($request-> file('img')->isValid())
         	{
         		$oldpath = $request -> file('img') -> getClientOriginalExtension();
         		$filename = time().mt_rand(100000,999999);
         		$request -> file('img') -> move('./updates',$filename.'.'.$oldpath);
         		
         		$data['img'] = $filename.'.'.$oldpath;
         	}
         }else{
             $data['img'] ='';
         }
         $data['addtime'] = time();
        
        
         
         //执行添加
         $res = DB::table('hkyl_health') -> insert($data);
         if($res)
         {
         	return redirect('/admin/health/index') -> with(['info'=>'添加成功']);

         }else{
         	return back() ->with(['info'=>'添加失败']);
         }
    }
    //列表页
    public function index(Request $request)
    {     
    	$data=DB::table('hkyl_health')
        ->where('name','like','%'.$request->keyword.'%')
        ->paginate(10);;
        $cate= DB::table('hkyl_cate')
        ->orderBy('id')
        ->where('pid','=','4')
        ->get();
        return view('admin.health.index',['data' => $data,'cate'=>$cate,'request' => $request->all()]);
    }
    //edit
    public function edit($id)
    {
        $data = DB::table('hkyl_health') -> where('id',$id) ->first();
        $cate = DB::table('hkyl_cate') -> where('id',$data -> cid) ->first();
        $res  = DB::table('hkyl_cate') -> where('pid',$cate ->  pid) -> get();
        
        return view('admin.health.edit',['data'=>$data,'res'=>$res]);
    }
    //update
    public function update(Request $request)
    {
        $data = $request ->except('_token');
        //处理图片
        if ($request->hasFile('img'))
        {
            
            if ($request-> file('img')->isValid())
            {   
                 unset($data['pic']);
                $img = DB::table('hkyl_health') -> where('id',$data['id']) -> first() -> img;
               
                $oldimg= './updates/'.$img;
                
                $imgs = './updates/';
                $oldpath = $request -> file('img') -> getClientOriginalExtension();
                
                $filename = time().mt_rand(100000,999999);
                $request -> file('img') -> move($imgs,$filename.'.'.$oldpath);
                if(file_exists($oldimg))
                { 
  
                    unlink($oldimg);
                   
                }
                
                $data['img'] = $filename.'.'.$oldpath;
                
            }
        }else{
            if(!empty($data['pic']))
            {
                $data['img'] = $data['pic'];
                unset($data['pic']);
            }
            
           
        }
        $data['depict'] = trim($data['depict']);
        unset($data['addtime']);
       

        if(empty($data['news']))
        {
            unset($data['news']);

        }
       
        
            $res = DB::table('hkyl_health') -> where('id',$data['id']) -> update($data);
             if($res)
             {
                return redirect('/admin/health/index') -> with(['info'=>'修改成功']);

             }else{
                return back() ->with(['info'=>'修改失败']);
             }
    }
        
         
    
    //delete
    public function delete($id)
    {  
        $img = DB::table('hkyl_health') -> where('id',$id) ->first() ->img;
        $oldimg = './updates/'.$img;
        $res = DB::table('hkyl_health') -> delete($id);
        if($res)
         {   
            if(file_exists($oldimg))
            {
                unlink($oldimg);
            }
            return redirect('/admin/health/index') -> with(['info'=>'删除成功']);

         }else{
            return back() ->with(['info'=>'删除失败']);
         }
    }

   
}
