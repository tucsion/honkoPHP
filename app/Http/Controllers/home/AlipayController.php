<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


class AlipayController extends Controller
{
    public function pay($id){
    $dd = DB::table('hkyl_myserve') -> where('id',$id) -> first();
    if($dd -> type == 1)
    {
    
    $alipay = app('alipay.web');
    $alipay->setOutTradeNo($dd -> servenum);
    $alipay->setTotalFee('0.01');
    $alipay->setSubject('鸿康医疗服务'.$dd -> servenum);
    $alipay->setBody('鸿康医疗服务'.$dd -> servenum);

    $alipay->setQrPayMode(''); //该设置为可选，添加该参数设置，支持二维码支付。
    }
    if($dd -> type == 0)
    {
    
    $alipay = app('alipay.web');
    $alipay->setOutTradeNo($dd -> servenum);
    $alipay->setTotalFee('0.01');
    $alipay->setSubject('鸿康医疗咨询服务'.$dd -> servenum);
    $alipay->setBody('鸿康医疗咨询服务'.$dd -> servenum);

    $alipay->setQrPayMode(''); //该设置为可选，添加该参数设置，支持二维码支付
    }
    

    // 跳转到支付页面。
    return redirect()->to($alipay->getPayLink());
    }
    public function goodspay($id)
    {
        $good = DB::table('hkyl_myorder') -> where('id',$id) -> first();
        $xq = DB::table('hkyl_orderxq As c1') 
          -> leftJoin('hkyl_goods As c2','c2.id','=','c1.gid')
          -> select('c1.*','c2.gname')
          -> where('c1.unumber',$good -> onumber) 
          -> get();
     
         foreach($xq as $goodxq)
         {
          $gname[] = $goodxq -> gname;  
         }
            $xqname = implode(',',$gname);
          

        $alipay = app('alipay.web');
        $alipay->setOutTradeNo($good -> onumber);
        $alipay->setTotalFee('0.01');
        $alipay->setSubject($xqname);
        $alipay->setBody('鸿康医疗服务'.$good -> onumber);


    $alipay->setQrPayMode(''); //该设置为可选，添加该参数设置，支持二维码支付。

    // 跳转到支付页面。
    return redirect()->to($alipay->getPayLink());
    }

     public function webNotify()
    
    {
        // 验证请求。
        if (! app('alipay.web')->verify()) {
            Log::notice('Alipay notify post data verification fail.', [
                'data' => Request::instance()->getContent()
            ]);
            return 'fail';
        }

        // 判断通知类型。
        switch (Input::get('trade_status')) {
            case 'TRADE_SUCCESS':
            case 'TRADE_FINISHED':
                // TODO: 支付成功，取得订单号进行其它相关操作。
                Log::debug('Alipay notify post data verification success.', [
                    'out_trade_no' => Input::get('out_trade_no'),
                    'trade_no' => Input::get('trade_no')
                ]);
                break;
        }

        return view('/alipay/return');
    }
    public function re()
    {
       
       $pd = $_GET['is_success'];
       $num = $_GET['out_trade_no'];
       $first = substr( $num, 0, 1 );
        if($pd == 'T')
        {
            if($first == 'G')
            {
                $uid = session('user') -> id;
                $ojf = DB::table('hkyl_user') -> where('id',$uid) -> value('jfnum');
                $usejf = DB::table('hkyl_myorder') -> where('onumber',$num) -> value('usejf');
                $jfxg['jfnum'] = $ojf + 300 - $usejf;
                $jf = DB::table('hkyl_user') -> where('id',$uid) -> update($jfxg);
                $add['uid'] = $uid;
                $add['operateid'] = 1;
                $add['operatetime'] = time();
                $add['addup'] = 300;
                $xgadd = DB::table('hkyl_addupxq') -> insert($add);
               $ordernum = $num;
               $order = DB::table('hkyl_myorder') -> where('onumber',$ordernum) -> first();
               $emittime = $_GET['notify_time'];
               $buyer = $_GET['buyer_email'];
               $data['state'] = 1;
               $data['emittime'] = $emittime;
               $data['buyer'] = $buyer;
               $new['uid'] = $uid;
               $new['title'] = '已成功购买医疗产品';
               $new['orderid'] = $order -> id;
               $new['news'] = '您已于'.$emittime.'成功购买了医疗产品,总计花费,'.$order -> price.'元,积分使用共计'.$order->$usejf.'分';
               $new['newstime'] = time();
               $new['number'] = $ordernum;
               $mynews = DB::table('hkyl_mynews') -> insert($new);
               $res = DB::table('hkyl_myorder') -> where('onumber',$ordernum) -> update($data);
               if($res)
               {
                return redirect('/order/fanhui');
               }
            }
            if($first == 'X')
            {
            $uid = session('user') -> id;
            $emittime = $_GET['notify_time'];
            $buyer = $_GET['buyer_email'];
            $ojf = DB::table('hkyl_user') -> where('id',$uid) -> value('jfnum');
            $jfxg['jfnum'] = $ojf + 100;
            $jf = DB::table('hkyl_user') -> where('id',$uid) -> update($jfxg);
            $add['uid'] = $uid;
            $add['operateid'] = 3;
            $add['operatetime'] = time();
            $add['addup'] = 100;
            $xgadd = DB::table('hkyl_addupxq') -> insert($add);
            $servenum = $num;
            $order = DB::table('hkyl_myserve') -> where('servenum',$servenum) -> first();
            $xq = DB::table('hkyl_servexq') -> where('servenum',$servenum) -> first();
            $wzname = DB::table('hkyl_doctor') -> where('id',$xq -> gid) -> value('name');
            $zjid = DB::table('hkyl_doctor') -> where('id',$xq -> gid) -> value('uid');
            $zjname = DB::table('hkyl_user') -> where('id',$zjid) -> value('uname');
            $zjprice =  DB::table('hkyl_user') -> where('id',$zjid) -> value('price');
            $zjp['price']  = $zjprice + $order -> price;
            $xgp = DB::table('hkyl_user') -> where('id',$zjid) -> update($zjp);
            $income['zjid'] = $zjid;
            $income['type'] = 0;
            $income['uid'] = $uid ;
            $income['price'] = $order -> price;
            $income['servenum'] = $servenum;
            $income['time'] = time();
            $come = DB::table('hkyl_income') -> insert($income);
            $data['state'] = 1;
            $data['buyer'] = $buyer;
            $new['uid'] = $uid;
            $new['title'] = '已成功购买资料';
            $new['orderid'] = $order -> id;
            $new['news'] = '您已于'.$emittime.'成功购买了'.$zjname.'专家的文章资料,'.$wzname.',总计花费'.$order -> price.'元。';
            $new['newstime'] = time();
            $new['number'] = $servenum;
            $mynews = DB::table('hkyl_mynews') -> insert($new);
            $res = DB::table('hkyl_myserve') -> where('servenum',$servenum) -> update($data);
            $aa = DB::table('hkyl_servexq') -> where('servenum',$servenum) -> update($data);
                if($aa)
                {
                    return redirect('/xiazai/fanhui');
                }
            }
            if($first == 'Z')
            {
            $uid = session('user') -> id;
            $emittime = $_GET['notify_time'];
            $buyer = $_GET['buyer_email'];
            
            $ojf = DB::table('hkyl_user') -> where('id',$uid) -> value('jfnum');
            $jfxg['jfnum'] = $ojf + 100;
            $jf = DB::table('hkyl_user') -> where('id',$uid) -> update($jfxg);
            $add['uid'] = $uid;
                $add['operateid'] = 2;
                $add['operatetime'] = time();
                $add['addup'] = 100;
                $xgadd = DB::table('hkyl_addupxq') -> insert($add);
            $servenum = $num;
            $illid = DB::table('hkyl_servexq') -> where('servenum',$servenum) -> value('illid');
            $typeid =DB::table('hkyl_myserve') -> where('servenum',$servenum) -> value('servetype');
            $nzxnum = DB::table('hkyl_sertype') -> where('id',$typeid) -> value('tnumber');
            $order = DB::table('hkyl_myserve') -> where('servenum',$servenum) -> first();
            $zjid = DB::table('hkyl_servexq') -> where('servenum',$servenum) -> value('zjid');
            $zjnum = DB::table('hkyl_user') -> where('id',$zjid) -> value('jfnum');
            $zjprice =  DB::table('hkyl_user') -> where('id',$zjid) -> value('price');
            $zjp['price']  = $zjprice + $order -> price;
            $xgp = DB::table('hkyl_user') -> where('id',$zjid) -> update($zjp);
            $income['zjid'] = $zjid;
            $income['type'] = 1;
            $income['uid'] = $uid ;
            $income['price'] = $order -> price;
            $income['servenum'] = $servenum;
             $income['time'] = time();
            $come = DB::table('hkyl_income') -> insert($income);
            $zjjf['jfnum'] = $zjnum +300;
            $zjiajf = DB::table('hkyl_user') -> where('id',$zjid) -> update($zjjf);
            $zjname = DB::table('hkyl_user') -> where('id',$zjid) -> value('uname');
            $data['state'] = 1;
            $data['buyer'] = $buyer;
            $new['uid'] = $uid;
            $new['title'] = '已成功购买咨询服务';
            $new['orderid'] = $order -> id;
            $new['news'] = '您已于'.$emittime.'成功购买了'.$zjname.'专家的咨询服务'.$nzxnum.'条,总计花费'.$order -> price.'元。';
            $new['newstime'] = time();
            $new['number'] = $servenum;
            $mynews = DB::table('hkyl_mynews') -> insert($new);
            $res = DB::table('hkyl_myserve') -> where('servenum',$servenum) -> update($data);
            $aa = DB::table('hkyl_servexq') -> where('servenum',$servenum) -> update($data);
            $ozxnum = DB::table('hkyl_disease') -> where('id',$illid) -> value('zxnum');

           
            $zxxg['zxnum'] = $ozxnum + $nzxnum;
            $zxxg['zxid'] = $zjid;
            $xg = DB::table('hkyl_disease') -> where('id',$illid)  -> update($zxxg);
            if($xg)
            {
                 return redirect('/xiazai/fanhui');
            }
           
            }
        }
    }
}
    


