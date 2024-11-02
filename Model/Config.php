<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Model;

use Hryvinskyi\EmailLogger\Api\ConfigInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config implements ConfigInterface
{
    public const XML_PATH_EMAIL_LOGGING_ENABLED = 'system/hryvinskyi_email_log/email_logging_enabled';
    public const XML_PATH_LOGGING_ERRORS_ENABLED = 'system/hryvinskyi_email_log/logging_errors_enabled';
    public const XML_PATH_SAVE_EMAIL_CONTENT_ENABLED = 'system/hryvinskyi_email_log/save_email_content_enabled';
    public const XML_PATH_EMAIL_LOG_SENT_TTL = 'system/hryvinskyi_email_log/email_log_sent_ttl';
    public const XML_PATH_EMAIL_LOG_FAILED_TTL = 'system/hryvinskyi_email_log/email_log_failed_ttl';

    public function __construct(private readonly ScopeConfigInterface $scopeConfig)
    {
    }

    /**
     * @inheirtDoc
     */
    public function isEmailLoggingEnabled(int|string|null $store = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_EMAIL_LOGGING_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * @inheirtDoc
     */
    public function isLoggingErrorsEnabled(int|string|null $store = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_LOGGING_ERRORS_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * @inheirtDoc
     */
    public function isSaveEmailContentEnabled(int|string|null $store = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_SAVE_EMAIL_CONTENT_ENABLED,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * @inheirtDoc
     */
    public function getEmailLogSentTtl(int|string|null $store = null): int
    {
        return (int)$this->scopeConfig->getValue(
            self::XML_PATH_EMAIL_LOG_SENT_TTL,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }

    /**
     * @inheirtDoc
     */
    public function getEmailLogFailedTtl(int|string|null $store = null): int
    {
        return (int)$this->scopeConfig->getValue(
            self::XML_PATH_EMAIL_LOG_FAILED_TTL,
            ScopeInterface::SCOPE_STORE,
            $store
        );
    }
}
