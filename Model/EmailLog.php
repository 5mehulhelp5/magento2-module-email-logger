<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Model;

use Hryvinskyi\EmailLogger\Api\Data\LogInterface;
use Hryvinskyi\EmailLogger\Api\Data\LogInterfaceFactory;
use Hryvinskyi\EmailLogger\Api\EmailLog\Status;
use Hryvinskyi\EmailLogger\Api\EmailLogInterface;
use Hryvinskyi\EmailLogger\Api\LogHandlerInterface;
use Hryvinskyi\EmailLogger\Api\LogRepositoryInterface;
use Laminas\Mail\AddressList;
use Laminas\Mail\Message;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotSaveException;

class EmailLog implements EmailLogInterface
{
    /**
     * EmailLog constructor.
     *
     * @param LogHandlerInterface[] $logHandlers List of handlers for extended logging.
     */
    public function __construct(
        private readonly DataObjectHelper $dataObjectHelper,
        private readonly LogInterfaceFactory $entityFactory,
        private readonly LogRepositoryInterface $logRepository,
        private array $logHandlers = []
    ) {
        foreach ($this->logHandlers as $handler) {
            if (!$handler instanceof LogHandlerInterface) {
                throw new \InvalidArgumentException('Invalid log handler provided.');
            }
        }
    }

    /**
     * Logs email details into the database.
     *
     * @param Message $emailMessage The email message object to be logged.
     * @param int $storeId The store ID where the email is being sent from.
     * @param Status $emailStatus The status of the email (sent or failed).
     * @param string $sendingMessage Optional description or message regarding the sending status.
     *
     * @return void
     * @throws CouldNotSaveException
     */
    public function logEmail(
        Message $emailMessage,
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
            'email_content' => $emailMessage->getBodyText(),
            'store_id' => $storeId,
            'sending_status' => $emailStatus->value,
            'sending_message' => $sendingMessage,
        ];

        $entity = $this->entityFactory->create();

        // Populate the log entity with the email data.
        $this->dataObjectHelper->populateWithArray(
            $entity,
            $logData,
            LogInterface::class
        );

        // Invoke additional handlers for extended logging if available.
        foreach ($this->logHandlers as $handler) {
            $handler->handle($logData, $emailMessage, $entity);
        }

        // Log the email data to the database.
        $this->logRepository->save($entity);
    }

    /**
     * Converts the email address list into a string.
     *
     * @param AddressList $addressList The email address list to be converted.
     *
     * @return string
     */
    private function getEmailsString(AddressList $addressList): string
    {
        $emails = [];
        foreach ($addressList as $address) {
            $emails[] = ($address->getName() ? $address->getName() . ' ' : '') . '<' . $address->getEmail() . '>';
        }

        return implode(", ", $emails);
    }
}
