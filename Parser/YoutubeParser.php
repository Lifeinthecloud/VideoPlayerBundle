<?php

namespace Lifeinthecloud\VideoPlayer\Parser;

use Lifeinthecloud\VideoPlayer\Parser\AbstractParser;
use Lifeinthecloud\VideoPlayer\Exception\VideoPlayerException;

/**
 * Class Youtube
 *
 * @author      Antoine DARCHE <darche.antoine@gmail.com> & Grégory DARCHE <tetardo@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     1.0
 * @package     Lifeinthecloud\VideoPlayer\Parser
 * @subpackage  ParserAbstract
 */
class YoutubeParser extends AbstractParser {

    /**
     * Nom du parser
     *
     * @var   string
     */
    public $parser = 'Youtube';

    /**
     * parser
     * Extrait l'id vidéo d'une url
     * 
     * @return   Id vidéo
     */
    public function parser() {

        $url = parse_url($this->url);
        parse_str($url['query'], $param);
        $this->id = $this->param['v'];
        
        if (!$this->id)
            throw new VideoPlayerException('video id not found.', 1);

        return $this->id;
    }

}