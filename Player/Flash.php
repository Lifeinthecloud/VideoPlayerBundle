<?php

namespace Lifeinthecloud\VideoPlayer\Player;

/**
 * Class VideoPlayer Player Flash
 *
 * @author      Antoine DARCHE <darche.antoine@gmail.com> & Grégory DARCHE <tetardo@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @license     http://gnu.org/licenses/gpl.txt GNU GPL
 * @since       PHP 5
 * @version     1.0
 * @package     Hoa_VideoPlayer
 * @subpackage  Hoa_VideoPlayer_Player_Flash
 */

class Hoa_VideoPlayer_Player_Flash extends Hoa_VideoPlayer_Player_Abstract {

    /**
     * Nom du player
     *
     * @var   string
     */
    public $player = 'Flash';

    /**
     * Tableau des parametres par defaut
     *
     * @var   array
     */
    public $param = array(
        'url' => null,
        'width' => 560,
        'height' => 340,
        'param' => array(
            'allowFullScreen' => 'true',
            'allowscriptaccess' => 'always'
        )
    );

    public function __tostring ( ) {

        $html = '
        <object width="'.$this->param['width'].'" height="'.$this->param['height'].'">
            <param name="movie" value="'.$this->param['url'].'" />';

            foreach ($this->param['param'] AS $k => $v) {
            $html.= '
            <param name="'.$k.'" value="'.$v.'" />';
            }


            $html.= '
            <embed type="application/x-shockwave-flash"
                src="'.$this->param['url'].'" ';
            foreach ($this->param['param'] AS $k => $v) {
            $html.= '
                name="'.$k.'" value="'.$v.'"';
            }
            $html.= '
                width="'.$this->param['width'].'"
                height="'.$this->param['height'].'" />
        </object>';

        return $html;
    }

}