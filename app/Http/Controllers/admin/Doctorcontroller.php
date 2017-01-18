<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class Doctorcontroller extends Controller
{
    //列表页

    public function index(Request $request)
    {     
    	$data=DB::table('hkyl_doctor')
        ->where('name','like','%'.$request->keyword.'%')
        ->paginate(10);;
        
        return view('admin.doctor.index',['data' => $data,'request' => $request->all()]);
    }

  
    //delete
    public function delete($id)
    {  
        $img = DB::table('hkyl_doctor') -> where('id',$id) ->first() ->img;
        $oldimg = './updates/'.$img;
        $res = DB::table('hkyl_doctor') -> delete($id);
        if($res)
         {   
            if(file_exists($oldimg))
            {
                unlink($oldimg);
            }
            return redirect('/admin/doctor/index') -> with(['info'=>'删除成功']);

         }else{
            return back() ->with(['info'=>'删除失败']);
         }
    }

   
}
