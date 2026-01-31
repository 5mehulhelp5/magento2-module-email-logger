<?php
/**
 * Copyright (c) 2024-2026. Volodymyr Hryvinskyi. All rights reserved.
 * Author: Volodymyr Hryvinskyi <volodymyr@hryvinskyi.com>
 * GitHub: https://github.com/hryvinskyi
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Api;

use Hryvinskyi\EmailLogger\Api\EmailLog\Status;
use Magento\Framework\Mail\EmailMessageInterface;

interface EmailLogInterface
{
    /**
     * Logs email details into the storage.
     *
     * @param EmailMessageInterface $emailMessage The email message object to be logged.
     * @param int $storeId The store ID.
     * @param Status $emailStatus The status of the email (sent or failed).
     * @param string $sendingMessage Optional description for the email status.
     *
     * @return void
     */
    public function logEmail(EmailMessageInterface $emailMessage, int $storeId, Status $emailStatus, string $sendingMessage = ''): void;
}