<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface LogSearchResultsInterface
 */
interface LogSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get Log list.
     *
     * @return \Hryvinskyi\EmailLogger\Api\Data\LogInterface[]
     */
    public function getItems(): array;

    /**
     * Set Log list.
     *
     * @param \Hryvinskyi\EmailLogger\Api\Data\LogInterface[] $items
     *
     * @return $this
     */
    public function setItems(?array $items = null): LogSearchResultsInterface;
}
