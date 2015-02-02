<?php

namespace LITC\VideoPlayerBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use LITC\VideoPlayerBundle\Model\VideoInterface;

/**
 * Description of LogosController
 *
 * @author 
 */
class VideosController extends ContainerAware
{

    public function listMediasAction(Request $request, $idPf)
    {
    }
    
    /**
     * Add video
     * 
     * @param Request $request
     * @return type
     */
    public function editAction($videoId=null)
    {
        $videoManager = $this->container->get('litc_video_player.video_manager');

        if(!empty($videoId)) {
            $video = $videoManager->findVideoBy(array('id' => $videoId));
        } else {
            $video = $videoManager->createVideo();
        }

        if (!is_object($video) || !$video instanceof VideoInterface) {
            throw new \Exception('This is not a video object.');
        }

        $form = $this->container->get('litc_video_player.video.form');
        $formHandler = $this->container->get('litc_video_player.video.form.handler');

        $process = $formHandler->process($video);
        if ($process) {
            $this->setFlash('litc_video_player_success', 'video.flash.updated');

            return new RedirectResponse($this->getRedirectionUrl($video));
        }

        return $this->container->get('templating')->renderResponse(
            'LITCVideoPlayerBundle:Video:edit.html.'.$this->container->getParameter('litc_video_player.template.engine'),
            array('form' => $form->createView())
        );
    }

    /**
     * Delete a video
     * 
     * @param type $idVideo
     * @return type
     */
    /*
    public function deleteAction($idVideo)
    {
        $imageServices = $this->get("precom_medias_services");
        $imageServices->deleteVideoById($idVideo);
        
        return $this->redirect($this->generateUrl(
            'precom_admin_medias_list',
            array()
        ));
    }
     */
    
    
    /**
     * Generate the redirection url when editing is completed.
     *
     * @param VideoInterface $video
     *
     * @return string
     */
    protected function getRedirectionUrl(VideoInterface $video)
    {
        return $this->container->get('router')->generate('litc_video_player_video_show');
    }
    
    /**
     * @param string $action
     * @param string $value
     */
    protected function setFlash($action, $value)
    {
        $this->container->get('session')->getFlashBag()->set($action, $value);
    }
}
