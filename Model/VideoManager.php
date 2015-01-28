<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LITC\VideoPlayerBundle\Model;

use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Abstract Video Manager implementation which can be used as base class for your
 * concrete manager.
 * 
 * @author      Antoine DARCHE <antoine.darche@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @link        https://github.com/Lifeinthecloud/VideoPlayerBundle
 * @license     MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @since       PHP 5.3
 * @version     1.0
 * @package     LITC\VideoPlayerBundle
 * @subpackage  Model
 */
abstract class VideoManager implements VideoManagerInterface
{
    protected $encoderFactory;

    /**
     * Constructor.
     *
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * Returns an empty video instance
     *
     * @return VideoInterface
     */
    public function createVideo()
    {
        $class = $this->getClass();
        $video = new $class;

        return $video;
    }
    
    /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return $class === $this->getClass();
    }
}