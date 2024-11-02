<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

namespace Hryvinskyi\EmailLogger\Controller\Adminhtml\Index;

use Hryvinskyi\EmailLogger\Api\Data\LogInterface;
use Hryvinskyi\EmailLogger\Api\LogRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * @method \Magento\Framework\App\Request\Http getRequest()
 * @method \Magento\Framework\App\Response\Http getResponse()
 */
class ViewLog extends Action
{
    public function __construct(
        Context $context,
        private readonly LogRepositoryInterface $entityRepository
    ) {
        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/');
        $id = $this->getRequest()->getParam('id');

        if ($id === '') {
            return $resultRedirect;
        }

        try {
            $entity = $this->entityRepository->getById($id);
            $resultPage = $this->resultFactory->create(ResultFactory::TYPE_RAW);
            $resultPage->setContents(quoted_printable_decode($entity->getEmailContent()));
        } catch (NoSuchEntityException) {
            $this->messageManager->addErrorMessage(__('Can not find email log record with ID %1', $id));
            return $resultRedirect;
        }

        return $resultPage;
    }
}
