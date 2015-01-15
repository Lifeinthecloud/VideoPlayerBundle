<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lifeinthecloud\VideoPlayerBundle\Security;

use Lifeinthecloud\VideoPlayerBundle\Exception\UnsupportedVideoException;
use Lifeinthecloud\VideoPlayerBundle\Exception\TitleNotFoundException;
use Lifeinthecloud\VideoPlayerBundle\Model\VideoInterface;

/**
 * Represents a class that loads VideoInterface objects from some source for the video player system.
 *
 * In a typical video player configuration, a title (i.e. some unique
 * title identifier) credential enters the system (via form addVideo, or any
 * method). The video provider that is configured with that video player
 * method is asked to load the VideoInterface object for the given title
 * (via loadVideoByTitle) so that the rest of the process can continue.
 *
 * Internally, a video provider can load videos from any source (databases,
 * configuration, web service). This is totally independent of how the video player
 * information is submitted or what the VideoInterface object looks like.
 *
 * @see VideoInterface
 *
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
interface VideoProviderInterface
{
    /**
     * Loads the video for the given title.
     *
     * This method must throw TitleNotFoundException if the video is not
     * found.
     *
     * @param string $title The title
     *
     * @return VideoInterface
     *
     * @see TitleNotFoundException
     *
     * @throws TitleNotFoundException if the video is not found
     */
    public function loadVideoByTitle($title);

    /**
     * Refreshes the video for the account interface.
     *
     * It is up to the implementation to decide if the video data should be
     * totally reloaded (e.g. from the database), or if the VideoInterface
     * object can just be merged into some internal array of videos / identity
     * map.
     *
     * @param VideoInterface $video
     *
     * @return VideoInterface
     *
     * @throws UnsupportedVideoException if the account is not supported
     */
    public function refreshVideo(VideoInterface $video);

    /**
     * Whether this provider supports the given video class.
     *
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class);
}
