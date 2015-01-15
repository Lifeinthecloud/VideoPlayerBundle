<?php

/*
 * This file is part of the FOSVideoBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\VideoBundle\Util;

use Lifeinthecloud\VideoPlayerBundle\Model\VideoManagerInterface;
use Lifeinthecloud\VideoPlayerBundle\Model\VideoServer;

/**
 * Executes some manipulations on the videos
 *
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
class VideoManipulator
{
    /**
     * Video manager
     *
     * @var VideoManagerInterface
     */
    private $videoManager;

    public function __construct(VideoManagerInterface $videoManager)
    {
        $this->videoManager = $videoManager;
    }

    /**
     * Creates a video and returns it.
     *
     * @param string        $title
     * @param VideoServer   $videoServer
     * @param string        $videoId
     *
     * @return \Lifeinthecloud\VideoPlayerBundle\Model\VideoManagerInterface
     */
    public function create($title, VideoServer $videoServer, $videoId)
    {
        $video = $this->videoManager->createVideo();
        $video->setTitle($title);
        $video->setVideoServer($videoServer);
        $video->setVideoId($videoId);
        $this->videoManager->updateVideo($video);

        return $video;
    }

    /**
     * Demotes the given video.
     *
     * @param string $title
     */
    public function demote($title)
    {
        $video = $this->videoManager->findVideoByTitle($title);

        if (!$video) {
            throw new \InvalidArgumentException(sprintf('Video identified by "%s" title does not exist.', $title));
        }
        $this->videoManager->updateVideo($video);
    }
}
