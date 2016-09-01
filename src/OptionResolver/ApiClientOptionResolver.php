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
 * Class ApiClientOptionResolver
 * @package Fnayou\Zeppelin\OptionResolver
 */
class ApiClientOptionResolver
{
    /**
     * @param array $values
     * @return array
     */
    public function resolve(array $values)
    {
        /** @var \Symfony\Component\OptionsResolver\OptionsResolver $rootResolver */
        $rootResolver = $this->rootResolver();
        /** @var \Symfony\Component\OptionsResolver\OptionsResolver $clientResolver */
        $clientResolver = $this->clientResolver();
        /** @var \Symfony\Component\OptionsResolver\OptionsResolver $defaultsResolver */
        $defaultsResolver = $this->defaultsResolver();
        /** @var \Symfony\Component\OptionsResolver\OptionsResolver $headersResolver */
        $headersResolver = $this->headersResolver();

        $values = $rootResolver->resolve($values);
        $values['client'] = $clientResolver->resolve($values['client']);
        $values['client']['defaults'] = $defaultsResolver->resolve($values['client']['defaults']);
        $values['client']['defaults']['headers'] = $headersResolver->resolve($values['client']['defaults']['headers']);

        return $values;
    }

    /**
     * @return OptionsResolver
     */
    protected function rootResolver()
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired('client');
        $resolver->setRequired('description_file_path');
        $resolver->setAllowedTypes('client', ['array']);
        $resolver->setAllowedTypes('description_file_path', ['string']);

        return $resolver;
    }

    /**
     * @return OptionsResolver
     */
    protected function clientResolver()
    {
        $resolver = new OptionsResolver();
        $resolver->setRequired('base_url');
        $resolver->setRequired('version');
        $resolver->setRequired('defaults');
        $resolver->setAllowedTypes('base_url', ['string']);
        $resolver->setAllowedTypes('version', ['string', 'int']);
        $resolver->setAllowedTypes('defaults', ['array']);

        return $resolver;
    }

    /**
     * @return OptionsResolver
     */
    protected function defaultsResolver()
    {
        $resolver = new OptionsResolver();
        $resolver->setDefault('timeout', 10);
        $resolver->setDefault('allow_redirects', false);
        $resolver->setDefault('headers', []);
        $resolver->setAllowedTypes('timeout', ['int']);
        $resolver->setAllowedTypes('allow_redirects', ['boolean', 'int']);
        $resolver->setAllowedTypes('headers', ['array']);
        $resolver->setAllowedValues('allow_redirects', [false, true, 0, 1]);

        return $resolver;
    }

    /**
     * @return OptionsResolver
     */
    protected function headersResolver()
    {
        $resolver = new OptionsResolver();
        $resolver->setDefault('user_agent', 'api-sdk-php/1.0');
        $resolver->setDefault('content_type', 'application/json; charset=utf-8');
        $resolver->setAllowedTypes('user_agent', ['string']);
        $resolver->setAllowedTypes('content_type', ['string']);

        return $resolver;
    }
}
