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
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
interface ServerInterface
{
    /**
     * @return integer
     */
    public function getId();

    /**
     * Gets name
     *
     * @return string
     */
    public function getName();

    /**
     * Sets the name.
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);
}
