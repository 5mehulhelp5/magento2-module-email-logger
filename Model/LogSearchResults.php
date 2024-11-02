<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Model;

use Magento\Framework\Api\Search\SearchResult;
use Hryvinskyi\EmailLogger\Api\Data\LogSearchResultsInterface;

/**
 * Class LogSearchResults
 */
class LogSearchResults extends SearchResult implements LogSearchResultsInterface
{
    /**
     * @inheritdoc
     */
    public function getItems(): array
    {
        return parent::getItems() ?? [];
    }

    /**
     * @inheritdoc
     */
    public function setItems(?array $items = null): LogSearchResultsInterface
    {
        $this->setData(self::ITEMS, $items);

        return $this;
    }
}
