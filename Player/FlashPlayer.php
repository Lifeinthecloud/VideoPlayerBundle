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
 * Class VideoPlayer Player Flash
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
class FlashPlayer extends AbstractPlayer {

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