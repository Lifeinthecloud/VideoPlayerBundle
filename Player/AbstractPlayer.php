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
 * Class VideoPlayer Player Abstract
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