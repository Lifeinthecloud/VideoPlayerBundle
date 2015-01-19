<?php

namespace Lifeinthecloud\VideoPlayerBundle\Service;

use Lifeinthecloud\VideoPlayerBundle\Entity\VideoInterface;

/**
 * Class ParserService
 *
 * @author      Thibault Harel
 * @copyright   Copyright (c) 2009 Life in the cloud.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     1.0
 * @package     Lifeinthecloud\VideoPlayer\Service
 */
class ParserService
{

    public function parse(VideoInterface $video, $url)
    {
        if (preg_match('%^.+dailymotion.com\/(?:video|swf\/video|embed\/video|hub|swf)\/([^&?]+)%i', $url, $match)) {
            // Dailymotion
            $video->setVideoServer(1);
            $video->setVideoId($match[1]);
        } elseif (preg_match('%(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*%i', $url, $match)) {
            // Vimeo
            $video->setVideoServer(2);
            $video->setVideoId($match[5]);
        } elseif (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            // Youtube
            $video->setVideoServer(3);
            $video->setVideoId($match[1]);
        } else {
            throw new UnsupportedVideoException('No supported server found in url');
        }

        return $video;
    }

}
