<?php

namespace Lifeinthecloud\VideoPlayer\Server;

use Lifeinthecloud\VideoPlayer\Exception\VideoPlayerException;

/**
 * Class VideoPlayer Server Abstract
 *
 * @author      GrÃ©gory DARCHE <tetardo@gmail.com>
 * @copyright   Copyright (c) 2009 GrÃ©gory DARCHE.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     0.1
 * @package     Lifeinthecloud\VideoPlayer\Server
 * @subpackage  ServerAbstract
 */

abstract class AbstractServer {

    /**
     * __construct
     * Constructeur 
     * 
     * @param   $param   Tableau des parametres
     */
    public function __construct ( $param=null ) {

        if (is_null($param) OR !is_array($param))
            throw new VideoPlayerException('Parameter could be an array.', 1);

        $this->param = self::arrayMergeRecursive($this->param, $param); 

        if (is_null(self::$this->param['url']) OR !is_string(self::$this->param['url']))
            throw new VideoPlayerException('Variable url could be a string.', 2);

        if (is_null(self::getId()) OR !is_string(self::getId()))
            throw new VideoPlayerException('Variable id could be a string.', 3);
 
        self::makeUrl();
    }

    /**
     * __tostring
     * Affichage 
     * 
     * @return   Portion HTML contenant le player
     */
    public function __tostring() {
    
        return $this->param['url'];
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
     * getId
     * Retourne l'id de la vidÃ©o
     * 
     * @return   video id
     */
    public function getId ( ) {

        return $this->param['id'];
    }

    /**
     * getUrl
     * Retourne l'url de la vidÃ©o
     * 
     * @return   video url
     */
    public function getUrl ( ) {

        return $this->param['url'];
    }

    /**
     * makeUrl
     * Recompose l'url complete de la video
     */
    private function makeUrl ( ) {

        $this->param['url'] = $this->param['url'].$this->param['id'];
        
        foreach ($this->param['param'] AS $k => $v) {
            $this->param['url'].= '&'.$k.'='.$v;
        }
    }

    /**
     * array_merge_recursive_distinct
     * Fusionne recursivement deux tableaux en conservant les clÃ©s et valeurs par default
     * 
     * @param   $array1   Tableau par defaut
     * @param   $array2   Tableau Secondaire
     * @return  Tableau fusionnÃ©     
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