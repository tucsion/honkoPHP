<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class MydealController extends Controller
{
    public function index(Request $request)
    {
    	 
    	$data = DB::table('hkyl_mydeal') 
        -> select('hkyl_mydeal.*','hkyl_user.relname As dname','hkyl_user.phone As phone ')
        -> Leftjoin('hkyl_user','hkyl_mydeal.uid','=','hkyl_user.id')
    	-> where ('dnumber' , 'like','%'.$request -> input('keywords').'%')
    	-> paginate($request -> input('num',10));

       
       
    	return view('admin.mydeal.index',['data' => $data,'request' => $request -> all()]);
    }
   
    public function delete($id)
    {
    	$res = DB::table('hkyl_mydeals') -> delete($id);
    	if($res)
    	{
    		return redirect('admin/mydeal/index') -> with(['mydeal' => '删除成功']);
    	}else
    	{
    		return back() -> with(['mydeal' => '删除失败']);
    	}
    }
}
