<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LITC\VideoPlayerBundle\Exception;

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