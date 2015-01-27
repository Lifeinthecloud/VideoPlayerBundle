<?php

/*
 * This file is part of the VideoPlayerBundle package.
 *
 * (c) Life in the cloud <http://lifeinthecloud.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace LITC\VideoPlayerBundle\Service;

use LITC\VideoPlayerBundle\Exception\VideoPlayerException;
use LITC\VideoPlayerBundle\Server\ListServer;
use LITC\VideoPlayerBundle\Player\ListPlayer;

/**
 * Class VideoPlayerBundle
 *
 * @author      Antoine DARCHE & Grégory DARCHE <tetardo@gmail.com>
 * @copyright   Copyright (c) 2009 Life in the cloud.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     1.0
 * @package     LITC\VideoPlayer\Service
 */
class VideoPlayerService
{

    /**
     * Object parser
     *
     * @var   object
     */
    public $parser = null;

    /**
     * Object serveur
     *
     * @var   object
     */
    public $server = null;

    /**
     * Object Player
     *
     * @var   object
     */
    public $player = null;

    /**
     * Array of parameters par default
     *
     * @var   array
     */
    public $param = array(
        'player' => array(
            'player' => 1,
            'width' => 560,
            'height' => 340,
            'param' => array()
        ),
        'server' => array(
            'server' => null,
            'id' => null,
            'param' => array()
        ),
        'parser' => array(
            'url' => null
        )
    );

    /**
     * Construct video player
     *
     * show example :
     *
     *     $param = array(
     *         'server' => array(
     *             'server' => 'youtube',
     *             'id' => 'xxxx'
     *          ),
     *          'player' => array(
     *              'width' => 800,
     *              'height' => 500
     *          )
     *     );
     *
     * @param   $param    Array of parameters
     * @throws VideoPlayerException
     */
    public function __construct()
    {
        
    }

    public function play($param = null)
    {
        if (is_null($param) OR !is_array($param)) {
            throw new VideoPlayerException('Parameter could be an array.', 1);
        }

        $this->param = $this->arrayMergeRecursive($this->param, $param);

        if (is_null($this->param['server']['server']) OR !is_int($this->param['server']['server'])) {
            throw new VideoPlayerException('Variable server.server must be an integer.', 2);
        }

        if (is_null($this->param['player']['player']) OR !is_int($this->param['player']['player'])) {
            throw new VideoPlayerException('Variable player.player must be an integer.', 3);
        }

        if (is_null($this->param['server']['id']) OR !is_string($this->param['server']['id'])) {
            throw new VideoPlayerException('Variable serveur.id must be a string.', 4);
        }

        $serverClassName = ListServer::getClassFromServerId($this->param['server']['server']);
        $this->server = new $serverClassName($this->param['server']);

        $this->param['player']['url'] = $this->server->getUrl();

        $playerClassName = ListPlayer::getClassFromPlayerId($this->param['player']['player']);
        $this->player = new $playerClassName($this->param['player']);

        return self::__toString();
    }

    /**
     * Show video player
     *
     * @return string $param Portion HTML
     */
    public function __tostring()
    {
        return '' . $this->player;
    }

    /**
     * getServerParam
     * Retourne les parametres du server
     *
     * @return   tableau des parametres
     */
    public function getServerParam()
    {
        return $this->server->getParam();
    }

    /**
     * getPlayerParam
     * Retourne les parametres du player
     *
     * @return   tableau des parametres
     */
    public function getPlayerParam()
    {
        return $this->player->getParam();
    }

    /**
     * getVideoId
     * Retourne l'id de la vidéo
     *
     * @return   tableau des parametres
     */
    public function getVideoId()
    {
        return $this->server->getId();
    }

    /**
     * getVideoUrl
     * Retourne l'id de la vidéo
     *
     * @return   tableau des parametres
     */
    public function getVideoUrl()
    {
        return $this->server->getUrl();
    }

    /**
     * array_merge_recursive_distinct
     * Fusionne recursivement deux tableaux en conservant les clés et valeurs par default
     *
     * @param   $array1   Tableau par defaut
     * @param   $array2   Tableau Secondaire
     *
     * @return  Tableau fusionné
     */
    private function arrayMergeRecursive(array &$array1, array &$array2)
    {
        $merged = $array1;

        foreach ($array2 as $key => &$value) {

            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = self::arrayMergeRecursive($merged[$key], $value);
            } else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }

}
