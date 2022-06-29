<?php

namespace Dtn\Employee\Controller\Adminhtml\Department;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class AddNew
 * @package Dtn\Employee\Controller\Adminhtml\Employee
 */
class AddNew extends Action
{
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Add New Department'));
        return $resultPage;
    }
}
