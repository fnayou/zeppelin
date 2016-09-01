<?php

/*
 * This file is part of the fnayou/zeppelin package.
 *
 * (c) Aymen FNAYOU <fnayou.aymen@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Fnayou\Zeppelin\Loader;

/**
 * Interface LoaderInterface
 * @package Fnayou\Zeppelin\Loader
 */
interface LoaderInterface
{
    /**
     * @param string $filePath
     * @return array
     */
    public function load($filePath);
}
