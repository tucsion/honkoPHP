<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        '/home/user/img',
        '/ill/detail',
        '/ill/edit',
        'ill/delete',
        'ill/casedel',
        'ill/caseedit',
        'ill/img',
        '/ill/deleteimg',
        '/home/user/snat',
        '/home/user/updateadd',
        'alipay/re',
        '/ill/casexq',
        '/order/delete',
        '/order/deleteser',
        '/fav/deletezj',
        '/fav/deletegoods',
        '/fav/deletewz',
        '/goodscar/bill',
        '/message/xitongxq',
        '/message/dealxq',
        '/message/deleteword',
        '/message/deletedeal',
        '/message/mywordxq',
        '/home/tuisong/delete',
         '/home/tuisong/deletegz',
        '/home/tuisong/follow',
        '/assets/delete',
        '/purch/delete',
        '/purch/del',
        '/purch/qysc',
        '/purch/deletegoods'
        
        
    ];
}
