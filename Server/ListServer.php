<?php

namespace Lifeinthecloud\VideoPlayerBundle\Server;

class ListServer
{

    private static $servers = array(
        1 => 'Dailymotion',
        2 => 'Vimeo',
        3 => 'Youtube'
    );
    private static $namespace = 'Lifeinthecloud\VideoPlayerBundle\Server\\';
    private static $suffixe = 'Server';

    public static function getClassFromServerId($id)
    {
        return self::$namespace . self::$servers[$id] . self::$suffixe;
    }

}
