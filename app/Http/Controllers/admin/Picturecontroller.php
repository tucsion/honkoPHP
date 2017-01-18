<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class PictureController extends Controller
{
    //add
    public function add()
    {
        return view('admin.pic.add');
    }
    //insert 
    public function insert(Request $request)
    {
        $data = $request -> except('_token');
        
        if(empty($data['name']))
        {
            return back() ->with(['title'=>'标题不能为空']);
        }
        if(empty($data['link']))
        {
            return back() ->with(['url' => '链接不能为空']);
        }
       
        //上传图片
         if ($request->hasFile('pic'))
         {
            if ($request-> file('pic')->isValid())
            {
                $oldpath = $request -> file('pic') -> getClientOriginalExtension();
                $filename = time().mt_rand(100000,999999);
                $request -> file('pic') -> move('./updates',$filename.'.'.$oldpath);
                
                $data['pic'] = $filename.'.'.$oldpath;
            }
         }else
         {
            return back() ->with(['pic'=>'图片未上传']);
         }
        
          //执行添加
         $res = DB::table('hkyl_pic') -> insert($data);
         
         if($res)
         {
            return redirect('/admin/pic/index') -> with(['info'=>'添加成功']);

         }else{
            return back() ->with(['info'=>'添加失败']);
         }

    }
     // index
     public function index(Request $request)
     {
        $data = DB::table('hkyl_pic')-> where('name','like','%'.$request->keyword.'%') -> paginate(10);

       return view('admin.pic.index',['data' => $data,'request' => $request->all()]);

     }
     //edit
     public function edit($id)
     {
        $data = DB::table('hkyl_pic') -> where('id',$id) ->first();

        return view('admin.pic.edit',['data'=>$data]);
     }
     //update
     public function update(Request $request)
     {
        $this->validate($request,[
            'name'=> 'required',
            'link'=>'required',
            ],[
            'name.required'=>'标题不能为空',
            'link.required'=>'链接不能为空',
            ]);
        $data = $request -> except('_token');
        $id = $data['id'];
        unset($data['id']);
        // dd($data);
        // 上传图片
        if ($request->hasFile('pic'))
         {
            if ($request-> file('pic')->isValid())
            {   

                $img = DB::table('pic') ->where('id',$data['id']) -> first() -> img;

                $oldimg= './updates/'.$img;

                $oldpath = $request -> file('pic') -> getClientOriginalExtension();
                $filename = time().mt_rand(100000,999999);
                $request -> file('pic') -> move('./updates',$filename.'.'.$oldpath);

                if(file_exists($oldimg))
                { 
                    unlink($oldimg);
                }
                
                $data['pic'] = $filename.'.'.$oldpath;
            }
         }
                $res = DB::table('hkyl_pic') -> where('id',$id) -> update($data);
                

                 if($res)
                 {
                    return redirect('/admin/pic/index') -> with(['info'=>'修改成功']);

                 }else{
                    return back() ->with(['info'=>'修改失败']);
                 }

     }
     //delete
     public function delete($id)
     {
        //获取图片的路径
        $img = DB::table('hkyl_pic') -> where('id',$id) -> first() -> pic;
        $oldimg = './updates/'.$img;

        $res = DB::table('hkyl_pic') -> delete($id);
        //判断
        if($res)
         {   
            if(file_exists($oldimg))
            {
                unlink($oldimg);
            }
            return redirect('/admin/pic/index') -> with(['info'=>'删除成功']);

         }else{
            return back() ->with(['info'=>'删除失败']);
         }
     }
 }
