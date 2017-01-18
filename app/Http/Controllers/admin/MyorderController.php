<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class MyorderController extends Controller
{
    //订单列表
    public function index(Request $request)
    {
    	 
    	$data = DB::table('hkyl_myorder') 
        -> select('hkyl_myorder.*','hkyl_user.relname As oname')
        -> Leftjoin('hkyl_user','hkyl_myorder.uid','=','hkyl_user.id')
    	-> where ('onumber' , 'like','%'.$request -> input('keywords').'%')
    	-> paginate($request -> input('num',10));

       
       
    	return view('admin.myorder.index',['data' => $data,'request' => $request -> all()]);
    }
    //订单详情
    public function detail($id)
    {   
       


        $data = DB::table('hkyl_myorder') -> where('id',$id) ->first();
        $user = DB::table('hkyl_user') -> where('id',$data -> uid) -> first();
        $address = DB::table('hkyl_address') -> where('id',$data -> aid) ->first();
        $pay = DB::table('hkyl_pay') -> where('orderid',$data -> id) ->first();
        $oxq = DB::table('hkyl_orderxq') -> where('unumber',$data -> onumber) -> get();

        return view('admin.myorder.detail',['data' => $data,'user' => $user,'address' => $address,'pay' => $pay, 'oxq' => $oxq]);
    }
    //ajaxupdate
    public function ajaxupdate(Request $request)
    {
    	$id = $request -> input('id');

        
    	$data = DB::table('hkyl_myorder') -> select('state') -> where('id',$id) -> first();
    	
    	if($data -> state == 1)
    	{
    		$res = DB::table('hkyl_myorder') -> where('id',$id) -> update(['state' => 2]);

    		if($res)
    		{
    			return response() -> json(2);
    		}else
    		{
    			return response() -> json(5);
    		}
    		
    	}else
    	{
    		$res = DB::table('hkyl_myorder') -> where('id',$id) -> update(['state' => 1]);
    		if($res)
    		{
    			return response() -> json(1);
    		}else
    		{
    			return response() -> json(5);
    		}
    		
    	}

    }
    //删除
    public function delete($id)
    {
    	$res = DB::table('hkyl_myorder') -> delete($id);
    	if($res)
    	{
    		return redirect('admin/myorder/index') -> with(['myorder' => '删除成功']);
    	}else
    	{
    		return back() -> with(['myorder' => '删除失败']);
    	}
    }
}
