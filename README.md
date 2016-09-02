# Zeppelin

Simple [Guzzle][guzzle-link] configurator using **client configuration** and **api descriptions** files.
  1. All you have to do is to create two files :
      - the Guzzle client configuration (api url, version, user agent, etc.)
      - the API description structure
  2. use `ZeppelinFactory` factory or create your own
  3. consume APIs

Zeppelin aim to let you focus on your main project by providing a simple and easy way to consume api and web services.

## Install

you can install zeppelin using composer

``` bash
$ composer require fnayou/zeppelin
```

## Usage

  - create your Guzzle client configuration file based on the [configuration sample file][configuration-sample-link]
  - create your API description file based on the [api description sample file][api-description-sample-link]
  - use the `ZeppelinFactory` factory with your favorite `Loader` (more loaders will be released soon)

``` php
<?php

use Fnayou\Zeppelin\Factory\ZeppelinFactory;
use Fnayou\Zeppelin\Loader\YamlLoader;

$yamlLoader = YamlLoader();
$configurationFilePath = '/path/to/api_configuration.yml';
$customGuzzleConfiguration = [];

$client = ZeppelinFactory::build($yamlLoader, $configurationFilePath, $customGuzzleConfiguration);
```

  - consume your APIs

``` php
<?php

// you can access api as method (according to the api description file)
try {
    $response = $client->user([
        'X-APPID' => '26041986',
        'user_id' => 26,
    ]);
} catch (\GuzzleHttp\Exception\RequestException $e) {
    $response = json_decode($e->getResponse()->getBody()->getContents());
}

dump($response);
```

  - you can also create you own `factory` with your own logic, all you have to do is implement `FactoryInterface`

``` php
<?php

namespace Vendor\App\Factory;

use Fnayou\Zeppelin\ApiClient;
use Fnayou\Zeppelin\Api\ApiDescription;
use Fnayou\Zeppelin\Factory\FactoryInterface;
use Fnayou\Zeppelin\Loader\LoaderInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\GuzzleClient;

class CustomFactory implements FactoryInterface
{
    public static function build(LoaderInterface $loader, $filePath, array $config)
    {
        // load the guzzle configuration file
        $apiClientConfiguration = new ApiClient($loader, $filePath);

        // load the api description file 
        $apiDescription = new ApiDescription(
            $loader,
            $apiClientConfiguration->getDescriptionFilePath()
        );

        $client = new Client($apiClientConfiguration->getClientConfiguration());

        // your guzzle instance using api description, and custom configuration 
        $zeppelin = new GuzzleClient(
            $client,
            $apiDescription->getDescription(),
            $config
        );

        return $zeppelin;
    }
}
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Credits

- [Aymen FNAYOU][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://gitlab.com/fnayou
[configuration-sample-link]: https://gitlab.com/fnayou/zeppelin/blob/master/src/Resources/api_configuration.yml.dist
[api-description-sample-link]: https://gitlab.com/fnayou/zeppelin/blob/master/src/Resources/api_description.yml.dist
[guzzle-link]: https://github.com/guzzle/guzzle
