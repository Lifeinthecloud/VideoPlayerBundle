<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LITC\VideoPlayer\Model;

/**
 * Description of VideoManagerInterface
 * 
 * @author      Antoine DARCHE <antoine.darche@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @link        https://github.com/Lifeinthecloud/VideoPlayerBundle
 * @license     MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @since       PHP 5.3
 * @version     1.0
 * @package     LITC\VideoPlayerBundle
 * @subpackage  Model
 */
class VideoManagerInterface
{
    /**
     * Creates an empty video instance.
     *
     * @return VideoInterface
     */
    public function createVideo();

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
