<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class BannerController extends Controller
{
    //add
    public function add()
    {
        return view('admin.banner.add');
    }
    //insert 
    public function insert(Request $request)
    {
        $data = $request -> except('_token');

        
        if(empty($data['bname']))
        {
            return back() ->with(['bname'=>'标题不能为空']);
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
         }else
         {
            return back() ->with(['img'=>'banner图片未上传']);
         }
        
          //执行添加
         $res = DB::table('hkyl_banner') -> insert($data);
         
         if($res)
         {
            return redirect('/admin/banner/index') -> with(['info'=>'添加成功']);

         }else{
            return back() ->with(['info'=>'添加失败']);
         }

    }
     // index
     public function index(Request $request)
     {
        $data = DB::table('hkyl_banner')-> where('bname','like','%'.$request->keyword.'%') -> paginate(10);

       return view('admin.banner.index',['data' => $data,'request' => $request->all()]);

     }
     //edit
     public function edit($id)
     {
        $data = DB::table('hkyl_banner') -> where('id',$id) ->first();

        return view('admin.banner.edit',['data'=>$data]);
     }
     //updates
     public function update(Request $request)
     {
        $this->validate($request,[
            'bname'=> 'required',
            'addtime'=>'required',
            ],[
            'bname.required'=>'标题不能为空',
            'addtime.required'=>'创建时间不能为空',
            ]);
        $data = $request -> except('_token');
        $id = $data['id'];
        unset($data['id']);
        // dd($data);
        // 上传图片
        if ($request->hasFile('img'))
         {
            if ($request-> file('img')->isValid())
            {   

                $img = DB::table('hkyl_banner') ->where('id',$id) -> first() -> img;

                $oldimg= './updates/'.$img;

                $oldpath = $request -> file('img') -> getClientOriginalExtension();
                $filename = time().mt_rand(100000,999999);
                $request -> file('img') -> move('./updates',$filename.'.'.$oldpath);

                if(file_exists($oldimg))
                { 
                    unlink($oldimg);
                }
                
                $data['img'] = $filename.'.'.$oldpath;
            }
         }
                $res = DB::table('hkyl_banner') -> where('id',$id) -> update($data);
                

                 if($res)
                 {
                    return redirect('/admin/banner/index') -> with(['info'=>'修改成功']);
                    
                 }else{
                    return back() ->with(['info'=>'修改失败']);
                 }

     }
     //delete
     public function delete($id)
     {
        //获取图片的路径
        $img = DB::table('hkyl_banner') -> where('id',$id) -> first() -> img;
        $oldimg = './updates/'.$img;

        $res = DB::table('hkyl_banner') -> delete($id);
        //判断
        if($res)
         {   
            if(file_exists($oldimg))
            {
                unlink($oldimg);
            }
            return redirect('/admin/banner/index') -> with(['info'=>'删除成功']);

         }else{
            return back() ->with(['info'=>'删除失败']);
         }
     }
 }
