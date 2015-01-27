<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LITC\VideoPlayerBundle\Tests\Service;

use LITC\VideoPlayerBundle\Tests\TestVideo as Video;
use LITC\VideoPlayerBundle\Service\ParserService;
use LITC\VideoPlayerBundle\Server\ListServer;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ParserServiceTest
 * @author Antoine DARCHE <darche.antoine@gmail.com>
 * @version 1.0
 * @package LITC\VideoPlayerBundle\Tests\Service
 */
class ParserServiceTest extends WebTestCase
{
    /**
     * Assert successful parse on a classic youtube video
     */
    public function testParseClassicYoutubeVideoSuccess()
    {
        $url = 'https://www.youtube.com/watch?v=PtmsoAbqT8w';
        
        $parserService = new ParserService();
        $video = $parserService->parse(new Video(), $url);
        
        // Assert video server
        $videoServer = ListServer::getServerName($video->getVideoServer());
        $this->assertEquals('Youtube', $videoServer);
        
        // Assert video id
        $this->assertEquals('PtmsoAbqT8w', $video->getVideoId());
        
        // Assert thumb
        $this->assertNotNull($video->getThumb());
    }
    
    /**
     * Assert successful parse on a youtube playlist
     */
    public function testParseYoutubePlaylistSuccess()
    {
        $url = 'https://www.youtube.com/watch?v=PtmsoAbqT8w&list=PLT1rsgsHTfQWad8UpMODj-EseQ76bNTaJ';
        
        $parserService = new ParserService();
        $video = $parserService->parse(new Video(), $url);
        
        // Assert video server
        $videoServer = ListServer::getServerName($video->getVideoServer());
        $this->assertEquals('Youtube', $videoServer);
        
        // Assert video id
        $this->assertEquals('PtmsoAbqT8w', $video->getVideoId());
        
        // Assert thumb
        $this->assertNotNull($video->getThumb());
    }
    
    /**
     * Assert exception on a fail video url
     * 
     * @expectedException \LITC\VideoPlayerBundle\Exception\UnsupportedVideoException
     * @expectedExceptionMessage No supported server found in url
     */
    public function testParseException()
    {
        $url = 'https://www.lifeinthecloud.com/watch?v=qzdqzd';
        
        // Assert exception
        $parserService = new ParserService();
        $parserService->parse(new Video(), $url);
    }
    
    /**
     * Assert successful parse on a classic vimeo video
     */
    public function testParseClassicVimeoVideoSuccess()
    {
        $url = 'http://vimeo.com/51140690';
        
        $parserService = new ParserService();
        $video = $parserService->parse(new Video(), $url);
        
        // Assert video server
        $videoServer = ListServer::getServerName($video->getVideoServer());
        $this->assertEquals('Vimeo', $videoServer);
        
        // Assert video id
        $this->assertEquals('51140690', $video->getVideoId());
        
        // Assert thumb
        $this->assertNotNull($video->getThumb());
    }
    
    /**
     * Assert successful parse on a classic youtube video
     */
    public function testParseClassicDailymotionVideoSuccess()
    {
        $url = 'http://www.dailymotion.com/video/x27x385_saschienne-unknown-unknown-album_fun';
        
        $parserService = new ParserService();
        $video = $parserService->parse(new Video(), $url);
        
        // Assert video server
        $videoServer = ListServer::getServerName($video->getVideoServer());
        $this->assertEquals('Dailymotion', $videoServer);
        
        // Assert video id
        $this->assertEquals('x27x385_saschienne-unknown-unknown-album_fun', $video->getVideoId());
        
        // Assert thumb
        $this->assertNotNull($video->getThumb());
    }
}