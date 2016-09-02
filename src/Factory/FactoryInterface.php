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

use Fnayou\Zeppelin\Loader\LoaderInterface;

/**
 * Interface FactoryInterface
 * @package Fnayou\Zeppelin\Factory
 */
interface FactoryInterface
{
    /**
     * @param \Fnayou\Zeppelin\Loader\LoaderInterface $loader
     * @param string                                  $filePath
     * @param array                                   $config
     *
     * @return mixed
     */
    public static function build(LoaderInterface $loader, $filePath, array $config);
}
