<?php

namespace Lifeinthecloud\VideoPlayerBundle\Server;

use Lifeinthecloud\VideoPlayerBundle\Server\AbstractServer;

/**
 * Class VideoPlayer Server Vimeo
 *
 * @author      Antoine DARCHE <darche.antoine@gmail.com> & Grégory DARCHE <tetardo@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     1.0
 * @package     Lifeinthecloud\VideoPlayer\Server
 * @subpackage  VimeoServer
 */

class VimeoServer extends AbstractServer {

    /**
     * Tableau des parametres par defaut
     *
     * @var   array
     */ 
    public $param = array(
        'id' => null,
        'url' => 'http://vimeo.com/moogaloop.swf?clip_id=',
        'param' => array(
            'server' => 'vimeo.com',
            'show_title=' => '1',
            'show_byline' => '1',
            'show_portrait' => '0',
            'color' => '',
            'fullscreen' => '1'
        )
    );

}