<?php

declare(strict_types=1);

namespace App\Command;

use App\Messenger\Message\CreateUserMessage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Uid\Uuid;

class SendMessageCommand extends Command
{
    public function __construct(
        private readonly MessageBusInterface $messageBus
    )
    {
        parent::__construct();
    }

    public function configure(): void
    {
        $this
            ->setName('app:send:message')
            ->setDescription('Sends a message to RabbitMQ');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $message = new CreateUserMessage(Uuid::v4()->toRfc4122(), 'Juan');

        for ($i = 0; $i <2; $i++) {
            $this->messageBus->dispatch($message);
        }

        return Command::SUCCESS;
    }
}
