<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Model\ResourceModel\Log;

use Hryvinskyi\EmailLogger\Model\ResourceModel\Log as LogResource;
use Hryvinskyi\EmailLogger\Model\Log as LogModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * @method LogResource getResource()
 * @method LogModel[] getItems()
 * @method LogModel[] getItemsByColumnValue($column, $value)
 * @method LogModel getFirstItem()
 * @method LogModel getLastItem()
 * @method LogModel getItemByColumnValue($column, $value)
 * @method LogModel getItemById($idValue)
 * @method LogModel getNewEmptyItem()
 * @method LogModel fetchItem()
 * @property LogModel[] _items
 * @property LogResource _resource
 */
class Collection extends AbstractCollection
{
    /**
     * @inheritdoc
     */
    protected $_eventPrefix = 'hryvinskyi_email_logger_log_collection';

    /**
     * @inheritdoc
     */
    protected $_eventObject = 'log_collection';

    /**
     * @inheritdoc
     * @noinspection MagicMethodsValidityInspection
     * @noinspection ReturnTypeCanBeDeclaredInspection
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _construct()
    {
        $this->_init(LogModel::class, LogResource::class);
        $this->_setIdFieldName($this->getResource()->getIdFieldName());
    }
}
