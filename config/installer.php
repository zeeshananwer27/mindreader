<?php

use App\Enums\StatusEnum;

return [

    'app_name'    => "BeePost",
    'software_id' => "KODE1001BEE",

    'cacheFile'   => 'YmVlcG9zdA==',

    'core' => [
        'appVersion' => '1.1',
        'minPhpVersion' => '8.2'
    ],

    'requirements' => [

        'php' => [
            'Core',
            'bcmath',
            'openssl',
            'pdo_mysql',
            'mbstring',
            'tokenizer',
            'json',
            'curl',
            'gd',
            'zip',
            'mbstring',
        

        ],
        'apache' => [
            'mod_rewrite',
        ],

    ],
    'permissions' => [
        '.env'     => '666',
        'storage'     => '775',
        'bootstrap/cache/'       => '775', 
    ],
    
];