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

use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Parser;

/**
 * Class YamlLoader
 * @package Fnayou\Zeppelin\Loader
 */
class YamlLoader implements LoaderInterface
{
    /**
     * {@inheritdoc}
     */
    public function load($filePath)
    {
        $fileSystem = new Filesystem();

        if (!$fileSystem->exists($filePath)) {
            throw new FileNotFoundException(sprintf(
                'cannot find file in the given path : %s',
                $filePath
            ));
        }

        $yamlParser = new Parser();

        return $yamlParser->parse(file_get_contents($filePath));
    }
}
