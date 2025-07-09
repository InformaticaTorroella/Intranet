<?php

return [
    'connections' => [
        'default' => [
            'hosts' => [env('LDAP_HOST', '192.168.5.6')],
            'username' => env('LDAP_USERNAME', 'cn=administrador,dc=torroella,dc=local'),
            'password' => env('LDAP_PASSWORD', 'Mont<Pla1596'),
            'base_dn' => env('LDAP_BASE_DN', 'dc=torroella,dc=local'),
            'port' => env('LDAP_PORT', 389),
            'timeout' => env('LDAP_TIMEOUT', 5),
            'use_ssl' => env('LDAP_USE_SSL', false),
            'use_tls' => env('LDAP_USE_TLS', false),
            
        ],
    ],
];
