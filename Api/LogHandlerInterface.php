<?php
/**
 * Copyright (c) 2024-2026. Volodymyr Hryvinskyi. All rights reserved.
 * Author: Volodymyr Hryvinskyi <volodymyr@hryvinskyi.com>
 * GitHub: https://github.com/hryvinskyi
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Api;

use Hryvinskyi\EmailLogger\Api\Data\LogInterface;
use Magento\Framework\Mail\EmailMessageInterface;

interface LogHandlerInterface
{
    /**
     * Handle the log data for extended processing.
     *
     * @param array<string, mixed> $logData The log data to be processed.
     * @param EmailMessageInterface $message The email message object.
     * @param LogInterface $entity The log entity object.
     *
     * @return void
     */
    public function handle(array &$logData, EmailMessageInterface $message, LogInterface $entity): void;
}