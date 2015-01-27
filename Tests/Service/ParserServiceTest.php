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

/**
 * Class ParserServiceTest
 * @author Antoine DARCHE <darche.antoine@gmail.com>
 * @version 1.0
 * @package LITC\VideoPlayerBundle\Tests\Service
 */
class ParserServiceTest extends \PHPUnit_Framework_TestCase
{
    /* @var string */
    private static $youtubeClassicUrl = 'https://www.youtube.com/watch?v=PtmsoAbqT8w';

    /* @var string */
    private static $youtubePlaylistUrl = 'https://www.youtube.com/watch?v=PtmsoAbqT8w&list=PLT1rsgsHTfQWad8UpMODj-EseQ76bNTaJ';

    /* @var string */
    private static $vimeoClassicUrl = 'http://vimeo.com/51140690';

    /* @var string */
    private static $dailymotionClassicUrl = 'http://www.dailymotion.com/video/x27x385_saschienne-unknown-unknown-album_fun';

    /**
     * Assert successful parse on a classic youtube video
     *
     * @author Antoine DARCHE <darche.antoine@gmail.com>
     */
    public function testParseClassicYoutubeVideoSuccess()
    {
        $parserService = new ParserService();
        $video = $parserService->parse(new Video(), self::$youtubeClassicUrl);
        
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
     *
     * @author Antoine DARCHE <darche.antoine@gmail.com>
     */
    public function testParseYoutubePlaylistSuccess()
    {
        $parserService = new ParserService();
        $video = $parserService->parse(new Video(), self::$youtubePlaylistUrl);
        
        // Assert video server
        $videoServer = ListServer::getServerName($video->getVideoServer());
        $this->assertEquals('Youtube', $videoServer);
        
        // Assert video id
        $this->assertEquals('PtmsoAbqT8w', $video->getVideoId());
        
        // Assert thumb
        $this->assertNotNull($video->getThumb());
    }
    
    /**
     * Assert exception on a fake video url
     *
     * @author Antoine DARCHE <darche.antoine@gmail.com>
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
     *
     * @author Antoine DARCHE <darche.antoine@gmail.com>
     */
    public function testParseClassicVimeoVideoSuccess()
    {
        $url = '';
        
        $parserService = new ParserService();
        $video = $parserService->parse(new Video(), self::$vimeoClassicUrl);
        
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
     *
     * @author Antoine DARCHE <darche.antoine@gmail.com>
     */
    public function testParseClassicDailymotionVideoSuccess()
    {
        $parserService = new ParserService();
        $video = $parserService->parse(new Video(), self::$dailymotionClassicUrl);
        
        // Assert video server
        $videoServer = ListServer::getServerName($video->getVideoServer());
        $this->assertEquals('Dailymotion', $videoServer);
        
        // Assert video id
        $this->assertEquals('x27x385_saschienne-unknown-unknown-album_fun', $video->getVideoId());
        
        // Assert thumb
        $this->assertNotNull($video->getThumb());
    }
}