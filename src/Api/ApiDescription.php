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

use Fnayou\Zeppelin\OptionResolver\ApiDescriptionOptionResolver;
use Fnayou\Zeppelin\Loader\LoaderInterface;
use GuzzleHttp\Command\Guzzle\Description;

/**
 * Class ApiDescription
 * @package Fnayou\Zeppelin\Api
 */
class ApiDescription extends AbstractApiFile
{
    /**
     * ApiDescription constructor.
     * @param \Fnayou\Zeppelin\Loader\LoaderInterface $loader
     * @param string                                  $filePath
     */
    public function __construct(LoaderInterface $loader, $filePath)
    {
        parent::__construct($loader, $filePath);

        $descriptionOptionResolver = new ApiDescriptionOptionResolver();
        $parameters = $descriptionOptionResolver->resolve($this->loader->load($this->getFilePath()));

        $this->setParameters($parameters);
    }
    /**
     * @return \GuzzleHttp\Command\Guzzle\Description
     */
    public function getDescription()
    {
        return new Description($this->getParameters());
    }
}
