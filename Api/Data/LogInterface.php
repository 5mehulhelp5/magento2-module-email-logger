<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Api\Data;

interface LogInterface
{
    /**#@+
     * Constants for keys of data array.
     */
    public const LOG_ENTRY_ID = 'log_entry_id';
    public const EMAIL_SENDER = 'email_sender';
    public const EMAIL_RECIPIENT = 'email_recipient';
    public const EMAIL_BCC = 'email_bcc';
    public const EMAIL_CC = 'email_cc';
    public const EMAIL_SUBJECT = 'email_subject';
    public const EMAIL_CONTENT = 'email_content';
    public const STORE_ID = 'store_id';
    public const SENDING_STATUS = 'sending_status';
    public const SENDING_MESSAGE = 'sending_message';
    public const TIME_OF_SENDING_MAIL = 'time_of_sending_mail';
    /**#@-*/

    /**
     * Retrieve the log entry ID.
     *
     * @return int|null
     */
    public function getLogEntryId(): ?int;

    /**
     * Set the log entry ID.
     *
     * @param int $logEntryId
     * @return $this
     */
    public function setLogEntryId(int $logEntryId): LogInterface;

    /**
     * Retrieve the email sender.
     *
     * @return string|null
     */
    public function getEmailSender(): ?string;

    /**
     * Set the email sender.
     *
     * @param string $emailSender
     * @return $this
     */
    public function setEmailSender(string $emailSender): LogInterface;

    /**
     * Retrieve the email recipient.
     *
     * @return string|null
     */
    public function getEmailRecipient(): ?string;

    /**
     * Set the email recipient.
     *
     * @param string $emailRecipient
     * @return $this
     */
    public function setEmailRecipient(string $emailRecipient): LogInterface;

    /**
     * Retrieve the BCC recipients of the email.
     *
     * @return string|null
     */
    public function getEmailBcc(): ?string;

    /**
     * Set the BCC recipients of the email.
     *
     * @param string $emailBcc
     * @return $this
     */
    public function setEmailBcc(string $emailBcc): LogInterface;

    /**
     * Retrieve the CC recipients of the email.
     *
     * @return string|null
     */
    public function getEmailCc(): ?string;

    /**
     * Set the CC recipients of the email.
     *
     * @param string $emailCc
     * @return $this
     */
    public function setEmailCc(string $emailCc): LogInterface;

    /**
     * Retrieve the email subject.
     *
     * @return string|null
     */
    public function getEmailSubject(): ?string;

    /**
     * Set the email subject.
     *
     * @param string $emailSubject
     * @return $this
     */
    public function setEmailSubject(string $emailSubject): LogInterface;

    /**
     * Retrieve the email content.
     *
     * @return string|null
     */
    public function getEmailContent(): ?string;

    /**
     * Set the email content.
     *
     * @param string $emailContent
     * @return $this
     */
    public function setEmailContent(string $emailContent): LogInterface;

    /**
     * Retrieve the store ID.
     *
     * @return int|null
     */
    public function getStoreId(): ?int;

    /**
     * Set the store ID.
     *
     * @param int $storeId
     * @return $this
     */
    public function setStoreId(int $storeId): LogInterface;

    /**
     * Retrieve the sending status of the email.
     *
     * @return string|null
     */
    public function getSendingStatus(): ?string;

    /**
     * Set the sending status of the email.
     *
     * @param string $sendingStatus
     * @return $this
     */
    public function setSendingStatus(string $sendingStatus): LogInterface;

    /**
     * Retrieve the sending message details.
     *
     * @return string|null
     */
    public function getSendingMessage(): ?string;

    /**
     * Set the sending message details.
     *
     * @param string $sendingMessage
     * @return $this
     */
    public function setSendingMessage(string $sendingMessage): LogInterface;

    /**
     * Retrieve the time of sending the email.
     *
     * @return string|null
     */
    public function getTimeOfSendingMail(): ?string;

    /**
     * Set the time of sending the email.
     *
     * @param string $timeOfSendingMail
     * @return $this
     */
    public function setTimeOfSendingMail(string $timeOfSendingMail): LogInterface;
}
