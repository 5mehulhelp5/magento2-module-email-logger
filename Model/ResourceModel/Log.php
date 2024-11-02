<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Log extends AbstractDb
{
    /**
     * @inheritdoc
     * @noinspection MagicMethodsValidityInspection
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    protected function _construct()
    {
        $this->_init('hryvinskyi_email_log', 'log_entry_id');
    }
}
