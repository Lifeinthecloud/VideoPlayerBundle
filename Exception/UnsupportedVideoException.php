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
 * This exception is thrown when a video is reloaded from a provider which
 * doesn't support the passed implementation of VideoInterface.
 *
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 */
class UnsupportedVideoException extends VideoPlayerServiceException
{
}
