<?php

namespace Lifeinthecloud\VideoPlayerBundle\Player;

/**
 * Class VideoPlayer Player Abstract
 *
 * @author      Antoine DARCHE <darche.antoine@gmail.com> & Grégory DARCHE <tetardo@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     1.0
 * @package     Hoa_VideoPlayer
 * @subpackage  Hoa_VideoPlayer_Player_Abstract
 */

abstract class AbstractPlayer {

    /**
     * __tostring
     * Affichage 
     * 
     * @return   Portion HTML contenant le player
     */
    abstract public function __tostring();

    /**
     * __construct
     * Constructeur 
     * 
     * @param   $param   Tableau des parametres
     */
    public function __construct ( $param=null ) {

        if (is_null($param) OR !is_array($param))
            throw new Hoa_VideoPlayer_Exception('Parameter could be an array.', 1);

        $this->param = self::arrayMergeRecursive($this->param, $param);

        if (is_null($this->param['url']) OR !is_string($this->param['url']))
            throw new Hoa_VideoPlayer_Exception('Variable url could be a string.', 2);
    }

    /**
     * getParam
     * Retourne les parametres
     * 
     * @return   tableau des parametres
     */
    public function getParam ( ) {

        return $this->param;
    }

    /**
     * getUrl
     * Retourne l'url de la vidéo
     * 
     * @return   url
     */
    public function getUrl ( ) {

        return $this->url;
    }

    /**
     * getPlayer
     * Retourne le nom du player
     * 
     * @return   nom du player
     */
    public function getPlayer ( ) {

        return $this->player;
    }

    /**
     * array_merge_recursive_distinct
     * Fusionne recursivement deux tableaux en conservant les clés et valeurs par default
     * 
     * @param   $array1   Tableau par defaut
     * @param   $array2   Tableau Secondaire
     * @return  Tableau fusionné     
     */
    private function arrayMergeRecursive ( array &$array1, array &$array2 ) {
        
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