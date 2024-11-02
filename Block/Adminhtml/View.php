<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Block\Adminhtml;

use Hryvinskyi\EmailLogger\Api\ConfigInterface;
use Hryvinskyi\EmailLogger\Api\Data\LogInterface;
use Magento\Backend\Block\Widget\Container;
use Magento\Backend\Block\Widget\ContainerInterface;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\App\Request\DataPersistorInterface;

class View extends Container implements ContainerInterface
{
    public function __construct(
        Context $context,
        private readonly DataPersistorInterface $dataPersistor,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Retrieve log
     *
     * @return LogInterface
     */
    public function getLog(): LogInterface
    {
        return $this->dataPersistor->get('email_log');
    }
}