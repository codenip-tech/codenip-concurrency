<?php

declare(strict_types=1);

namespace App\Messenger\Handler;

use App\Messenger\Message\CreateUserMessage;
use App\Service\RedisService;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use function sprintf;

#[AsMessageHandler]
class CreateUserMessageHandler
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly RedisService $redisService
    ) {
    }

    public function __invoke(CreateUserMessage $message): void
    {
        if (true === $this->redisService->storeIfNotExists($message->id, $message->name)) {
            $this->logger->info(
                sprintf(
                    '[CreateUserMessageHandler] Message has been processed. ID <%s>, NAME: <%s>',
                    $message->id,
                    $message->name
                )
            );
        }
    }
}
