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

use Lifeinthecloud\VideoPlayerBundle\Util\CanonicalizerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Lifeinthecloud\VideoPlayerBundle\Exception\UnsupportedVideoException;
use Lifeinthecloud\VideoPlayerBundle\Exception\TitleNotFoundException;
use Lifeinthecloud\VideoPlayerBundle\Model\VideoInterface as SecurityVideoInterface;
use Lifeinthecloud\VideoPlayerBundle\Model\VideoProviderInterface;

/**
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
abstract class VideoManager implements UserManagerInterface, UserProviderInterface
{
    protected $encoderFactory;
    protected $titleCanonicalizer;
    protected $videoIdCanonicalizer;

    /**
     * Constructor.
     *
     * @param EncoderFactoryInterface $encoderFactory
     * @param CanonicalizerInterface  $titleCanonicalizer
     * @param CanonicalizerInterface  $videoIdCanonicalizer
     */
    public function __construct(EncoderFactoryInterface $encoderFactory, CanonicalizerInterface $titleCanonicalizer, CanonicalizerInterface $videoIdCanonicalizer)
    {
        $this->encoderFactory = $encoderFactory;
        $this->titleCanonicalizer = $titleCanonicalizer;
        $this->emailCanonicalizer = $videoIdCanonicalizer;
    }

    /**
     * Returns an empty video instance
     *
     * @return VideoInterface
     */
    public function createVideo()
    {
        $class = $this->getClass();
        $video = new $class;

        return $video;
    }

    /**
     * Finds a video by title
     *
     * @param string $title
     *
     * @return VideoInterface
     */
    public function findVideoByTitle($title)
    {
        return $this->findVideoBy(array('titleCanonical' => $this->canonicalizeTitle($title)));
    }

    /**
     * Finds a video by video id
     *
     * @param string $videoId
     *
     * @return UserInterface
     */
    public function findVideoByVideoId($videoId)
    {
        return $this->findVideoBy(array('videoIdCanonical' => $this->canonicalizeVideoId($videoId)));
    }

    /**
     * Refreshed a video by Video Instance
     *
     * Throws UnsupportedVideoException if a Video Instance is given which is not
     * managed by this VideoManager (so another Manager could try managing it)
     *
     * @param SecurityVideoInterface $video
     *
     * @return VideoInterface
     */
    public function refreshVideo(SecurityVideoInterface $video)
    {
        $class = $this->getClass();
        if (!$video instanceof $class) {
            throw new UnsupportedVideoException('Video is not supported.');
        }
        if (!$video instanceof Video) {
            throw new UnsupportedVideoException(sprintf('Expected an instance of Lifeinthecloud\VideoPlayerBundle\Model\Video, but got "%s".', get_class($video)));
        }

        $refreshedVideo = $this->findVideoBy(array('id' => $video->getId()));
        if (null === $refreshedVideo) {
            throw new TitleNotFoundException(sprintf('Video with ID "%d" could not be reloaded.', $video->getId()));
        }

        return $refreshedVideo;
    }

    /**
     * Loads a video by title
     *
     * It is strongly discouraged to call this method manually as it bypasses
     * all ACL checks.
     *
     * @param string $title
     *
     * @return VideoInterface
     */
    public function loadVideoByTitle($title)
    {
        $user = $this->findVideoByTitle($title);

        if (!$user) {
            throw new TitleNotFoundException(sprintf('No video with name "%s" was found.', $title));
        }

        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function updateCanonicalFields(VideoInterface $video)
    {
        $video->setTitleCanonical($this->canonicalizeTitle($video->getTitle()));
        $video->setVideoIdCanonical($this->canonicalizeVideoId($video->getVideoId()));
    }

    /**
     * Canonicalizes an video id
     *
     * @param string $videoId
     *
     * @return string
     */
    protected function canonicalizeVideoId($videoId)
    {
        return $this->videoIdCanonicalizer->canonicalize($videoId);
    }

    /**
     * Canonicalizes a title
     *
     * @param string $title
     *
     * @return string
     */
    protected function canonicalizeTitle($title)
    {
        return $this->titleCanonicalizer->canonicalize($title);
    }

    protected function getEncoder(VideoInterface $video)
    {
        return $this->encoderFactory->getEncoder($video);
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return $class === $this->getClass();
    }
}
