<?php
/**
 * Created by PhpStorm.
 * User: Joey
 * Date: 13/01/2015
 * Time: 22:59
 */

namespace LITC\VideoPlayerBundle\Tests\Service;

//use LITC\VideoPlayerBundle\Service\VideoPlayerService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class VideoPlayerServiceTest
 * @package LITC\VideoPlayerBundle\Tests\Service
 */
class VideoPlayerServiceTest extends WebTestCase
{
    public function testIndex()
    {
        $param = array(
            'server' => array(
                'server' => 'youtube',
                'id' => 'nsgHyzwmbnQ'
            ),
            'player' => array(
                'width' => 800,
                'height' => 500
            )
        );
		
		$this->assertTrue(true);
    }
}