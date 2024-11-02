<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Model;

use Hryvinskyi\EmailLogger\Api\Data\LogInterface;
use Hryvinskyi\EmailLogger\Model\ResourceModel\Log as LogResource;
use Magento\Framework\Model\AbstractModel;

/**
 * @method LogResource getResource()
 * @method \Hryvinskyi\EmailLogger\Model\ResourceModel\Log\Collection getCollection()
 * @method \Hryvinskyi\EmailLogger\Model\ResourceModel\Log\Collection getResourceCollection()
 */
class Log extends AbstractModel implements LogInterface
{
    /**
     * @inheritdoc
     */
    protected $_eventPrefix = 'hryvinskyi_email_logger_model_log';

    /**
     * @inheritdoc
     * @noinspection MagicMethodsValidityInspection
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    protected function _construct()
    {
        $this->_init(LogResource::class);
    }

    /**
     * @inheritdoc
     */
    public function getLogEntryId(): ?int
    {
        return $this->_getData(self::LOG_ENTRY_ID) === null ? null :
            (int)$this->_getData(self::LOG_ENTRY_ID);
    }

    /**
     * @inheritdoc
     */
    public function setLogEntryId(int $logEntryId): LogInterface
    {
        $this->setData(self::LOG_ENTRY_ID, $logEntryId);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getEmailSender(): ?string
    {
        return $this->_getData(self::EMAIL_SENDER) === null ? null :
            (string)$this->_getData(self::EMAIL_SENDER);
    }

    /**
     * @inheritdoc
     */
    public function setEmailSender(string $emailSender): LogInterface
    {
        $this->setData(self::EMAIL_SENDER, $emailSender);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getEmailRecipient(): ?string
    {
        return $this->_getData(self::EMAIL_RECIPIENT) === null ? null :
            (string)$this->_getData(self::EMAIL_RECIPIENT);
    }

    /**
     * @inheritdoc
     */
    public function setEmailRecipient(string $emailRecipient): LogInterface
    {
        $this->setData(self::EMAIL_RECIPIENT, $emailRecipient);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getEmailBcc(): ?string
    {
        return $this->_getData(self::EMAIL_BCC) === null ? null :
            (string)$this->_getData(self::EMAIL_BCC);
    }

    /**
     * @inheritdoc
     */
    public function setEmailBcc(string $emailBcc): LogInterface
    {
        $this->setData(self::EMAIL_BCC, $emailBcc);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getEmailCc(): ?string
    {
        return $this->_getData(self::EMAIL_CC) === null ? null :
            (string)$this->_getData(self::EMAIL_CC);
    }

    /**
     * @inheritdoc
     */
    public function setEmailCc(string $emailCc): LogInterface
    {
        $this->setData(self::EMAIL_CC, $emailCc);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getEmailSubject(): ?string
    {
        return $this->_getData(self::EMAIL_SUBJECT) === null ? null :
            (string)$this->_getData(self::EMAIL_SUBJECT);
    }

    /**
     * @inheritdoc
     */
    public function setEmailSubject(string $emailSubject): LogInterface
    {
        $this->setData(self::EMAIL_SUBJECT, $emailSubject);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getEmailContent(): ?string
    {
        return $this->_getData(self::EMAIL_CONTENT) === null ? null :
            (string)$this->_getData(self::EMAIL_CONTENT);
    }

    /**
     * @inheritdoc
     */
    public function setEmailContent(string $emailContent): LogInterface
    {
        $this->setData(self::EMAIL_CONTENT, $emailContent);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getStoreId(): ?int
    {
        return $this->_getData(self::STORE_ID) === null ? null :
            (int)$this->_getData(self::STORE_ID);
    }

    /**
     * @inheritdoc
     */
    public function setStoreId(int $storeId): LogInterface
    {
        $this->setData(self::STORE_ID, $storeId);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSendingStatus(): ?string
    {
        return $this->_getData(self::SENDING_STATUS) === null ? null :
            (string)$this->_getData(self::SENDING_STATUS);
    }

    /**
     * @inheritdoc
     */
    public function setSendingStatus(string $sendingStatus): LogInterface
    {
        $this->setData(self::SENDING_STATUS, $sendingStatus);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSendingMessage(): ?string
    {
        return $this->_getData(self::SENDING_MESSAGE) === null ? null :
            (string)$this->_getData(self::SENDING_MESSAGE);
    }

    /**
     * @inheritdoc
     */
    public function setSendingMessage(string $sendingMessage): LogInterface
    {
        $this->setData(self::SENDING_MESSAGE, $sendingMessage);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getTimeOfSendingMail(): ?string
    {
        return $this->_getData(self::TIME_OF_SENDING_MAIL) === null ? null :
            (string)$this->_getData(self::TIME_OF_SENDING_MAIL);
    }

    /**
     * @inheritdoc
     */
    public function setTimeOfSendingMail(string $timeOfSendingMail): LogInterface
    {
        $this->setData(self::TIME_OF_SENDING_MAIL, $timeOfSendingMail);

        return $this;
    }
}
