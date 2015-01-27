<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LITC\VideoPlayerBundle\Server;

class ListServer
{
    private static $servers = array(
        1 => 'Dailymotion',
        2 => 'Vimeo',
        3 => 'Youtube'
    );
    private static $namespace = 'LITC\VideoPlayerBundle\Server\\';
    private static $suffixe = 'Server';

    public static function getClassFromServerId($id)
    {
        return self::$namespace . self::$servers[$id] . self::$suffixe;
    }
    
    /**
     * Get the server name
     * 
     * @param integer $serverId
     */
    public static function getServerName($serverId)
    {
        return self::$servers[$serverId];
    }
    
    /**
     * Get the server id
     * 
     * @param string $server
     */
    public static function getServerId($server)
    {
        return array_search($server, self::$servers);
    }

}
