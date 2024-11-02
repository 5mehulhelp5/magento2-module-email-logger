<?php
/**
 * Copyright (c) 2021. MageCloud. All rights reserved.
 * @author: Volodymyr Hryvinskyi <volodymyr@hryvinskyi.com>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Model;

use Hryvinskyi\EmailLogger\Api\Data\LogInterface;
use Hryvinskyi\EmailLogger\Api\Data\LogInterfaceFactory;
use Hryvinskyi\EmailLogger\Api\Data\LogSearchResultsInterface;
use Hryvinskyi\EmailLogger\Api\Data\LogSearchResultsInterfaceFactory;
use Hryvinskyi\EmailLogger\Api\EmailLog\Status;
use Hryvinskyi\EmailLogger\Api\LogRepositoryInterface;
use Hryvinskyi\EmailLogger\Model\ResourceModel\Log as LogResource;
use Hryvinskyi\EmailLogger\Model\ResourceModel\Log\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class LogRepository
 */
class LogRepository implements LogRepositoryInterface
{
    public function __construct(
        private readonly LogResource $resource,
        private readonly LogInterfaceFactory $entityFactory,
        private readonly CollectionFactory $collectionFactory,
        private readonly LogSearchResultsInterfaceFactory $searchResultFactory,
        private readonly CollectionProcessorInterface $collectionProcessor
    ) {
    }

    /**
     * @inheritdoc
     */
    public function save(LogInterface $log): LogInterface
    {
        try {
            $this->resource->save($log);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $log;
    }

    /**
     * @inheritdoc
     */
    public function getById(int $logId): LogInterface
    {
        $log = $this->entityFactory->create();
        $this->resource->load($log, $logId);
        if (!$log->getId()) {
            throw new NoSuchEntityException(__('Log with id "%1" does not exist.', $logId));
        }

        return $log;
    }

    /**
     * @inheritdoc
     */
    public function findById(int $logId): ?LogInterface
    {
        $log = $this->entityFactory->create();
        $this->resource->load($log, $logId);

        if (!$log->getId()) {
            return null;
        }

        return $log;
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): LogSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        return $this->searchResultFactory
            ->create()
            ->setSearchCriteria($searchCriteria)
            ->setItems($collection->getItems())
            ->setTotalCount($collection->getSize());
    }

    /**
     * @inheritdoc
     */
    public function delete(LogInterface $log): bool
    {
        try {
            $this->resource->delete($log);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById(int $logId): bool
    {
        return $this->delete($this->getById($logId));
    }


    /**
     * @inheritdoc
     */
    public function clear(int $days, Status $status): void
    {
        $this->resource->clear($days, $status);
    }
}
