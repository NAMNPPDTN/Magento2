<?php

namespace Dtn\Employee\Controller\Adminhtml\Department;

use Dtn\Employee\Model\DepartmentFactory;
use Dtn\Employee\Model\ResourceModel\Department\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Ui\Component\MassAction\Filter;

class Delete extends Action
{
    private $departmentFactory;
    private $filter;
    private $collectionFactory;
    private $resultRedirect;

    public function __construct(
        Action\Context    $context,
        DepartmentFactory  $departmentFactory,
        Filter            $filter,
        CollectionFactory $collectionFactory,
        RedirectFactory   $redirectFactory
    ) {
        parent::__construct($context);
        $this->departmentFactory = $departmentFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->resultRedirect = $redirectFactory;
    }

    public function execute()
    {
        $data = (array)$this->getRequest()->getParams();
        $deleteDepartment = $this->departmentFactory->create()->load($data['id']);
        try {
            $deleteDepartment->delete();
            $this->messageManager->addSuccessMessage(__("Department Delete Successfully."));
        } catch (LocalizedException $exception) {
            $this->messageManager->addErrorMessage($exception, __("We can\'t delete record, Please try again."));
        }
        return $this->resultRedirect->create()->setPath('employee/department/index');
    }
}
