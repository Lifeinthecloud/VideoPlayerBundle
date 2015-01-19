<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lifeinthecloud\VideoPlayerBundle\Entity;

/**
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
abstract class Video implements VideoInterface
{
    protected $id;

    /**
     * @var VideoServer
     */
    protected $videoServer;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $videoId;

    public function __construct()
    {
    }

    /**
     * Serializes the user.
     *
     * The serialized data have to contain the fields used by the equals method and the username.
     *
     * @return string
     */
    public function serialize()
    {
        return serialize(array(
            $this->title,
            $this->videoId,
            $this->id,
        ));
    }

    /**
     * Unserializes the video.
     *
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        // add a few extra elements in the array to ensure that we have enough keys when unserializing
        // older data which does not include all properties.
        $data = array_merge($data, array_fill(0, 2, null));

        list(
            $this->title,
            $this->videoId,
            $this->id,
         ) = $data;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return VideoServer
     */
    public function getVideoServer()
    {
        return $this->videoServer;
    }

    /**
     * @param VideoServer $videoServer
     */
    public function setVideoServer($videoServer)
    {
        $this->videoServer = $videoServer;
    }

    /**
     * @return string
     */
    public function getVideoId()
    {
        return $this->videoId;
    }

    /**
     * @param string $videoId
     */
    public function setVideoId($videoId)
    {
        $this->videoId = $videoId;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

}