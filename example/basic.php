<?php

use GzHejiehui\XboxDealApi\ClientBuilder;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;

require_once __DIR__ . '/../vendor/autoload.php';

$clientBuilder = new ClientBuilder();
$clientBuilder->addPlugins(
    new HeaderDefaultsPlugin([
        'Accept' => 'application/json',
    ])
);

$options = new \GzHejiehui\XboxDealApi\Options([
    'client_builder' => $clientBuilder,
]);

$sdk = new \GzHejiehui\XboxDealApi\Sdk($options);
print_r($sdk->channel('TopFree')->language('zh-HK')->skipItems(116)->get());
