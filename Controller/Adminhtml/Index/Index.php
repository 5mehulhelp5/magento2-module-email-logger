<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

namespace Hryvinskyi\EmailLogger\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

/**
 * Class Index
 *
 * @method \Magento\Framework\App\Request\Http getRequest()
 * @method \Magento\Framework\App\Response\Http getResponse()
 *
 * @package Hryvinskyi\EmailLogger\Controller\Adminhtml\Log
 */
class Index extends Action
{
    /**
     * @inheritdoc
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Hryvinskyi_EmailLogger::log');
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Email Logs'));
        $this->_addBreadcrumb(__('Email Logs'), __('Email Logs'));
        $this->_view->renderLayout();
    }
}
