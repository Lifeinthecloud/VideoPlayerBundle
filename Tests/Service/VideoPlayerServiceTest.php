<?php
/**
 * Created by PhpStorm.
 * User: Joey
 * Date: 13/01/2015
 * Time: 22:59
 */

namespace Lifeinthecloud\VideoPlayerBundle\Tests\Service;

use Lifeinthecloud\VideoPlayerBundle\Service\VideoPlayerService;

/**
 * Class VideoPlayerServiceTest
 * @package Lifeinthecloud\VideoPlayerBundle\Tests\Service
 */
class VideoPlayerServiceTest {


    /**
     *
     */
    public function __construct()
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
    }
}

new VideoPlayerServiceTest();