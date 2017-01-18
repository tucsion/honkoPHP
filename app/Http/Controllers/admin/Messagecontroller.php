<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class MessageController extends Controller
{
    //留言列表
    public function index(Request $request)
    {
       
      $data = DB::table('hkyl_message') 
        -> select('hkyl_message.*','hkyl_user.relname As mname','hkyl_user.phone As phone','hkyl_user.email As email')
        -> Leftjoin('hkyl_user','hkyl_message.uid','=','hkyl_user.id')
      -> where ('hkyl_user.relname' , 'like','%'.$request -> input('keywords').'%')
      -> paginate($request -> input('num',10));

       
       
      return view('admin.message.index',['data' => $data,'request' => $request -> all()]);
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
