<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LITC\VideoPlayerBundle\Tests;

use LITC\VideoPlayerBundle\Entity\Video;

class TestVideo extends Video
{
    public function setId($id)
    {
        $this->id = $id;
    }
}
