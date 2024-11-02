<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Plugin;

use Hryvinskyi\EmailLogger\Api\ConfigInterface;
use Hryvinskyi\EmailLogger\Api\EmailLog\Status;
use Hryvinskyi\EmailLogger\Api\EmailLogInterface;
use Laminas\Mail\Message;
use Magento\Framework\Mail\TransportInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class EmailLogging
{
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
     *
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

        // Note: If the module is active while sending an email, it will log the action.
        $message = Message::fromString($subject->getMessage()->getRawMessage())->setEncoding('utf-8');

        try {
            $proceed();
            $this->emailLog->logEmail($message, $storeId, Status::SENT);
        } catch (\Throwable $e) {
            $this->logger->critical($e->getMessage() . "\n" . $e->getTraceAsString());
            $this->emailLog->logEmail($message, $storeId, Status::FAILED, $e->getMessage());

            throw $e;
        }
    }
}