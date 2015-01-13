<?php

namespace Lifeinthecloud\VideoPlayer\Parser;

use Lifeinthecloud\VideoPlayer\Parser\AbstractParser;
use Lifeinthecloud\VideoPlayer\Exception\VideoPlayerException;

/**
 * Class Dailymotion
 *
 * @author      Antoine DARCHE <darche.antoine@gmail.com> & Grégory DARCHE <tetardo@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     1.0
 * @package     Lifeinthecloud\VideoPlayer\Parser
 * @subpackage  ParserAbstract
 */
class DailymotionParser extends AbstractParser {

    /**
     * Nom du parser
     *
     * @var   string
     */
    public $parser = 'Dailymotion';

    /**
     * parser
     * Extrait l'id vidéo d'une url
     * 
     * @return   Id vidéo
     */
    public function parser() {
        
        $matches = array();
        $pattern = '/http:\/\/[a-z]*?[\.]?dailymotion\.com\/[\w\/]*video\/([\w]*)/i';
        if (!preg_match_all($pattern, $this->url, $matches, PREG_SET_ORDER))
            throw new VideoPlayerException('video id not found.', 1);

        $this->id = $matches[0][2];
        
        if (!$this->id)
            throw new VideoPlayerException('video id not found.', 2);

        return $this->id;
    }

}