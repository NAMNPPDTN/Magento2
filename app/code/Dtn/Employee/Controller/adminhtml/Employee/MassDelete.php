<?php
namespace Dtn\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Dtn\Employee\Model\ResourceModel\Employee\CollectionFactory;
use Dtn\Employee\Model\EmployeeFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\Model\View\Result\RedirectFactory;

class MassDelete extends Action
{
    private $employeeFactory;
    private $filter;
    private $collectionFactory;
    private $resultRedirect;

    public function __construct(
    Action\Context $context,
    EmployeeFactory $employeeFactory,
    Filter $filter,
    CollectionFactory $collectionFactory,
    RedirectFactory $redirectFactory
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
    $collection = $this->filter->getCollection($this->collectionFactory->create());
    $total = 0;
    $err = 0;
    foreach ($collection->getItems() as $item) {
            $deleteEmployee = $this->employeeFactory->create()->load($item->getData('employee_id'));
        try {
            $deleteEmployee->delete();
            $total++;
        } catch (LocalizedException $exception) {
            $err++;
        }
    }

    if ($total) {
        $this->messageManager->addSuccessMessage(
        __('A total of %1 record(s) have been deleted.', $total)
        );
    }

    if ($err) {
        $this->messageManager->addErrorMessage(
        __(
        'A total of %1 record(s) haven\'t been deleted. Please see server logs for more details.',
        $err
        )
        );
    }
        return $this->resultRedirect->create()->setPath('employee/employee/index');
    }
}