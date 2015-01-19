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
interface VideoInterface
{
    /**
     * Gets video server.
     *
     * @return VideoServer
     */
    public function getVideoServer();

    /**
     * Sets the video server.
     *
     * @param VideoServer $videoServer
     *
     * @return self
     */
    public function setVideoServer($videoServer);

    /**
     * Gets video id.
     *
     * @return string
     */
    public function getVideoId();

    /**
     * Sets the video id.
     *
     * @param string $videoId
     *
     * @return self
     */
    public function setVideoId($videoId);
}