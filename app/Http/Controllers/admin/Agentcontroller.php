<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class Agentcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $data= DB::table('hkyl_agent')-> orderBY('id')
        ->where('name','like','%'.$request->keyword.'%')
        ->paginate(10) ;
        
        return view('admin.agent.index',['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //分类添加
       
        
        return view('admin.agent.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行分类添加
        $data=$request->except('_token');
       
        
        $res=DB::table('hkyl_agent')->insert($data);
        if ($res) {
            return redirect('/admin/agent')->with(['info'=>'数据添加成功']);
        }else{
            return back()->with(['info'=>'数据添加失败']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        //编辑分类
        $data = DB::table('hkyl_agent')->where('id',$id)->first();

        

        return view('admin.agent.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $data=$request->except('_token','_method');

        
        
        $res=DB::table('hkyl_agent')->where('id', $id)->update($data);

        if ($res) {

            return redirect('/admin/agent')->with(['info'=>'数据修改成功']);

        }else{

            return back()->with(['info'=>'数据修改失败']);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除
        $se = DB::table('hkyl_agent')->where('pid',$id)->first();
        if($se)
        {
            return back()->with(['info'=>'有子分类不能删除']);
        }
        $res = DB::table('hkyl_agent')->delete($id);
        if ($res) {
            return redirect('/admin/agent')->with(['info'=>'数据删除成功']);
        }else{
            return back()->with(['info'=>'数据删除失败']);
        }

    }
}
