<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class CommentController extends Controller
{
    //留言列表
    public function index(Request $request)
    {
       
      $data = DB::table('hkyl_comment') 
      -> select('hkyl_comment.*','hkyl_user.uname As cname')
      -> Leftjoin('hkyl_user','hkyl_comment.uid','=','hkyl_user.id')
      -> where ('hkyl_user.uname' , 'like','%'.$request -> input('keywords').'%')
      -> paginate($request -> input('num',10));

       
       
      return view('admin.comment.index',['data' => $data,'request' => $request -> all()]);
    }
    //留言详情
    public function detail($id)
    {   
       


        $data = DB::table('hkyl_message') -> where('id',$id) ->first();
        $user = DB::table('hkyl_user') -> where('id',$data -> uid) -> first();

        return view('admin.message.detail',['data' => $data,'user' => $user]);
    }

    //删除
    public function delete($id)
    {
      $res = DB::table('hkyl_message') -> delete($id);
      if($res)
      {
        return redirect('admin/message/index') -> with(['message' => '删除成功']);
      }else
      {
        return back() -> with(['message' => '删除失败']);
      }
    }
}
