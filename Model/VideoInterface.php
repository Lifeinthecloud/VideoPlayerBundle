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
interface VideoInterface
{
    /**
     * Gets server.
     *
     * @return Server
     */
    public function getServer();

    /**
     * Sets the server.
     *
     * @param Server $server
     *
     * @return self
     */
    public function setServer($server);

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