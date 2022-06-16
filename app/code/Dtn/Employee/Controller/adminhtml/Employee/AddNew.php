<?php

namespace Dtn\Employee\Controller\Adminhtml\Employee;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;

/**
 * Class AddNew
 * @package Dtn\Employee\Controller\Adminhtml\Employee
 */
class AddNew extends Action
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Add New Post'));
        return $resultPage;
    }
}