<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace LITC\VideoPlayerBundle\Service;

use LITC\VideoPlayerBundle\Entity\VideoInterface;

/**
 * Class ParserService
 *
 * @author      Thibault Harel
 * @copyright   Copyright (c) 2009 Life in the cloud.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     1.0
 * @package     LITC\VideoPlayer\Service
 */
class ParserService
{

    public function parse(VideoInterface $video, $url)
    {
        if (preg_match('%^.+dailymotion.com\/(?:video|swf\/video|embed\/video|hub|swf)\/([^&?]+)%i', $url, $match)) {
            // Dailymotion
            $video->setVideoServer(1);
            $video->setVideoId($match[1]);
            $site = file_get_contents("http://www.dailymotion.com/services/oembed?format=json&url=http://www.dailymotion.com/video/" . $match[1]);
            $convert = json_decode($site);
            if (is_object($convert)) {
                $video->setThumb($convert->thumbnail_url);
            } else {
                throw new UnsupportedVideoException('Cannot get video info from url');
            }
        } elseif (preg_match('%(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*%i', $url, $match)) {
            // Vimeo
            $video->setVideoServer(2);
            $video->setVideoId($match[5]);
            // get thumb from json api
            $site = file_get_contents("http://vimeo.com/api/v2/video/$id.json");
            $convert = json_decode($site);
            if (is_object($convert[0])) {
                $video->setThumb($convert[0]->thumbnail_large);
            } else {
                throw new UnsupportedVideoException('Cannot get video info from url');
            }
        } elseif (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            // Youtube
            $video->setVideoServer(3);
            $video->setVideoId($match[1]);
            $video->setThumb("http://i1.ytimg.com/vi/".$match[1]."/hqdefault.jpg");
        } else {
            throw new UnsupportedVideoException('No supported server found in url');
        }

        return $video;
    }

}
