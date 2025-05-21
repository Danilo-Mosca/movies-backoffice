<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],     // Accesso alle API consentito a tutti

    // 'allowed_origins' => ['http://localhost:5174'], OPPURE USANDO LE VARIABILI D'AMBIENTE:
    //'allowed_origins' => [env('APP_FRONTEND_URL', 'http://localhost:5174')],          // il primo valore fa riferimento al contenuto della variabile d'ambiente nel file ".env"
    // il secondo valore invece è un valore di default che sarà utilizzato nel caso in cui la chiave richiesta non è stata trovata nel file .env
    // Avrei potuto scrivere anche: 'allowed_origins' => ['*'], per consentire l'accesso a tutti i domini
    // oppure 'allowed_origins' => ['https://tuo-dominio.com'], per consentire l'accesso al solo dominio https://tuo-dominio.com

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];
