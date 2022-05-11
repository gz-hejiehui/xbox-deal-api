<h1 align="center"> xbox-deal-api </h1>

<p align="center"> An SDK that can help you get the Xbox product information.</p>

<p align="center">
<a href="https://packagist.org/packages/gz-hejiehui/xbox-deal-api"><img src="https://poser.pugx.org/gz-hejiehui/xbox-deal-api/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/gz-hejiehui/xbox-deal-api"><img src="https://poser.pugx.org/gz-hejiehui/xbox-deal-api/v/unstable.svg" alt="Latest Unstable Version"></a>
<a href="https://packagist.org/packages/gz-hejiehui/xbox-deal-api"><img src="https://poser.pugx.org/gz-hejiehui/xbox-deal-api/downloads" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/gz-hejiehui/xbox-deal-api"><img src="https://poser.pugx.org/gz-hejiehui/xbox-deal-api/license" alt="License"></a>
</p>

## Getting Started

### Requirements

- PHP 7.4 or later
- PHP json extension

### Installation

This package is available on [Packagist](https://packagist.org/packages/gz-hejiehui/xbox-deal-api) and is best installed
using [Composer](http://getcomposer.org/).

```shell
composer require gz-hejiehui/xbox-deal-api -vvv
```

You will also need to install two dependencies:

1. A [PSR-17](https://www.php-fig.org/psr/psr-17/) compatible HTTP factory implementation.
2. A [PSR-18](https://www.php-fig.org/psr/psr-18/) compatible HTTP client implementation.

You can go through the lists of implementations on Packagist and choose one that suits your project:

- [List of PSR-17-compatible implementations](https://packagist.org/packages/php-http/http-message-implementations)
- [List of PSR-18-compatible implementations](https://packagist.org/packages/php-http/http-client-implementations)

If you don't know which one to choose, try theses:

```shell
composer require "http-interop/http-factory-guzzle:^1.0" 
composer require "php-http/guzzle6-adapter:^2.0 || ^1.0"
```

## Usage

All APIs can be accessed through the `\Gzhejiehui\XboxDealApi\XboxDealApi` object. To construct this object, you need to
pass a PSR-18 compatible HTTP client and a PSR-17 compatible HTTP request factory to the constructor:

```php
use Gzhejiehui\XboxDealApi\XboxDealApi;

$xda = new XboxDealApi($httpClient, httpRequestFactory);
```

> Note: From now on, we will refer to the instance of `Gzhejiehui\XboxDealApi\XboxDealApi` as `$xda`.

### Example

```php
<?php

use GzHejiehui\XboxDealApi\Exception\Exception as XDAException;
use GzHejiehui\XboxDealApi\XboxDealApi;
use Http\Factory\Guzzle\RequestFactory;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

// If you are not using PHP Frameworks that has included Composer autoloader, 
// you need to manually load the autoloader before using the SDK.
require_once __DIR__ . '/../vendor/autoload.php';

// If you installed the recommended PSR-18 and PSR-17 implementations, 
// here's show how to create the necessary objects.
$httpRequestFactory = new RequestFactory();
$httpClient = GuzzleAdapter::createWithConfig([]);

// Create the API instance.
$xda = new XboxDealApi($httpClient, $httpRequestFactory);

// Fetch data from the API or deal exceptions if something went wrong.
try {
    $data = $xda->channelEndpoint()->channel('TopFree')->fetch();
} catch (XDAException $e) {
    echo 'OpenWeatherMap exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
} catch (Throwable $e) {
    echo 'General exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
}

print_r($data);
```

## APIs

### Channel Item List

This API is used to fetch the list of items for a given collection name.

You can use the following chaining methods to filter the items:

| Method | Type | Default | Description |
| ------ | ----------- | ----------- | ----------- |
| `channel()` | string | `TopFree` | The collection name. |
| `itemType()` | string | `Game` | The item type. |
| `language()` | string | `en-US` | The response content's language. |
| `market()` | string | `US` | The market where the items are sold. |
| `count()` | int | `200` | The number of items to fetch. |
| `skipItems()` | int | `0` | The number of items to skip. |

#### Example

```php
$data = $xda->channelEndpoint()->channel('TopFree')->itemType('Game')->fetch();
print_r($data);
```

### Product Detail

This API is used to fetch the detail of a given products.

You can use the following chaining methods to filter the items:

| Method | Type | Default | Description |
| ------ | ----------- | ----------- | ----------- |
| `bigIds()` | ...string | `C48ZFTBQ17Q3` | The product IDs. |
| `market()` | string | `US` | The market where the products are sold. |
| `language()` | string | `en-US` | The response content's language. |

#### Example

```php
$data = $xda->productDetailEndpoint()->bigIds('C48ZFTBQ17Q3', '9NQQ8B4PJR25')->language('zh-HK')->fetch();
print_r($data);
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/gz-hejiehui/xbox-deal-api/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/gz-hejiehui/xbox-deal-api/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and
PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
