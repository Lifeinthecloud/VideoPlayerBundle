<?php

namespace LITC\VideoPlayerBundle\Twig;

use LITC\VideoPlayerBundle\Service\VideoPlayerService;
use LITC\VideoPlayerBundle\Entity\VideoInterface;

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
    
    public function renderVideo(VideoInterface $video, $videoWidth, $imageHeight)
    {
        return $this->videoPlayerManager->play(array(
            'player' => array(
                'width' => $videoWidth,
                'height' => $imageHeight,
            ),
            'server' => array(
                'server' => $video->getVideoServer(),
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
        return 'litc_video_player.video_player_extension';
    }

}
