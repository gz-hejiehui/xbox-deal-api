<?php

use GzHejiehui\XboxDealApi\ClientBuilder;
use GzHejiehui\XboxDealApi\Options;
use GzHejiehui\XboxDealApi\Sdk;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;

require_once __DIR__ . '/../vendor/autoload.php';

// Customize the http client
$clientBuilder = new ClientBuilder();
$clientBuilder->addPlugins(
    new HeaderDefaultsPlugin([
        'Accept' => 'application/json',
    ])
);

// Create the SDK instance
$sdk = new Sdk(new Options([
    'client_builder' => $clientBuilder,
]));

// Get items of the channel
try {
    $data = $sdk->channel()->name('TopFree')->language('zh-HK')->skipItems(10)->get();
    foreach ($data['Items'] as $item) {
        // TODO: Do something with the item
        continue;
    }
} catch (\Http\Client\Exception $e) {
    echo $e->getMessage();
}

// Get information of the products
try {
    $data = $sdk->product()->bigIds('C48ZFTBQ17Q3', '9NQQ8B4PJR25')->get();
    foreach ($data['Products'] as $item) {
        // TODO: Do something with the item
        continue;
    }
} catch (\Http\Client\Exception $e) {
    echo $e->getMessage();
}
