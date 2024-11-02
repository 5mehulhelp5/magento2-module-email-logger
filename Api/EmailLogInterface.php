<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Api;

use Hryvinskyi\EmailLogger\Api\EmailLog\Status;
use Laminas\Mail\Message;

interface EmailLogInterface
{
    /**
     * Logs email details into the storage.
     *
     * @param Message $emailMessage The email message object to be logged.
     * @param int $storeId The store ID.
     * @param Status $emailStatus The status of the email (sent or failed).
     * @param string $sendingMessage Optional description for the email status.
     *
     * @return void
     */
    public function logEmail(Message $emailMessage, int $storeId, Status $emailStatus, string $sendingMessage = ''): void;
}