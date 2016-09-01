<?php

/*
 * This file is part of the fnayou/zeppelin package.
 *
 * (c) Aymen FNAYOU <fnayou.aymen@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Fnayou\Zeppelin\OptionResolver;

/**
 * Interface OptionResolverInterface
 * @package Fnayou\Zeppelin\OptionResolver
 */
interface OptionResolverInterface
{
    /**
     * @param array $values
     * @return mixed
     */
    public function resolve(array $values);
}
