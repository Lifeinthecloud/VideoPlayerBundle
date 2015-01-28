<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace LITC\VideoPlayerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class VideoPlayer Player Flash
 *
 * @author      Antoine DARCHE <darche.antoine@gmail.com>
 * @copyright   Copyright (c) 2015 Lifeinthecloud.
 * @link        https://github.com/Lifeinthecloud/VideoPlayerBundle
 * @license     MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @since       PHP 5.3
 * @version     1.0
 * @package     LITC\VideoPlayerBundle
 * @subpackage  Player
 */
class CreateVideoCommand extends ContainerAwareCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('litc:video:create')
            ->setDescription('Create a video.')
            ->setDefinition(array(
                new InputArgument('server', InputArgument::REQUIRED, 'The server (Youtube, Vimeo, Dailymotion)'),
                new InputArgument('videoId', InputArgument::REQUIRED, 'The video id'),
                new InputArgument('title', InputArgument::REQUIRED, 'The title'),
            ))
            ->setHelp(<<<EOT
The <info>litc:video:create</info> command creates a video:

  <info>php app/console litc:video:create Youtube</info>

This interactive shell will ask you for an video id.

You can alternatively specify the video id as the second:

  <info>php app/console litc:video:create Youtube K69A1lL1PHQ</info>

EOT
            );
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $title      = $input->getArgument('title');
        $server     = $input->getArgument('server');
        $videoId    = $input->getArgument('videoId');

        $manipulator = $this->getContainer()->get('litc_video_player.util.video_manipulator');
        $manipulator->create($title, $server, $videoId);

        $output->writeln(sprintf('Created video <comment>%s</comment>', $title));
    }

    /**
     * @see Command
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getArgument('title')) {
            $title = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a title:',
                function($title) {
                    if (empty($title)) {
                        throw new \Exception('Title can not be empty');
                    }

                    return $title;
                }
            );
            $input->setArgument('title', $title);
        }

        if (!$input->getArgument('server')) {
            $server = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose an server:',
                function($server) {
                    if (empty($server)) {
                        throw new \Exception('Server can not be empty');
                    }

                    return $server;
                }
            );
            $input->setArgument('server', $server);
        }

        if (!$input->getArgument('videoId')) {
            $videoId = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a video id:',
                function($videoId) {
                    if (empty($videoId)) {
                        throw new \Exception('Video id can not be empty');
                    }

                    return $videoId;
                }
            );
            $input->setArgument('videoId', $videoId);
        }
    }
}
