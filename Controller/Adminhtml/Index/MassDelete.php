<?php
/**
 * Copyright (c) 2024. Volodymyr Hryvinskyi.  All rights reserved.
 * @author: <mailto:volodymyr@hryvinskyi.com>
 * @github: <https://github.com/hryvinskyi>
 */

namespace Hryvinskyi\EmailLogger\Controller\Adminhtml\Index;

use Hryvinskyi\EmailLogger\Api\LogRepositoryInterface;
use Hryvinskyi\EmailLogger\Model\ResourceModel\Log\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;

/**
 * @method \Magento\Framework\App\Request\Http getRequest()
 * @method \Magento\Framework\App\Response\Http getResponse()
 */
class MassDelete extends Action
{
    public function __construct(
        Context $context,
        private readonly Filter $filter,
        private readonly CollectionFactory $entityCollectionFactory,
        private readonly LogRepositoryInterface $entityRepository
    ) {
        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    public function execute(): Redirect
    {
        $collection = $this->filter->getCollection($this->entityCollectionFactory->create());

        foreach ($collection as $item) {
            $this->entityRepository->delete($item);
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 log(s) have been deleted.', $collection->count()));

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('*/*/');
    }
}
