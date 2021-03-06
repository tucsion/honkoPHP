<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class Goodscontroller extends Controller
{
    //商品添加
    public function add()
    {
        $data= DB::table('hkyl_cate')
        ->orderBy('id')
        ->where('pid','=','9')
        ->get();
        
        $res = DB::table('hkyl_scope')
        ->orderBy('id')
        ->get();
        $vender = DB::table('hkyl_vender') -> orderBy('id') -> get();
        $agent = DB::table('hkyl_agent') -> orderBy('id') ->get();
       
         return view('admin.goods.add',['data'=>$data,'res'=>$res,'vender'=> $vender,'agent'=> $agent]);

    }

    //添加数据
    public function insert(Request $request)
    {
         $data = $request -> except('_token');
      
         //上传图片
        if ($request->hasFile('img'))
         {
         	if ($request-> file('img')->isValid())
         	{
         		$oldpath = $request -> file('img') -> getClientOriginalExtension();
         		$filename = time().mt_rand(100000,999999);
         		$request -> file('img') -> move('./updates/goods',$filename.'.'.$oldpath);
         		
         		$data['img'] = $filename.'.'.$oldpath;
         	}
         }else{
             return back() ->with(['img'=>'商品图片未上传']);
         }
         
         $data['issuetime'] = strtotime($data['issuetime']);
         //执行添加
         $res = DB::table('hkyl_goods') -> insert($data);
         if($res)
         {
         	return redirect('/admin/goods/index') -> with(['info'=>'添加成功']);

         }else{
         	return back() ->with(['info'=>'添加失败']);
         }
    }
    //列表页
    public function index(Request $request)
    {     
    	$data=DB::table('hkyl_goods')
        ->where('gname','like','%'.$request->keyword.'%')
        ->paginate(10);
        $cate = DB::table('hkyl_cate')
        ->orderBy('id')
        ->where('pid','=','9')
        ->get();

        return view('admin.goods.index',['data' => $data,'cate'=>$cate,'request' => $request->all()]);
    }
    public function editxt($id)
    {
        $tuisong = DB::table('hkyl_winmsd') -> where('id',$id) -> first();
       return view('admin.xitong.edit',['tuisong'=>$tuisong]);
    }
    public function updatext(Request $request)
    {
        $data = $request -> except('_token');
        $res= DB::table('hkyl_winmsd') -> update($data);
        if($res)
        {
            return redirect('/admin/xitong')->with(['info'=>'数据修改成功']);
        }else{
            return back() -> with(['info'=>'数据修改失败']);
        }
       
    }
    //edit
    public function edit($id)
    {
        $good = DB::table('hkyl_goods') -> where('id',$id) ->first();
        $cate = DB::table('hkyl_cate') -> where('id',$good -> cid) ->first();
        $res  = DB::table('hkyl_cate') -> where('pid',$cate ->  pid) -> get();
        $scope = DB::table('hkyl_scope')
        ->orderBy('id')
        ->get();
        $vender = DB::table('hkyl_vender') -> orderBy('id') -> get();
        $agent = DB::table('hkyl_agent') -> orderBy('id') ->get();
     
        return view('admin.goods.edit',['good'=>$good,'res'=>$res,'vender'=> $vender,'agent'=> $agent,'scope'=>$scope]);
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
                $img = DB::table('hkyl_set') -> where('id',1) -> first() -> logo1;
               
                $oldimg= './updates/'.$img;
                
                $imgs = './updates/';
                $oldpath = $request -> file('img') -> getClientOriginalExtension();
                
                $filename = time().mt_rand(100000,999999);
                $request -> file('img') -> move($imgs,$filename.'.'.$oldpath);
                if(file_exists($oldimg))
                { 
                    
                    
                   
                    unlink($oldimg);
                   
                }
                
                $data['img'] = $filename.'.'.$oldpath;
                
            }
        }else{
            
            $data['img'] = $data['pic'];
            unset($data['pic']);
           
        }
        
            $res = DB::table('hkyl_goods') -> where('id',$data['id']) -> update($data);
             if($res)
             {
                return redirect('/admin/goods/index') -> with(['info'=>'修改成功']);

             }else{
                return back() ->with(['info'=>'修改失败']);
             }
         
    }
    //delete
    public function delete($id)
    {  
        $img = DB::table('hkyl_goods') -> where('id',$id) ->first() ->img;
        $oldimg = './updates/'.$img;
        $res = DB::table('hkyl_goods') -> delete($id);
        if($res)
         {   
            if(file_exists($oldimg))
            {
                unlink($oldimg);
            }
            return redirect('/admin/goods/index') -> with(['info'=>'删除成功']);

         }else{
            return back() ->with(['info'=>'删除失败']);
         }
    }

   
}
