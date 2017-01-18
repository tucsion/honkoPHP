<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Overtrue\Pinyin\Pinyin;
use Crypt;

class IllController extends Controller
{
    //人物列表
    public function man()
    {   
      //查询所有分类
      $set = DB::table('hkyl_set') -> first();
      $expert = DB::table('hkyl_cate') -> where('pid','=','2') -> orderBy('id') -> get() ;
      $train = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> get();
      $ys = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> get();
      $hickey = DB::table('hkyl_cate') -> where('pid','=','5') -> orderBy('id') -> get();
      $procure = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> get();
      $goods = DB::table('hkyl_cate') -> where('pid','=','9') -> orderBy('id') -> get();
      $health = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> get();
      $banner = DB::table('hkyl_banner') -> where('id','=','2') -> first();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;
      $id = session('user') -> id;
      $user = DB::table('hkyl_cases')
      -> where('uid',$id)  
      -> orderBy('id')  
      -> paginate(5);
      return view('home.ill.man',['set' => $set,'user'=>$user,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);
    }
    //人物查看
    public function detail(Request $request)
    {
      
      $id = $request -> id;
      $user = DB::table('hkyl_cases') -> where('id',$id) ->first();
      return view('home.ill.detail',['user' => $user]);
    }
    
    //人物添加
    public function add()
    {
      
      return view('home.ill.add');
    }
    //人物修改
    public function edit(Request $request)
    {
      $id = $request -> id;
      $user = DB::table('hkyl_cases') -> where('id',$id) ->first();
      return view('home.ill.edit',['user' => $user]);
    }
    //人物删除
    public function delete(Request $request)
    {
      $id = $request -> id;
      $res = DB::table('hkyl_cases') -> delete($id);
      $data = DB::table('hkyl_disease') -> where('cid',$id) -> delete();
      if($res)
      {
        return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'删除失败']);
      }
    }
   
    //病例列表
    public function cases()
    {
      //查询所有分类
      $set = DB::table('hkyl_set') -> first();
      $expert = DB::table('hkyl_cate') -> where('pid','=','2') -> orderBy('id') -> get() ;
      $train = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> get();
      $ys = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> get();
      $hickey = DB::table('hkyl_cate') -> where('pid','=','5') -> orderBy('id') -> get();
      $procure = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> get();
      $goods = DB::table('hkyl_cate') -> where('pid','=','9') -> orderBy('id') -> get();
      $health = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> get();
      $banner = DB::table('hkyl_banner') -> where('id','=','2') -> first();
      $jiaoyu = DB::table('hkyl_cate') -> where('pid','=','3') -> orderBy('id') -> first();
      $yangsheng = DB::table('hkyl_cate') -> where('pid','=','4') -> orderBy('id') -> first();
      $qiye = DB::table('hkyl_cate') -> where('pid','=','8') -> orderBy('id') -> first();
      $huiyi = DB::table('hkyl_cate') -> where('pid','=','11') -> orderBy('id') -> first();
      $xuanzhe = 1;
      $id = session('user') -> id;
      $bl = DB::table('hkyl_disease As c1') 
      ->  LeftJoin('hkyl_cases As c2','c1.cid','=','c2.id')
      ->  select('c1.*','c2.cname')
      -> where('c1.uid',$id)  
      -> orderBy('id')  
      -> paginate(10);

      return view('home.ill.cases',['set' => $set,'bl'=>$bl,'qiye'=>$qiye,'huiyi'=>$huiyi,'yangsheng'=>$yangsheng,'expert' => $expert,'jiaoyu'=>$jiaoyu,'train' => $train,'ys' => $ys,'hickey'=>$hickey,'procure'=>$procure,'goods'=>$goods,'health'=>$health,'xuanzhe' => $xuanzhe]);

    }
    //病例添加
    public function caseadd()
    {
      $keshi = DB::table('hkyl_keshi') -> orderby('id') -> get();
      return view('home.ill.caseadd',['keshi' => $keshi]);
    }
    //病例查看
     public function casexq(Request $request)
    {
      $id = $request -> id; 
      $case = DB::table('hkyl_disease') -> where('id',$id) -> first();
      $user = DB::table('hkyl_cases') -> where('id',$case-> cid) ->first();
      $keshi = DB::table('hkyl_keshi') -> where('id',$case->type) -> first();
      return view('home.ill.casexq',['user' => $user,'case'=>$case,'keshi'=>$keshi]);
    }
     //病例删除
    public function casedel(Request $request)
    {
      $id = $request -> id;
      $rw = DB::table('hkyl_disease') -> where('id',$id) -> first();
      $res = DB::table('hkyl_disease') -> delete($id);
      $num = DB::table('hkyl_cases') -> where('id',$rw -> cid) -> first();
      $bl = $num -> num;
      $bln['num'] = $bl - 1;
      $blunm = DB::table('hkyl_cases') -> where('id',$rw -> cid) -> update($bln);
      if($res)
      {
        return response()->json(['status'=> 1 ,'msg'=>'删除成功']);
      }else{
        return response()->json(['status'=> 0 ,'msg'=>'删除失败']);
      }
    }
    //病例修改
    public function caseedit($id)
    {
      
      $bl = DB::table('hkyl_disease') -> where('id',$id) ->first();
      $keshi = DB::table('hkyl_keshi') -> get();
      
      if(!empty($bl -> baogaoimg))
      {
        $bl -> baogaoimg = unserialize($bl -> baogaoimg);
      }
      if(!empty($bl->meteimg))
      {
        $bl -> meteimg = unserialize($bl->meteimg);
       
      }
      if(!empty($bl-> emrimg))
      {
        $bl -> emrimg = unserialize($bl->emrimg);
        
      }
     
      return view('home.ill.caseedit',['bl' => $bl,'keshi'=>$keshi,]);
    }
    //人物选择
    public function select()
    {
      $id = session('user') -> id;
      $man = DB::table('hkyl_cases') -> where('uid',$id) -> get();
      return view('home.ill.select',['man' => $man]);
    }
    //病例协议
    public function xieyi()
    {
      return view('home.ill.xieyi');
    }
    //人物添加执行
    public function insert(Request $request)
    {

      $data = $request -> except('_token');

      $id = session('user') -> id;
      
      $data['uid'] =$id;
      
      $pd = DB::table('hkyl_cases') 
      -> where('uid',$id)
      -> where('cname',$data['cname']) 
      -> first();
      if($pd)
      {
        return redirect('/ill/man')->with(['pd'=>'人物已存在']);
      }
      $res = DB::table('hkyl_cases') -> insert($data);
      if($res)
      {
        return redirect('/ill/man')->with(['illadd'=>'人物添加成功']);
      }
    }
    //人物执行修改
    public  function update(Request $request)
    {
      $id = $request -> id;
      $data = $request -> except('_token','id');
      $uid = session('user') -> id;
      $data['uid'] = $uid;


      $res = DB::table('hkyl_cases') -> where('id',$id) -> update($data);
      if($res)
      {
        return redirect('/ill/man')->with(['illedit'=>'人物信息修改成功']);
      }
    }
    //病例执行添加
    public function caseinsert(Request $request)
    {
       $data = $request -> except('_token','xieyi','xieyiFlag','cname','cbir','csex','state','nation','job','province','city','county','caddress','intime');
       $user = $request -> only('cname','cbir','csex','state','nation','job','province','city','county','caddress','intime','cid');
      

        $name = $user['cname'];
       $id = session('user') -> id;
       $userid = $id;
      if(empty($user['cid']))
      {
        $namepd = DB::table('hkyl_cases') -> where('cname',$name) -> where('uid',$id) -> first();
        if($namepd)
        {
          return redirect('/ill/cases')->with(['namepd'=>'人物已存在']);
        }else{
          unset($user['cid']);
          unset($data['cid']);
          $user['uid'] = $id;
          $tj = DB::table('hkyl_cases') ->insert($user);
          $newid = DB::table('hkyl_cases') -> where('uid',$id) -> where('cname',$user['cname']) ->first();
        }
      }else{
        $namepd = DB::table('hkyl_cases') -> where('cname',$name) -> where('uid',$id) -> first();
        if(!$namepd){
          if($user['cid'])
          {
          unset($data['cid']);
          unset($user['cid']);
          }
          $user['uid'] = $id;
        $tj = DB::table('hkyl_cases') ->insert($user);
        $newid = DB::table('hkyl_cases') -> where('uid',$id) -> where('cname',$user['cname']) ->first();
        }else{
          $newid = DB::table('hkyl_cases') -> where('uid',$id) -> where('cname',$user['cname']) ->first();
        }
      }
      $nid = $newid -> id;
      
      $data['cid'] = $newid -> id;
      $data['uid'] = $id;

      if(!empty($data['baogaoimg']))
      {
        $data['baogaoimg'] = serialize($data['baogaoimg']);
      }
      if(!empty($data['pingdingimg']))
      {
        $data['meteimg'] = serialize($data['pingdingimg']);
        unset($data['pingdingimg']);
      }
      if(!empty($data['bingliimg']))
      {
        $data['emrimg'] = serialize($data['bingliimg']);
        unset($data['bingliimg']);
      }
      $data['addtime'] = time();
      $bnum = DB::table('hkyl_cases') -> where('id',$nid) -> first();
      
      $bl = $bnum -> num;
      $id =  DB::table('hkyl_disease') -> insertGetId($data);
      $b['num'] = $bl + 1;
      $num = DB::table('hkyl_cases')  -> where('id',$nid) -> update($b);
      $bz = DB::table('hkyl_disease') -> where('id',$id) -> first();
      $city = DB::table('hkyl_cases') -> where('id',$bz->cid) -> value('province');
      $ys = DB::table('hkyl_user') -> where('keshi','like','%'.$bz->type.'%') -> where('utp','2') -> where('province',$city) -> get();
      foreach($ys as $ys)
      {
        $ts['zjid'] = $ys -> id;
        $ts['bid'] = $id;
        $tuisong = DB::table('hkyl_tuisong') -> insert($ts);
      }
      $add['uid'] = $userid;
      $add['operateid'] = 7;
      $add['operatetime'] = time();
      $add['addup'] = 300;
      $addup = DB::table('hkyl_addupxq') -> insert($add);
      $jf = DB::table('hkyl_user') -> where('id',$userid) -> value('jfnum');
      $xgjf['jfnum'] = $jf +300;
      $xg = DB::table('hkyl_user') -> where('id',$userid) -> update($xgjf);
      if($tuisong)
      {    
        return redirect('/ill/cases')->with(['bltj'=>'病例添加成功']);
      }
    }
    //执行病历修改
    public  function caseupdate(Request $request)
    {
      $id = $request -> id;
      $data = $request -> except('_token','xieyi','xieyiFlag');
      $bl = DB::table('hkyl_disease') -> where('id',$id)  -> first();
      if(!empty($bl ->baogaoimg))
      {
        $bl -> baogaoimg = unserialize($bl -> baogaoimg);
        
        foreach($bl -> baogaoimg as $baogaoimg)
        {
          if(!empty($data['baogaoimg'])){
          if(!in_array($baogaoimg, $data['baogaoimg']))
          {
            $oldimg= './updates/'.$baogaoimg;
            if(file_exists($oldimg))
                { 
                    unlink($oldimg);
                }
          }
        }else{
          $oldimg= './updates/'.$baogaoimg;
            if(file_exists($oldimg))
                { 
                    unlink($oldimg);
                }
        }
        }
      }
      
      if(!empty($bl -> meteimg))
      {
        $bl -> meteimg = unserialize($bl -> meteimg);
        
        foreach($bl -> meteimg as $meteimg)
        {
          if(!empty($data['pingdingimg']))
          {
            if(!in_array($meteimg, $data['pingdingimg']))
            {
              
              $oldimg= './updates/'.$meteimg;
              if(file_exists($oldimg))
                  { 
                      unlink($oldimg);
                  }
            }
          }else{
              $oldimg= './updates/'.$meteimg;
              if(file_exists($oldimg))
                  { 
                      unlink($oldimg);
                  }
          }
        }
      }
      
      if(!empty($bl -> emrimg))
      {
        $bl -> emrimg = unserialize($bl -> emrimg);
        
        foreach($bl -> emrimg as $emrimg)
        {
          if(!empty($data['bingliimg']))
          {
             if(!in_array($emrimg, $data['bingliimg']))
            {
            $oldimg= './updates/'.$emrimg;
            if(file_exists($oldimg))
                { 
                    unlink($oldimg);
                }
            }
          }else{
            $oldimg= './updates/'.$emrimg;
            if(file_exists($oldimg))
                { 
                    unlink($oldimg);
                }
          }    
        }
      }
      if(!empty($data['baogaoimg']))
      {
        $bgimg = $data['baogaoimg'];
        $data['baogaoimg'] = serialize($bgimg);
      }else{
        $data['baogaoimg'] = null;
      }
      if(!empty($data['pingdingimg']))
      {
        $pdimg = $data['pingdingimg'];
        $data['meteimg'] = serialize($pdimg);
        unset($data['pingdingimg']);
      }else{
        $data['meteimg'] = null;
      }
      if(!empty($data['bingliimg']))
      {
        $blimg = $data['bingliimg'];
        $data['emrimg'] = serialize($blimg);
        unset($data['bingliimg']);
      }else{
        $data['emrimg'] = null;
      }
      $res = DB::table('hkyl_disease') -> where('id',$id) -> update($data);
      if($res)
      {
        return redirect('/ill/cases')->with(['caseedit'=>'病例信息修改成功']);
      }
    }
    //图片上传
    public function img(Request $request)
    {
      
      if ($request->hasFile('file')){
        if ($request-> file('file')->isValid()){

          $oldpath = $request -> file('file') -> getClientOriginalExtension();
          $filename = time().mt_rand(100000,999999);
          $request -> file('file') -> move('./updates',$filename.'.'.$oldpath);
          
          }
                $baogaoimg = $filename.'.'.$oldpath;
               
                $url = "/updates/".$baogaoimg;
      }
      if ($request->hasFile('file1')){
        if ($request-> file('file1')->isValid()){

          $oldpath = $request -> file('file1') -> getClientOriginalExtension();
          $filename = time().mt_rand(100000,999999);
          $request -> file('file1') -> move('./updates',$filename.'.'.$oldpath);
          
          }
                $baogaoimg = $filename.'.'.$oldpath;
               
                $url = "/updates/".$baogaoimg;
      }
      if ($request->hasFile('file2')){
        if ($request-> file('file2')->isValid()){

          $oldpath = $request -> file('file2') -> getClientOriginalExtension();
          $filename = time().mt_rand(100000,999999);
          $request -> file('file2') -> move('./updates',$filename.'.'.$oldpath);
          
          }
                $baogaoimg = $filename.'.'.$oldpath;
               
                $url = "/updates/".$baogaoimg;
      }
      return response()->json(['url' => $url,'baogaoimg' => $baogaoimg]);
      
    }
    //图片删除
    public function deleteimg(Request $request)
    {

      $img = $request -> url;
      $oldimg= './updates/'.$img;
       
       if(file_exists($oldimg))
                { 
                   
                    unlink($oldimg);
                }
                
      return response()->json(['url'=> 1]);  
            
    }
    

}
    


