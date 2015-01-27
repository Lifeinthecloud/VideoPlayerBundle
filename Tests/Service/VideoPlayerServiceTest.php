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

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use LITC\VideoPlayerBundle\Service\VideoPlayerService;
use LITC\VideoPlayerBundle\Server\ListServer;

/**
 * Class VideoPlayerServiceTest
 * @author Antoine DARCHE <darche.antoine@gmail.com>
 * @version 1.0
 * @package LITC\VideoPlayerBundle\Tests\Service
 */
class VideoPlayerServiceTest extends WebTestCase
{

    private $params = array(
        'server' => array(
            'server'    => 2,
            'id'        => '7qfxCvwyxms'
        ),
        'player' => array(
            'width'     => 800,
            'height'    => 500
        )
    );

    /**
     * Test player
     */
    public function testPlay()
    {
        $serverId = ListServer::getServerId('Youtube');
        
        $videoPlayerService = new VideoPlayerService();
        $videoHtml = $videoPlayerService->play($this->params);
        
	    $this->assertNotNull($videoHtml);
    }

    /**
     * Test to string function
     */
    public function testToString()
    {
        $serverId = ListServer::getServerId('Youtube');

        $videoPlayerService = new VideoPlayerService();
        $videoPlayerService->setParameters($this->params);
        $videoHtml = $videoPlayerService->__tostring();

	    $this->assertNotNull($videoHtml);
    }
}