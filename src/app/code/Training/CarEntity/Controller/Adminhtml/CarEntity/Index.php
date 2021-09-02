<?php

namespace Training\CarEntity\Controller\Adminhtml\CarEntity;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * CarEntity backend index (list) controller.
 */
class Index extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session.
     */
    const ADMIN_RESOURCE = 'Training_CarEntity::management';

    /**
     * Execute action based on request and return result.
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Training_CarEntity::management');
        $resultPage->addBreadcrumb(__('CarEntity'), __('CarEntity'));
        $resultPage->addBreadcrumb(__('Manage CarEntitys'), __('Manage CarEntitys'));
        $resultPage->getConfig()->getTitle()->prepend(__('CarEntity List'));

        return $resultPage;
    }
}
