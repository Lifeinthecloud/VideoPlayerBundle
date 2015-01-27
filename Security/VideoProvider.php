<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LITC\VideoPlayerBundle\Security;

use LITC\VideoPlayerBundle\Security\VideoProviderInterface;
use LITC\VideoPlayerBundle\Exception\UnsupportedVideoException;
use LITC\VideoPlayerBundle\Exception\TitleNotFoundException;
use LITC\VideoPlayerBundle\Model\VideoInterface as SecurityVideoInterface;
use LITC\VideoPlayerBundle\Model\VideoInterface;
use LITC\VideoPlayerBundle\Model\VideoManagerInterface;

class VideoProvider implements VideoProviderInterface
{

    /**
     * @var VideoManagerInterface
     */
    protected $videoManager;

    /**
     * Constructor.
     *
     * @param VideoManagerInterface $videoManager
     */
    public function __construct(VideoManagerInterface $videoManager)
    {
        $this->videoManager = $videoManager;
    }

    /**
     * {@inheritDoc}
     */
    public function loadVideoByTitle($title)
    {
        $video = $this->findVideo($title);
        if (!$video) {
            throw new VideoNotFoundException(sprintf('Title "%s" does not exist.', $title));
        }
        return $video;
    }

    /**
     * {@inheritDoc}
     */
    public function refreshVideo(SecurityVideoInterface $video)
    {
        if (!$this->supportsClass(get_class($video))) {
            throw new UnsupportedVideoException(sprintf('Expected an instance of %s, but got "%s".', $this->videoManager->getClass(), get_class($video)));
        }
        if (null === $reloadedVideo = $this->videoManager->findVideoBy(array('id' => $video->getId()))) {
            throw new TitleNotFoundException(sprintf('Video with ID "%d" could not be reloaded.', $video->getId()));
        }
        return $reloadedVideo;
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        $videoClass = $this->videoManager->getClass();
        return $videoClass === $class || is_subclass_of($class, $videoClass);
    }

    /**
     * Finds a video by title.
     *
     * This method is meant to be an extension point for child classes.
     *
     * @param string $title
     *
     * @return VideoInterface|null
     */
    protected function findVideo($title)
    {
        return $this->videoManager->findVideoByTitle($title);
    }

}
