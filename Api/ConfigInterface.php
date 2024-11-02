<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Api;

interface ConfigInterface
{
    /**
     * Checks if the email logging is enabled.
     *
     * @param string|int|null $store The store ID or code.
     * @return bool
     */
    public function isEmailLoggingEnabled(string|int|null $store = null): bool;

    /**
     * Checks if logging errors is enabled.
     *
     * @param string|int|null $store The store ID or code.
     * @return bool
     */
    public function isLoggingErrorsEnabled(string|int|null $store = null): bool;

    /**
     * Checks if the email content saving is enabled.
     *
     * @param string|int|null $store The store ID or code.
     * @return bool
     */
    public function isSaveEmailContentEnabled(string|int|null $store = null): bool;

    /**
     * Returns the time to live for sent email logs in days.
     *
     * @param string|int|null $store The store ID or code.
     * @return int
     */
    public function getEmailLogSentTtl(string|int|null $store = null): int;

    /**
     * Returns the time to live for failed email logs in days.
     *
     * @param string|int|null $store The store ID or code.
     * @return int
     */
    public function getEmailLogFailedTtl(string|int|null $store = null): int;
}