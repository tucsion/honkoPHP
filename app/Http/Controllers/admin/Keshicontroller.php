<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class Keshicontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $data= DB::table('hkyl_keshi As c1')
        -> LeftJoin('hkyl_keshi As c2','c1.pid','=','c2.id')
        ->select('c1.*','c2.name As parentName',DB::raw("concat(c1.path,',',c1.id) as andpath"))
        ->where('c1.name','like','%'.$request->keyword.'%')
        ->orderBY('andpath')
        ->paginate(10);
        foreach ($data as $k => $v) {
            $num=substr_count($v->path, ',');
            $data[$k]->name = str_repeat('|---', $num).$v->name;
            if($data[$k] -> parentName == '')
            {
                $data[$k] -> parentName = '根分类';
            }
        }
        return view('admin.keshi.index',['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //分类添加
        $data= DB::table('hkyl_keshi')
        ->select('*',DB::raw("concat(path,',',id) as andpath"))
        ->orderBy('andpath')
        ->get();
        foreach ($data as $k => $v) {
            $num=substr_count($v->path, ',');
            $data[$k]->name= str_repeat('|---', $num).$v->name;
        }
        return view('admin.keshi.add',['data'=>$data]);
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
       
        if($data['pid'] == '0')
        {
            $data['path']= '0';
        }else{
             $newpath=DB::table('hkyl_keshi')->where('id',$data['pid'])->first()->path;
             $data['path']=$newpath.','.$data['pid'];
        }
        if($data['describe'] == '')
        {
            $data['describe'] = $data['name'];

        }
        
        $res=DB::table('hkyl_keshi')->insert($data);
        if ($res) {
            return redirect('/admin/keshi')->with(['info'=>'数据添加成功']);
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
        $se = DB::table('hkyl_keshi')->where('pid',$id)->first();
        if($se)
        {
            return back()->with(['info'=>'有子分类不能删除']);
        }
        $res = DB::table('hkyl_keshi')->delete($id);
        if ($res) {
            return redirect('/admin/keshi')->with(['info'=>'数据删除成功']);
        }else{
            return back()->with(['info'=>'数据删除失败']);
        }

    }
}
