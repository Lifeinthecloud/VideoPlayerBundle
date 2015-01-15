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
 * Interface to be implemented by video managers. This adds an additional level
 * of abstraction between your application, and the actual repository.
 *
 * All changes to videos should happen through this interface.
 *
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
interface VideoManagerInterface
{
    /**
     * Returns an empty video instance.
     *
     * @param string $name
     *
     * @return VideoInterface
     */
    public function createVideo($name);

    /**
     * Deletes a video.
     *
     * @param VideoInterface $video
     *
     * @return void
     */
    public function deleteVideo(VideoInterface $video);

    /**
     * Finds one video by the given criteria.
     *
     * @param array $criteria
     *
     * @return VideoInterface
     */
    public function findVideoBy(array $criteria);

    /**
     * Finds a video by name.
     *
     * @param string $name
     *
     * @return VideoInterface
     */
    public function findVideoByName($name);

    /**
     * Returns a collection with all video instances.
     *
     * @return \Traversable
     */
    public function findVideos();

    /**
     * Returns the video's fully qualified class name.
     *
     * @return string
     */
    public function getClass();

    /**
     * Updates a video.
     *
     * @param VideoInterface $video
     *
     * @return void
     */
    public function updateVideo(VideoInterface $video);
}
