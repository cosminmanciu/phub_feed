<?php

// src/Command/CreateUserCommand.php
namespace App\Command;


use App\Service\ImageImportServiceInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:feed-import')]
class ImportCommand extends Command
{
    /**
     * @var ImageImportServiceInterface
     */
    public ImageImportServiceInterface $importService;

    /**
     * @param ImageImportServiceInterface $importService
     */
    public function __construct(ImageImportServiceInterface $importService)
    {
        $this->importService =  $importService;
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        echo('Starting import command ---->------> : ');
        $this->importService->import('https://www.pornhub.com/files/json_feed_pornstars.json');
        return Command::SUCCESS;


    }
}