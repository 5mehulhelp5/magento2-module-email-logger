<?php
/**
 * Copyright (c) 2024-2026. Volodymyr Hryvinskyi. All rights reserved.
 * Author: Volodymyr Hryvinskyi <volodymyr@hryvinskyi.com>
 * GitHub: https://github.com/hryvinskyi
 */

declare(strict_types=1);

namespace Hryvinskyi\EmailLogger\Block\Adminhtml;

use Hryvinskyi\EmailLogger\Api\Data\LogInterface;
use Magento\Backend\Block\Widget\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Block for displaying email log details in admin.
 */
class View extends Container
{
    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param array<string, mixed> $data
     */
    public function __construct(
        Context $context,
        private readonly DataPersistorInterface $dataPersistor,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * {@inheritDoc}
     */
    protected function _construct(): void
    {
        parent::_construct();
        $this->_controller = 'adminhtml_index';
        $this->_blockGroup = 'Hryvinskyi_EmailLogger';
    }

    /**
     * {@inheritDoc}
     */
    protected function _prepareLayout(): self
    {
        $this->buttonList->add(
            'back',
            [
                'label' => __('Back to List'),
                'onclick' => sprintf("setLocation('%s')", $this->getBackUrl()),
                'class' => 'back'
            ]
        );

        $this->buttonList->add(
            'delete',
            [
                'label' => __('Delete'),
                'onclick' => sprintf(
                    "confirmSetLocation('%s', '%s')",
                    __('Are you sure you want to delete this email log?'),
                    $this->getDeleteUrl()
                ),
                'class' => 'delete'
            ]
        );

        return parent::_prepareLayout();
    }

    /**
     * Retrieve log.
     *
     * @return LogInterface|null
     */
    public function getLog(): ?LogInterface
    {
        return $this->dataPersistor->get('email_log');
    }

    /**
     * Get back URL.
     *
     * @return string
     */
    public function getBackUrl(): string
    {
        return $this->getUrl('hryvinskyi_email_log/index/index');
    }

    /**
     * Get delete URL.
     *
     * @return string
     */
    public function getDeleteUrl(): string
    {
        return $this->getUrl('hryvinskyi_email_log/index/delete', ['id' => $this->getLog()?->getLogEntryId()]);
    }
}
