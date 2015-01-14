<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lifeinthecloud\VideoPlayerBundle\Model;

/**
 * Abstract Video Server Manager implementation which can be used as base class for your
 * concrete manager.
 *
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
abstract class VideoServerManager implements VideoServerManagerInterface
{
    /**
     * {@inheritDoc}
     */
    public function createVideoServer($name)
    {
        $class = $this->getClass();

        return new $class($name);
    }
    /**
     * {@inheritDoc}
     */
    public function findVideoServerByName($name)
    {
        return $this->findVideoServerBy(array('name' => $name));
    }
}
