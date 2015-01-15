<?php

namespace Lifeinthecloud\VideoPlayerBundle\Parser;

use Lifeinthecloud\VideoPlayerBundle\Parser\AbstractParser;
use Lifeinthecloud\VideoPlayerBundle\Exception\VideoPlayerException;

/**
 * Class Vimeo
 *
 * @author Antoine DARCHE <antoine.darche@gmail.com>
 * @author Grégory DARCHE <tetardo@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     1.0
 * @package     Lifeinthecloud\VideoPlayer\Parser
 * @subpackage  ParserAbstract
 */
class VimeoParser extends AbstractParser {

    /**
     * Nom du parser
     *
     * @var   string
     */
    public $parser = 'Vimeo';

    /**
     * parser
     * Extrait l'id vidéo d'une url 
     * 
     * @return   Id vidéo
     */
    public function parser() {

        $pattern = '|http:\/\/[a-z]*?[\.]?vimeo\.com\/(.*)|i';

        if (!preg_match_all($pattern, $this->url, $matches, PREG_SET_ORDER))
            throw new VideoPlayerException('video id not found.', 1);

        $this->id = $matches[0][1];
        
        if (!$this->id)
            throw new VideoPlayerException('video id not found.', 2);

        return ''.$this->id;
    }

}