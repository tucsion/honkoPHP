<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class MyserveController extends Controller
{
    public function index(Request $request)
    {
    	 
    	$data = DB::table('hkyl_myserve') 
        -> select('hkyl_myserve.*','hkyl_user.relname As srname','hkyl_user.phone As sphone')
        -> Leftjoin('hkyl_user','hkyl_myserve.uid','=','hkyl_user.id')
    	-> where ('servenum' , 'like','%'.$request -> input('keywords').'%')
    	-> paginate($request -> input('num',10));

       
       
    	return view('admin.myserve.index',['data' => $data,'request' => $request -> all()]);
    }
    public function detail($id)
    {   
       


        $data = DB::table('hkyl_myserve') -> where('id',$id) ->first();
        $user = DB::table('hkyl_user') -> where('id',$data -> uid) -> first();
        $pay = DB::table('hkyl_pay') -> where('orderid',$data -> id) ->first();
        $sxq = DB::table('hkyl_servexq') -> where('servenum',$data -> servenum ) -> first();

        return view('admin.myserve.detail',['data' => $data,'user' => $user,'pay' => $pay, 'sxq' => $sxq]);
    }
    public function delete($id)
    {
    	$res = DB::table('hkyl_myserve') -> delete($id);
    	if($res)
    	{
    		return redirect('admin/myserve/index') -> with(['myserve' => '删除成功']);
    	}else
    	{
    		return back() -> with(['myserve' => '删除失败']);
    	}
    }
}
