<?php

namespace LITC\VideoPlayerBundle\Player;

class ListPlayer
{

    private static $player = array(
        1 => 'Flash'
    );
    
    private static $namespace = 'LITC\VideoPlayerBundle\Player\\';
    
    private static $suffixe = 'Player';

    public static function getClassFromPlayerId($id)
    {
        return self::$namespace . self::$player[$id] . self::$suffixe;
    }

}
