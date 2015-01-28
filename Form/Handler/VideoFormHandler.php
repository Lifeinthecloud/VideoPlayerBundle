<?php

/*
 * This file is part of the FOSVideoBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LITC\VideoPlayerBundle\Form\Handler;

use LITC\VideoPlayerBundle\Model\VideoInterface;
use LITC\VideoPlayerBundle\Model\VideoManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class VideoFormHandler
{
    protected $request;
    protected $videoManager;
    protected $form;

    public function __construct(FormInterface $form, Request $request, VideoManagerInterface $videoManager)
    {
        $this->form = $form;
        $this->request = $request;
        $this->videoManager = $videoManager;
    }

    public function process(VideoInterface $video)
    {
        
        
        $this->form->setData($video);

        if ('POST' === $this->request->getMethod()) {
            $this->form->bind($this->request);

            if ($this->form->isValid()) {
                
                // Parse url for the video
                $parserService = $this->get('litc_video_player.parser_service');
                $parserService->parse($video, $formVideo->get('url')->getData());
                
                $this->onSuccess($video);

                return true;
            }

            // Reloads the video to reset its videoname. This is needed when the
            // videoname or password have been changed to avoid issues with the
            // security layer.
            $this->videoManager->reloadVideo($video);
        }

        return false;
    }

    protected function onSuccess(VideoInterface $video)
    {
        
        $this->videoManager->updateVideo($video);
    }
}
