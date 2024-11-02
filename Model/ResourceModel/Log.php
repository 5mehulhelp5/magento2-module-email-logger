<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Model\ResourceModel;

use Hryvinskyi\EmailLogger\Api\Data\LogInterface;
use Hryvinskyi\EmailLogger\Api\EmailLog\Status;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

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

    /**
     * @param int $days
     * @param Status $status
     * @return void
     * @throws LocalizedException
     */
    public function clear(int $days, Status $status): void
    {
        if ($days <= 0) {
            return;
        }

        $date = date('Y-m-d h:i:s', strtotime('-' . $days . 'days'));

        $this->getConnection()->delete(
            $this->getMainTable(),
            [
                LogInterface::TIME_OF_SENDING_MAIL . ' <= ?' => $date,
                LogInterface::SENDING_STATUS . ' = ?' => $status->value
            ]
        );
    }
}
