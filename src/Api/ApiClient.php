<?php

/*
 * This file is part of the fnayou/zeppelin package.
 *
 * (c) Aymen FNAYOU <fnayou.aymen@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Fnayou\Zeppelin\Api;

use Fnayou\Zeppelin\OptionResolver\ApiClientOptionResolver;
use Fnayou\Zeppelin\Loader\LoaderInterface;

/**
 * Class ApiClientConfiguration
 * @package Fnayou\Zeppelin\Api
 */
class ApiClient extends AbstractApiFile
{
    /**
     * ApiClient constructor.
     * @param \Fnayou\Zeppelin\Loader\LoaderInterface $loader
     * @param string                                  $filePath
     */
    public function __construct(LoaderInterface $loader, $filePath)
    {
        parent::__construct($loader, $filePath);

        $clientOptionResolver = new ApiClientOptionResolver();
        $parameters = $clientOptionResolver->resolve($this->loader->load($this->getFilePath()));

        $this->setParameters($parameters);
    }

    /**
     * @return array
     */
    public function getClientConfiguration()
    {
        $parameters = $this->getParameters();

        return [
            'base_url' => [
                $parameters['client']['base_url'],
                ['version' => $parameters['client']['version']],
            ],
            'defaults' => [
                'timeout' => $parameters['client']['defaults']['timeout'],
                'allow_redirects' => $parameters['client']['defaults']['allow_redirects'],
                'headers' => [
                    'User-Agent' => $parameters['client']['defaults']['headers']['user_agent'],
                    'Content-type' => $parameters['client']['defaults']['headers']['content_type'],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function getDescriptionFilePath()
    {
        $parameters = $this->getParameters();

        return $parameters['description_file_path'];
    }

    /**
     * @return array
     */
    public function getConfiguration()
    {
        $parameters = $this->getParameters();

        return $parameters['client'];
    }
}
