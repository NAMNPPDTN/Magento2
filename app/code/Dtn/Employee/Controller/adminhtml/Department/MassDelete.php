<?php
namespace Dtn\Employee\Controller\Adminhtml\Department;

use Dtn\Employee\Model\DepartmentFactory;
use Dtn\Employee\Model\ResourceModel\Department\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    private $departmentFactory;
    private $filter;
    private $collectionFactory;
    private $resultRedirect;

    public function __construct(
        Action\Context $context,
        DepartmentFactory $departmentFactory,
        Filter $filter,
        CollectionFactory $collectionFactory,
        RedirectFactory $redirectFactory
    ) {
        parent::__construct($context);
        $this->departmentFactory = $departmentFactory;
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
            $deleteDepartment = $this->departmentFactory->create()->load($item->getData('department_id'));
            try {
                $deleteDepartment->delete();
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
