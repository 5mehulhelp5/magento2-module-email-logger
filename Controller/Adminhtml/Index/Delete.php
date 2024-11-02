<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

namespace Hryvinskyi\EmailLogger\Controller\Adminhtml\Index;

use Hryvinskyi\EmailLogger\Api\LogRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

/**
 * @method \Magento\Framework\App\Request\Http getRequest()
 * @method \Magento\Framework\App\Response\Http getResponse()
 */
class Delete extends Action
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
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('id');
        if ($id === null) {
            $this->messageManager->addErrorMessage(__('We can\'t find a log to delete.'));

            return $resultRedirect->setPath('*/*/');
        }
        try {
            $this->entityRepository->deleteById($id);
            $this->messageManager->addSuccessMessage(__('Entity has been deleted.'));

            return $resultRedirect->setPath('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());

            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }
    }
}
