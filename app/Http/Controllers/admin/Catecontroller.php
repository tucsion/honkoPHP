<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class Catecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $data= DB::table('hkyl_cate As c1')
        -> LeftJoin('hkyl_cate As c2','c1.pid','=','c2.id')
        ->select('c1.*','c2.cate As parentName',DB::raw("concat(c1.path,',',c1.id) as andpath"))
        ->where('c1.cate','like','%'.$request->keyword.'%')
        ->orderBY('andpath')
        
        
        ->paginate(10);
        foreach ($data as $k => $v) {
            $num=substr_count($v->path, ',');
            $data[$k]->cate= str_repeat('|---', $num).$v->cate;
            if($data[$k] -> parentName == '')
            {
                $data[$k] -> parentName = '根分类';
            }
        }
        return view('admin.cate.index',['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //分类添加
        $data= DB::table('hkyl_cate')
        ->select('*',DB::raw("concat(path,',',id) as andpath"))
        ->orderBy('andpath')
        ->get();
        foreach ($data as $k => $v) {
            $num=substr_count($v->path, ',');
            $data[$k]->cate= str_repeat('|---', $num).$v->cate;
        }
        return view('admin.cate.add',['data'=>$data]);
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
             $newpath=DB::table('hkyl_cate')->where('id',$data['pid'])->first()->path;
             $data['path']=$newpath.','.$data['pid'];
        }
      
        $res=DB::table('hkyl_cate')->insert($data);
        if ($res) {
            return redirect('/admin/cate')->with(['info'=>'数据添加成功']);
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
        $data = DB::table('hkyl_cate')->where('id',$id)->first();

        $alldata= DB::table('hkyl_cate')
        ->select('*',DB::raw("concat(path,',',id) as andpath"))
        ->orderBy('andpath')
        ->get();
        foreach ($alldata as $k => $v) {
            $num=substr_count($v->path, ',');
            $alldata[$k]->cate= str_repeat('|---', $num).$v->cate;
        }

        return view('admin.cate.edit',['data'=>$data,'alldata'=>$alldata]);
        
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
        //修改
        
        
        $data=$request->except('_token','_method');

        if($data['pid'] == '0')
        {
            $data['path']= '0';

        }else{

             $newpath=DB::table('hkyl_cate')->where('id',$data['pid'])->first()->path;
             $data['path']=$newpath.','.$data['pid'];
        }
        
        $res=DB::table('hkyl_cate')->where('id', $id)->update($data);

        if ($res) {

            return redirect('/admin/cate')->with(['info'=>'数据修改成功']);

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
        $se = DB::table('hkyl_cate')->where('pid',$id)->first();
        if($se)
        {
            return back()->with(['info'=>'有子分类不能删除']);
        }
        $res = DB::table('hkyl_cate')->delete($id);
        if ($res) {
            return redirect('/admin/cate')->with(['info'=>'数据删除成功']);
        }else{
            return back()->with(['info'=>'数据删除失败']);
        }

    }
}
