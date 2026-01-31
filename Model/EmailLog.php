<?php
/**
 * Copyright (c) 2024-2026. Volodymyr Hryvinskyi. All rights reserved.
 * Author: Volodymyr Hryvinskyi <volodymyr@hryvinskyi.com>
 * GitHub: https://github.com/hryvinskyi
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Model;

use Hryvinskyi\EmailLogger\Api\ConfigInterface;
use Hryvinskyi\EmailLogger\Api\Data\LogInterface;
use Hryvinskyi\EmailLogger\Api\Data\LogInterfaceFactory;
use Hryvinskyi\EmailLogger\Api\EmailLog\Status;
use Hryvinskyi\EmailLogger\Api\EmailLogInterface;
use Hryvinskyi\EmailLogger\Api\LogHandlerInterface;
use Hryvinskyi\EmailLogger\Api\LogRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Mail\Address;
use Magento\Framework\Mail\EmailMessageInterface;

class EmailLog implements EmailLogInterface
{
    /**
     * EmailLog constructor.
     *
     * @param DataObjectHelper $dataObjectHelper
     * @param LogInterfaceFactory $entityFactory
     * @param LogRepositoryInterface $logRepository
     * @param ConfigInterface $config
     * @param LogHandlerInterface[] $logHandlers List of handlers for extended logging.
     */
    public function __construct(
        private readonly DataObjectHelper $dataObjectHelper,
        private readonly LogInterfaceFactory $entityFactory,
        private readonly LogRepositoryInterface $logRepository,
        private readonly ConfigInterface $config,
        private array $logHandlers = []
    ) {
        foreach ($this->logHandlers as $handler) {
            if (!$handler instanceof LogHandlerInterface) {
                throw new \InvalidArgumentException('Invalid log handler provided.');
            }
        }
    }

    /**
     * {@inheritDoc}
     *
     * @throws CouldNotSaveException
     */
    public function logEmail(
        EmailMessageInterface $emailMessage,
        int $storeId,
        Status $emailStatus,
        string $sendingMessage = ''
    ): void {
        $logData = [
            'email_sender' => $this->getEmailsString($emailMessage->getFrom()),
            'email_recipient' => $this->getEmailsString($emailMessage->getTo()),
            'email_bcc' => $this->getEmailsString($emailMessage->getBcc()),
            'email_cc' => $this->getEmailsString($emailMessage->getCc()),
            'email_subject' => $emailMessage->getSubject(),
            'store_id' => $storeId,
            'sending_status' => $emailStatus->value,
        ];

        if ($this->config->isSaveEmailContentEnabled()) {
            $logData['email_content'] = $emailMessage->getBodyText();
        }

        if ($this->config->isLoggingErrorsEnabled()) {
            $logData['sending_message'] = $sendingMessage;
        }

        $entity = $this->entityFactory->create();

        $this->dataObjectHelper->populateWithArray(
            $entity,
            $logData,
            LogInterface::class
        );

        foreach ($this->logHandlers as $handler) {
            $handler->handle($logData, $emailMessage, $entity);
        }

        $this->logRepository->save($entity);
    }

    /**
     * Converts the email address array into a formatted string.
     *
     * @param Address[]|null $addresses The email address array to be converted.
     *
     * @return string
     */
    private function getEmailsString(?array $addresses): string
    {
        if ($addresses === null) {
            return '';
        }

        $emails = [];
        foreach ($addresses as $address) {
            $name = $address->getName();
            $email = $address->getEmail();
            $emails[] = ($name ? $name . ' ' : '') . '<' . $email . '>';
        }

        return implode(', ', $emails);
    }
}
