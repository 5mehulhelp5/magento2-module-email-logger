<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Cron;

use Hryvinskyi\EmailLogger\Api\ConfigInterface;
use Hryvinskyi\EmailLogger\Api\EmailLog\Status;
use Hryvinskyi\EmailLogger\Api\LogRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class ClearLogs
{
    public function __construct(
        private readonly ConfigInterface $config,
        private readonly LogRepositoryInterface $logRepository,
        private readonly StoreManagerInterface $storeManager,
        private readonly LoggerInterface $logger
    ) {
    }

    /**
     * Clear sent email logs.
     */
    public function execute(): void
    {
        if ($this->config->isEmailLoggingEnabled() === false) {
            return;
        }

        try {
            foreach ($this->storeManager->getStores() as $store) {
                $daysSent = $this->config->getEmailLogSentTtl($store->getId());
                $daysFailed = $this->config->getEmailLogFailedTtl($store->getId());

                $this->logRepository->clear($daysSent, Status::SENT);
                $this->logRepository->clear($daysFailed, Status::FAILED);
            }
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}
