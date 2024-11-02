<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Api;

use Hryvinskyi\EmailLogger\Api\Data\LogInterface;
use Laminas\Mail\Message;

interface LogHandlerInterface
{
    /**
     * Handle the log data for extended processing.
     *
     * @param array $logData The log data to be processed.
     * @param Message $message The email message object.
     * @param LogInterface $entity The log entity object.
     * @return void
     */
    public function handle(array &$logData, Message $message, LogInterface $entity): void;
}