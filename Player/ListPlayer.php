<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LITC\VideoPlayerBundle\Player;

/**
 * Class ListPlayer
 *
 * @author      Antoine DARCHE <darche.antoine@gmail.com>
 * @author      Grégory DARCHE <tetardo@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @link        https://github.com/Lifeinthecloud/VideoPlayerBundle
 * @license     MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @since       PHP 5.3
 * @version     1.0
 * @package     LITC\VideoPlayerBundle
 * @subpackage  Player
 */
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
