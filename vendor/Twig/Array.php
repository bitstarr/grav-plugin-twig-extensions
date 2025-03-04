<?php

/**
 * This file is part of Twig.
 *
 * (c) 2009 Fabien Potencier
 * (c) 2022 Sebastian Laube
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @author Ricard Clau <ricard.clau@gmail.com>
 */
class Twig_Extensions_Extension_Array extends Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        $filters = array(
            new Twig_SimpleFilter('shuffle', [$this, 'shuffle']),
            new Twig_SimpleFilter('array_push', [$this, 'push' ]),
        );

        return $filters;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'array';
    }

    /**
     * Shuffles an array.
     *
     * @param array|Traversable $array An array
     *
     * @return array
     */
    function shuffle($array)
    {
        if ($array instanceof Traversable) {
            $array = iterator_to_array($array, false);
        }

        shuffle($array);

        return $array;
    }

    /**
     * Push one or more elements onto the end of array
     *
     * @param array|Traversable $array An array
     *
     * @return array
     */
    public function push($array, $array2 = [])
    {
        if ($array instanceof Traversable) {
            $array = iterator_to_array($array, false);
        }

        array_push($array, $array2);
        return $array;
    }
}

class_alias('Twig_Extensions_Extension_Array', 'Twig\Extensions\ArrayExtension', false);