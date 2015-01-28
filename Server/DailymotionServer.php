<?php

namespace LITC\VideoPlayerBundle\Server;

use LITC\VideoPlayerBundle\Server\AbstractServer;

/**
 * Class VideoPlayer Server Dailymotion
 *
 * @author      Antoine DARCHE <darche.antoine@gmail.com> & Grégory DARCHE <tetardo@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     1.0
 * @package     LITC\VideoPlayer
 * @subpackage  Server
 */

class DailymotionServer extends AbstractServer {

    /**
     * Tableau des parametres par defaut
     *
     * @var   array
     */
    public $param = array(
        'id' => null,
        'url' => 'http://www.dailymotion.com/swf/',
        'param' => array(
            'related' => '0'
        )
    );

}