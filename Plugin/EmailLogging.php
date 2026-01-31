<?php
/**
 * Copyright (c) 2024-2026. Volodymyr Hryvinskyi. All rights reserved.
 * Author: Volodymyr Hryvinskyi <volodymyr@hryvinskyi.com>
 * GitHub: https://github.com/hryvinskyi
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Plugin;

use Hryvinskyi\EmailLogger\Api\ConfigInterface;
use Hryvinskyi\EmailLogger\Api\EmailLog\Status;
use Hryvinskyi\EmailLogger\Api\EmailLogInterface;
use Magento\Framework\Mail\EmailMessageInterface;
use Magento\Framework\Mail\TransportInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class EmailLogging
{
    /**
     * @param EmailLogInterface $emailLog
     * @param ConfigInterface $config
     * @param StoreManagerInterface $storeManager
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly EmailLogInterface $emailLog,
        private readonly ConfigInterface $config,
        private readonly StoreManagerInterface $storeManager,
        private readonly LoggerInterface $logger
    ) {
    }

    /**
     * Plugin for \Magento\Framework\Mail\TransportInterface::sendMessage to log email sending.
     *
     * @param TransportInterface $subject The transport instance.
     * @param \Closure $proceed The original sendMessage method.
     *
     * @return void
     * @throws \Throwable If the email sending fails.
     */
    public function aroundSendMessage(
        TransportInterface $subject,
        \Closure $proceed
    ): void {
        $storeId = (int)$this->storeManager->getStore()->getId();

        if (false === $this->config->isEmailLoggingEnabled()) {
            $proceed();

            return;
        }

        $message = $subject->getMessage();

        if (!$message instanceof EmailMessageInterface) {
            $proceed();

            return;
        }

        try {
            $proceed();
            $this->emailLog->logEmail($message, $storeId, Status::SENT);
        } catch (\Throwable $e) {
            $this->logger->critical($e->getMessage() . "\n" . $e->getTraceAsString());

            if ($this->config->isLoggingErrorsEnabled()) {
                $this->emailLog->logEmail($message, $storeId, Status::FAILED, $e->getMessage());
            }

            throw $e;
        }
    }
}