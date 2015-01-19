<?php

namespace Lifeinthecloud\VideoPlayerBundle\Player;

class ListPlayer
{

    private static $player = array(
        1 => 'Flash'
    );
    
    private static $namespace = 'Lifeinthecloud\VideoPlayerBundle\Player\\';
    
    private static $suffixe = 'Player';

    public static function getClassFromPlayerId($id)
    {
        return self::$namespace . self::$player[$id] . self::$suffixe;
    }

}
