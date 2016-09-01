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

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ApiDescriptionOptionResolver
 * @package Fnayou\Zeppelin\OptionResolver
 */
class ApiDescriptionOptionResolver implements OptionResolverInterface
{
    /**
     * @param array $values
     * @return array
     */
    public function resolve(array $values)
    {
        /** @var \Symfony\Component\OptionsResolver\OptionsResolver $rootResolver */
        $rootResolver = $this->rootResolver();
        /** @var \Symfony\Component\OptionsResolver\OptionsResolver $rootResolver */
        $apiResolver = $this->apiResolver();

        $values = $rootResolver->resolve($values);

        foreach ($values['operations'] as $operation => $api) {
            $values['operations'][$operation] = $apiResolver->resolve($api);
        }

        return $values;
    }

    /**
     * @return OptionsResolver
     */
    protected function rootResolver()
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired('operations');
        $resolver->setDefined('models');
        $resolver->setAllowedTypes('operations', ['array']);

        return $resolver;
    }

    /**
     * @return OptionsResolver
     */
    protected function apiResolver()
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired('httpMethod');
        $resolver->setRequired('uri');
        $resolver->setRequired('parameters');
        $resolver->setDefined('responseModel');
        $resolver->setAllowedTypes('httpMethod', ['string']);
        $resolver->setAllowedTypes('uri', ['string']);
        $resolver->setAllowedTypes('parameters', ['array']);

        return $resolver;
    }
}
