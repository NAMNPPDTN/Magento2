<?php

namespace Dtn\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Dtn\Employee\Model\ResourceModel\Employee\CollectionFactory;
use Dtn\Employee\Model\EmployeeFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Delete extends Action
{
    private $employeeFactory;
    private $filter;
    private $collectionFactory;
    private $resultRedirect;

    public function __construct(
        Action\Context    $context,
        EmployeeFactory   $employeeFactory,
        Filter            $filter,
        CollectionFactory $collectionFactory,
        RedirectFactory   $redirectFactory
    )
    {
        parent::__construct($context);
        $this->employeeFactory = $employeeFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->resultRedirect = $redirectFactory;
    }

    public function execute()
    {
        $data = (array)$this->getRequest()->getParams();
        $deleteEmployee = $this->employeeFactory->create()->load($data['id']);
        try {
            $deleteEmployee->delete();
            $this->messageManager->addSuccessMessage(__("Employee Delete Successfully."));

        } catch (LocalizedException $exception) {
            $this->messageManager->addErrorMessage($exception, __("We can\'t delete record, Please try again."));
        }
        return $this->resultRedirect->create()->setPath('employee/employee/index');
    }
}
