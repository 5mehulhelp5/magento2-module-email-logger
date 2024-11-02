<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Api;

use Hryvinskyi\EmailLogger\Api\EmailLog\Status;
use Magento\Framework\Api\SearchCriteriaInterface;
use Hryvinskyi\EmailLogger\Api\Data\LogInterface;
use Hryvinskyi\EmailLogger\Api\Data\LogSearchResultsInterface;

/**
 * Interface LogRepositoryInterface
 */
interface LogRepositoryInterface
{
    /**
     * Save Log
     *
     * @param \Hryvinskyi\EmailLogger\Api\Data\LogInterface $log
     *
     * @return \Hryvinskyi\EmailLogger\Api\Data\LogInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(LogInterface $log): LogInterface;

    /**
     * Get Log by id.
     *
     * @param int $logId
     *
     * @return \Hryvinskyi\EmailLogger\Api\Data\LogInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $logId): LogInterface;

    /**
     * Find Log by id.
     *
     * @param int $logId
     *
     * @return \Hryvinskyi\EmailLogger\Api\Data\LogInterface|null
     */
    public function findById(int $logId): ?LogInterface;

    /**
     * Retrieve Log matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return \Hryvinskyi\EmailLogger\Api\Data\LogSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): LogSearchResultsInterface;

    /**
     * Delete Log
     *
     * @param \Hryvinskyi\EmailLogger\Api\Data\LogInterface $log
     *
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(LogInterface $log): bool;

    /**
     * Delete Log by ID.
     *
     * @param int $logId
     *
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById(int $logId): bool;

    /**
     * Clear logs
     *
     * @param int $days
     * @param Status $status
     *
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function clear(int $days, Status $status): void;
}
