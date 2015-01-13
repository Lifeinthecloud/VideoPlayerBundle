<?php

namespace Lifeinthecloud\VideoPlayerBundle\Parser;

use Lifeinthecloud\VideoPlayerBundle\Exception\VideoPlayerException;

/**
 * Class ParserAbstract
 *
 * @author      Antoine DARCHE <darche.antoine@gmail.com> & Grégory DARCHE <tetardo@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     1.0
 * @package     Lifeinthecloud\VideoPlayer\Parser
 * @subpackage  ParserAbstract
 */
abstract class AbstractParser {

    /**
     * Url de la vidéo
     *
     * @var   string
     */
    public $url = null;

    /**
     * Id de la vidéo
     *
     * @var   string
     */
    public $id = null;

    /**
     * __tostring
     * Retourne l'id de la vidéo
     *
     * @return   Id vidéo
     */
    abstract public function parser();

    /**
     * __construct
     * Constructeur
     *
     * @param   $url    Url a parser
     */
    public function __construct ( $url=null ) {

        if (is_null($url) OR !is_string($url))
            throw new VideoPlayerException('Url could be a string.', 1);

        $this->url = $url;

        $this->parser();
    }

    /**
     * __tostring
     * Affichage
     *
     * @return   Id vidéo
     */
    public function __tostring ( ) {

        return $this->id;;
    }

    /**
     * getParser
     * Retourne le nom du parser
     *
     * @return   nom du player
     */
    public function getParser ( ) {

        return $this->parser;
    }

}