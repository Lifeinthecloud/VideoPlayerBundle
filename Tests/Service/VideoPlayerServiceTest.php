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

//use LITC\VideoPlayerBundle\Service\VideoPlayerService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class VideoPlayerServiceTest
 * @author Antoine DARCHE <darche.antoine@gmail.com>
 * @version 1.0
 * @package LITC\VideoPlayerBundle\Tests\Service
 */
class VideoPlayerServiceTest extends WebTestCase
{
    public function testIndex()
    {
        $param = array(
            'server' => array(
                'server' => 'youtube',
                'id' => '7qfxCvwyxms'
            ),
            'player' => array(
                'width' => 800,
                'height' => 500
            )
        );
		
	$this->assertTrue(true);
    }
}