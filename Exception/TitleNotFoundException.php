<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lifeinthecloud\VideoPlayerBundle\Exception;

/**
 * TitleNotFoundException is thrown if a Video cannot be found by its title.
 *
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
class TitleNotFoundException extends \RuntimeException implements \Serializable
{
    private $title;

    /**
     * {@inheritdoc}
     */
    public function getMessageKey()
    {
        return 'Title could not be found.';
    }

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the title.
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return serialize(array(
            $this->username,
            parent::serialize(),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($str)
    {
        list($this->username, $parentData) = unserialize($str);

        parent::unserialize($parentData);
    }
}