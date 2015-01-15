<?php
/**
 * Created by PhpStorm.
 * User: antoine.darche
 * Date: 15/01/2015
 * Time: 15:56
 */

namespace Lifeinthecloud\VideoPlayerBundle\Exception;

/**
 * VideoPlayerServiceException is thrown when a video player request could not be processed due to a system problem.
 *
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
class VideoPlayerServiceException extends VideoPlayerException
{
    /**
     * {@inheritdoc}
     */
    public function getMessageKey()
    {
        return 'Authentication request could not be processed due to a system problem.';
    }
}