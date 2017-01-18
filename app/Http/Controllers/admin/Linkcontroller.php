<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class LinkController extends Controller
{
    //add
    public function add()
    {
        return view('admin.link.add');
    }
    //insert 
    public function insert(Request $request)
    {
        $this->validate($request,[
            'yqname'=> 'required',
            'addtime'=>'required',
            'yqlink' => 'required',
            ],[
            'yqname.required'=>'标题不能为空',
            'addtime.required'=>'创建时间不能为空',
            'yqlink.required' => '链接不能为空',
            ]);
        $data = $request -> except('_token');

        //上传图片
         if ($request->hasFile('yqpic'))
         {
            if ($request-> file('yqpic')->isValid())
            {
                $oldpath = $request -> file('yqpic') -> getClientOriginalExtension();
                $filename = time().mt_rand(100000,999999);
                $request -> file('yqpic') -> move('./updates',$filename.'.'.$oldpath);
                
                $data['yqpic'] = $filename.'.'.$oldpath;
            }
         }else
         {
            return back() ->with(['yqpic'=>'图片未上传']);
         }
        
          //执行添加
         $res = DB::table('hkyl_youlian') -> insert($data);
         
         if($res)
         {
            return redirect('/admin/link/index') -> with(['info'=>'添加成功']);

         }else{
            return back() ->with(['info'=>'添加失败']);
         }

    }
     // index
     public function index(Request $request)
     {
        $data = DB::table('hkyl_youlian')-> where('yqname','like','%'.$request->keyword.'%') -> paginate(10);

       return view('admin.link.index',['data' => $data,'request' => $request->all()]);

     }
     //edit
     public function edit($id)
     {
        $data = DB::table('hkyl_youlian') -> where('id',$id) ->first();

        return view('admin.link.edit',['data'=>$data]);
     }
     //updates
     public function update(Request $request)
     {
        $this->validate($request,[
            'yqname'=> 'required',
            'addtime'=>'required',
            'yqlink' => 'required',
            ],[
            'yqname.required'=>'标题不能为空',
            'addtime.required'=>'创建时间不能为空',
            'yqlink.required' => '友链地址不能为空',
            ]);
        $data = $request -> except('_token');
        $id = $data['id'];
        unset($data['id']);
        // dd($data);
        // 上传图片
        if ($request->hasFile('yqpic'))
         {
            if ($request-> file('yqpic')->isValid())
            {   

                $img = DB::table('yqpic') ->where('id',$data['id']) -> first() -> img;

                $oldimg= './updates/'.$img;

                $oldpath = $request -> file('yqpic') -> getClientOriginalExtension();
                $filename = time().mt_rand(100000,999999);
                $request -> file('yqpic') -> move('./updates',$filename.'.'.$oldpath);

                if(file_exists($oldimg))
                { 
                    unlink($oldimg);
                }
                
                $data['yqpic'] = $filename.'.'.$oldpath;
            }
         }
                $res = DB::table('hkyl_youlian') -> where('id',$id) -> update($data);
                

                 if($res)
                 {
                    return redirect('/admin/link/index') -> with(['info'=>'修改成功']);

                 }else{
                    return back() ->with(['info'=>'修改失败']);
                 }

     }
     //delete
     public function delete($id)
     {
        //获取图片的路径
        $img = DB::table('hkyl_youlian') -> where('id',$id) -> first() -> yqpic;
        $oldimg = './updates/'.$img;

        $res = DB::table('hkyl_youlian') -> delete($id);
        //判断
        if($res)
         {   
            if(file_exists($oldimg))
            {
                unlink($oldimg);
            }
            return redirect('/admin/link/index') -> with(['info'=>'删除成功']);

         }else{
            return back() ->with(['info'=>'删除失败']);
         }
     }
 }
