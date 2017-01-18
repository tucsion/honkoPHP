<?php

return [

    // 默认支付网关
    'default' => 'alipay',

    // 各个支付网关配置
    'gateways' => [
        'paypal' => [
            'driver' => 'PayPal_Express',
            'options' => [
                'solutionType' => '',
                'landingPage' => '',
                'headerImageUrl' => ''
            ]
        ],

        'alipay' => [
            'driver' => 'Alipay_Express',
            'options' => [
                'partner' => '2088521262395094',
                'key' => 't8fardo8hsvvovhl8nwvdc3bc5u4xy08',
                'sellerEmail' =>'topdang@topdang.com',
                'returnUrl' => 'your returnUrl here',
                'notifyUrl' => 'your notifyUrl here'
            ]
        ]
    ]

];