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

use Fnayou\Zeppelin\Loader\LoaderInterface;

/**
 * Class AbstractApiFile
 * @package Fnayou\Zeppelin\Api
 */
abstract class AbstractApiFile
{
    /** @var \Fnayou\Zeppelin\Loader\LoaderInterface */
    protected $loader;

    /** @var string */
    protected $filePath;

    /** @var array */
    private $parameters = [];

    /**
     * AbstractApi constructor.
     * @param \Fnayou\Zeppelin\Loader\LoaderInterface $loader
     * @param string                                  $filePath
     */
    public function __construct(LoaderInterface $loader, $filePath)
    {
        $this->loader = $loader;
        $this->filePath = $filePath;
    }

    /**
     * @return string
     */
    protected function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @param string $filePath
     */
    protected function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * @return array
     */
    protected function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param array $parameters
     */
    protected function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }
}
