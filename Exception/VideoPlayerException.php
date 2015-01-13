<?php

namespace Lifeinthecloud\VideoPlayerBundle\Exception;

/**
 * Class Hoa_VideoPlayer_Exception.
 *
 * Extending the Hoa_Exception class.
 *
 * @author      Antoine DARCHE <darche.antoine@gmail.com> & Grégory DARCHE <tetardo@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     1.0
 * @package     Lifeinthecloud\VideoPlayer\Parser
 * @subpackage  ParserAbstract
 */

class VideoPlayerException extends \Exception {

    public function __construct ( $message=null, $code=0, $arg=array() ) {

        parent::__construct($message, $code);
    }

}