<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LITC\VideoPlayerBundle\Model;

/**
 * @author      Antoine DARCHE <antoine.darche@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @link        https://github.com/Lifeinthecloud/VideoPlayerBundle
 * @license     MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @since       PHP 5.3
 * @version     1.0
 * @package     LITC\VideoPlayerBundle
 * @subpackage  Model
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
    
    /**
     * Gets video thumb url.
     *
     * @return string
     */
    public function getThumb();
    
    /**
     * Set the video thumb url.
     *
     * @return string
     */
    public function setThumb($thumb);
}