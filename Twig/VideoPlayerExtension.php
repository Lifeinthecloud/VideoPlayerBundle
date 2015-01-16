<?php

namespace Lifeinthecloud\VideoPlayerBundle\Twig;

use Lifeinthecloud\VideoPlayerBundle\Service\VideoPlayerService;
use Lifeinthecloud\VideoPlayerBundle\Model\Video;

/**
 * Twig extension to embed the video directly in twig
 *
 * @author thibault.harel
 */
class VideoPlayerExtension extends \Twig_Extension
{

    protected $videoPlayerManager;


    public function __construct(VideoPlayerService $videoPlayerManager = null)
    {
        $this->videoPlayerManager = $videoPlayerManager;
    }
    
    public function renderVideo(Video $video, $videoWidth, $imageHeight)
    {
        return $this->videoPlayerManager->play(array(
            'player' => array(
                'width' => $videoWidth,
                'height' => $imageHeight,
            ),
            'server' => array(
                'server' => $video->getVideoServer()->getName(),
                'id' => $video->getVideoId(),
            ),
        ));
    }
    
    public function getFunctions()
    {
        return array(
            'play_video' => new \Twig_Function_Method($this, 'renderVideo', array('is_safe' => array('html')))
        );
    }
    
    public function getName()
    {
        return 'lifeinthecloud_video_player.video_player_extension';
    }

}
