<?php

namespace Lifeinthecloud\VideoPlayer\Service;

use Lifeinthecloud\VideoPlayer\Exception\VideoPlayerException;

/**
 * Class VideoPlayerBundle
 *
 * @author      Antoine DARCHE & Grégory DARCHE <tetardo@gmail.com>
 * @copyright   Copyright (c) 2009 Life in the cloud.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     1.0
 * @package     Lifeinthecloud\VideoPlayer\Service
 */

class VideoPlayerService
{
    /**
     * Objet parser
     *
     * @var   object
     */
    public $parser = null;

    /**
     * Objet serveur
     *
     * @var   object
     */
    public $server = null;

    /**
     * Objet Player
     *
     * @var   object
     */
    public $player = null;

    /**
     * Tableau des parametres par defaut
     *
     * @var   array
     */
    public $param = array(
        'player' => array(
            'player' => 'Flash',
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
     * __construct
     * Constructeur
     *
     * @param   $param    Tableau des parametres
     */
    public function __construct ( $param=null )
    {
        if (is_null($param) OR !is_array($param))
            throw new VideoPlayerException('Parameter could be an array.', 1);

        $this->param = self::arrayMergeRecursive($this->param, $param);

        if (is_null($this->param['server']['server']) OR !is_string($this->param['server']['server']))
            throw new VideoPlayerException('Variable server.server could be string.', 2);

        if (is_null($this->param['player']['player']) OR !is_string($this->param['player']['player']))
            throw new VideoPlayerException('Variable player.player could be string.', 3);

        if (!is_null($this->param['parser']['url']) AND is_string($this->param['parser']['url']))
            self::parseInstance();

        self::getInstance();
    }

    /**
     * __tostring
     * Affichage
     *
     * @return   $param    Portion HTML
     */
    public function __tostring ( )
    {
        return ''.$this->player;
    }

    /**
     * getServerName
     * Retourne le nom référence du server
     *
     * @return   Nom référence
     */
    public function getServerName ( )
    {
        return ucfirst(strtolower(trim($this->param['server']['server'])));
    }

    /**
     * getPlayerName
     * Retourne le nom référence du player
     *
     * @return   Nom référence
     */
    public function getPlayerName ( )
    {
        return ucfirst(strtolower(trim($this->param['player']['player'])));
    }

    /**
     * getServerParam
     * Retourne les parametres du server
     *
     * @return   tableau des parametres
     */
    public function getServerParam ( )
    {
        return $this->server->getParam();
    }

    /**
     * getPlayerParam
     * Retourne les parametres du player
     *
     * @return   tableau des parametres
     */
    public function getPlayerParam ( )
    {
        return $this->player->getParam();
    }

    /**
     * getVideoId
     * Retourne l'id de la vidéo
     *
     * @return   tableau des parametres
     */
    public function getVideoId ( )
    {
        return $this->server->getId();
    }

    /**
     * getVideoUrl
     * Retourne l'id de la vidéo
     *
     * @return   tableau des parametres
     */
    public function getVideoUrl ( )
    {
        return $this->server->getUrl();
    }

    /**
     * getInstance
     * Initialise les objects server et player
     */
    private function getInstance ( )
    {
        if (is_null($this->param['server']['id']) OR !is_string($this->param['server']['id']))
            throw new VideoPlayerException('Variable serveur.id could be a string.', 4);

        $className = 'Lifeinthecloud\VideoPlayerBundle\Server\\'.self::getServerName().'Server';
        //$className = 'Hoa_VideoPlayer_Server_'.self::getServerName();
        $this->server = new $className($this->param['server']);

        $this->param['player']['url'] = $this->server->getUrl();

        $className = 'Lifeinthecloud\VideoPlayerBundle\Player\\'.self::getServerName().'Player';
        $this->player = new $className($this->param['player']);
    }

    /**
     * parse
     * Parse une url et défini l'id vidéo
     */
    private function parseInstance ( )
    {
        /**
         * Hoa importation
         */
        import('VideoPlayer.Parser.'.self::getServerName());

        $className = 'Hoa_VideoPlayer_Parser_'.self::getServerName();
        $this->parser = new $className($this->param['parser']['url']);

        $this->param['server']['id'] = $this->parser->id;
    }

    /**
     * array_merge_recursive_distinct
     * Fusionne recursivement deux tableaux en conservant les clés et valeurs par default
     *
     * @param   $array1   Tableau par defaut
     * @param   $array2   Tableau Secondaire
     * @return  Tableau fusionné
     */
    private function arrayMergeRecursive ( array &$array1, array &$array2 )
    {
        $merged = $array1;

        foreach ($array2 as $key => &$value) {

            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = self::arrayMergeRecursive ($merged[$key], $value);
            }
            else {
                $merged[$key] = $value;
            }
        }

        return $merged;
    }

}