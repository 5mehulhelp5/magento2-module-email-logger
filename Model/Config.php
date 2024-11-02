<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Model;

use Hryvinskyi\EmailLogger\Api\ConfigInterface;

class Config implements ConfigInterface
{
    public const XML_PATH_EMAIL_LOGGING_ENABLED = 'system/email_logger/enabled';
    public const XML_PATH_LOGGING_ERRORS_ENABLED = 'system/email_logger/logging_errors';
    public const XML_PATH_SAVE_EMAIL_CONTENT_ENABLED = 'system/email_logger/save_email_content';
    public const XML_PATH_EMAIL_LOG_TTL = 'system/email_logger/email_log_ttl';

    public function isEmailLoggingEnabled(int|string|null $store = null): bool
    {
        return true;

    }

    public function isLoggingErrorsEnabled(int|string|null $store = null): bool
    {
        return true;

    }

    public function isSaveEmailContentEnabled(int|string|null $store = null): bool
    {
        return true;
    }

    public function getEmailLogTtl(int|string|null $store = null): int
    {
        return 90;
    }
}
