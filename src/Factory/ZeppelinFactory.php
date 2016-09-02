<?php

/*
 * This file is part of the fnayou/zeppelin package.
 *
 * (c) Aymen FNAYOU <fnayou.aymen@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Fnayou\Zeppelin\Factory;

use Fnayou\Zeppelin\Api\ApiClient;
use Fnayou\Zeppelin\Api\ApiDescription;
use Fnayou\Zeppelin\Loader\LoaderInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\GuzzleClient;

/**
 * Class ZeppelinFactory
 * @package Fnayou\Zeppelin\Factory
 */
class ZeppelinFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public static function build(LoaderInterface $loader, $filePath, array $config)
    {
        $apiClientConfiguration = new ApiClient($loader, $filePath);

        $apiDescription = new ApiDescription(
            $loader,
            $apiClientConfiguration->getDescriptionFilePath()
        );

        $guzzleClient = new Client($apiClientConfiguration->getClientConfiguration());

        $zeppelin = new GuzzleClient(
            $guzzleClient,
            $apiDescription->getDescription(),
            $config
        );

        return $zeppelin;
    }
}
