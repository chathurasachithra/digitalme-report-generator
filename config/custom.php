<?php

//custom created config variables

return [

    //email 
    'fromEmail' => "dataanalyzer@gmail.com",
    // 'contactUsSendCopyEmail' => 'dazimax@gmail.com'
    'contactUsAdminEmail' => 'damith.thamara@gmail.com',

    'report_types' => [
        'person' => 1,
        'company' => 2,
        'organization' => 3,
        'government' => 4
    ],

    'report_types_routes' => [
        1 => 'person',
        2 => 'companies',
        3 => 'organization',
        4 => 'government'
    ],

    'default_report_price' => 100,

    'default_record_price' => 1

];
