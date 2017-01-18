<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class Lianxicontroller extends Controller
{
    //文章添加
    public function add()
    {
        $data= DB::table('hkyl_cate')
        ->orderBy('id')
        ->where('pid','=','61')
        ->get();
         return view('admin.lianxi.add',['data'=>$data]);
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
         $data['depict'] = trim($data['depict']);
         //执行添加
         $res = DB::table('hkyl_lianxi') -> insert($data);
         if($res)
         {
         	return redirect('/admin/lianxi/index') -> with(['lianxi'=>'添加成功']);

         }else{
         	return back() ->with(['lianxi'=>'添加失败']);
         }
    }
    //列表页
    public function index(Request $request)
    {     
    	$data=DB::table('hkyl_lianxi')
        ->where('name','like','%'.$request->keyword.'%')
        ->paginate(10);;
        $cate= DB::table('hkyl_cate')
        ->orderBy('id')
        ->where('pid','=','61')
        ->get();
        return view('admin.lianxi.index',['data' => $data,'cate'=>$cate,'request' => $request->all()]);
    }
    //edit
    public function edit($id)
    {
        $data = DB::table('hkyl_lianxi') -> where('id',$id) ->first();
        $cate = DB::table('hkyl_cate') -> where('id',$data -> cid) ->first();
        $res  = DB::table('hkyl_cate') -> where('pid',$cate ->  pid) -> get();
        
        return view('admin.lianxi.edit',['data'=>$data,'res'=>$res]);
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
                $img = DB::table('hkyl_lianxi') -> where('id',$data['id']) -> first() -> img;
               
                $oldimg= './updates/'.$img;
                
                $imgs = './updates/';
                $oldpath = $request -> file('img') -> getClientOriginalExtension();
                
                $filename = time().mt_rand(100000,999999);
                $request -> file('img') -> move($imgs,$filename.'.'.$oldpath);
                
                if(!empty($img))
                {
                    if(file_exists($oldimg))
                { 
  
                    unlink($oldimg);
                   
                }
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
       
        
            $res = DB::table('hkyl_lianxi') -> where('id',$data['id']) -> update($data);
             if($res)
             {
                return redirect('/admin/lianxi/index') -> with(['lianxi'=>'修改成功']);

             }else{
                return back() ->with(['lianxi'=>'修改失败']);
             }
    } 
    //delete
    public function delete($id)
    {  
        $img = DB::table('hkyl_lianxi') -> where('id',$id) ->first() ->img;
        $oldimg = './updates/'.$img;
        $res = DB::table('hkyl_lianxi') -> delete($id);
        if($res)
         {   
            if(file_exists($oldimg))
            {
                unlink($oldimg);
            }
            return redirect('/admin/lianxi/index') -> with(['lianxi'=>'删除成功']);

         }else{
            return back() ->with(['lianxi'=>'删除失败']);
         }
    }

   
}
