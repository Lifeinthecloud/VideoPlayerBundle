<?php

namespace Lifeinthecloud\VideoPlayerBundle\Server;

use Lifeinthecloud\VideoPlayerBundle\Server\AbstractServer;

/**
 * Class VideoPlayer Server Youtube
 *
 * @author      Antoine DARCHE <darche.antoine@gmail.com> & Grégory DARCHE <tetardo@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     1.0
 * @package     Lifeinthecloud\VideoPlayer\Server
 * @subpackage  YoutubeServer
 */

class YoutubeServer extends AbstractServer {

    /**
     * Tableau des parametres par defaut
     *
     * @var   array
     */
    public $param = array(
        'id' => null,
        'url' => 'http://www.youtube.com/v/',
        'param' => array(
            'hl' => 'fr',
            'fs' => '1'
        )
    );

}