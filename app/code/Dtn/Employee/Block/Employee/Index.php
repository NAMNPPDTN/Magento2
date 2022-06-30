<?php

namespace Dtn\Employee\Block\Employee;
use Dtn\Employee\Model\ResourceModel\Department\CollectionFactory;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $_employeeFactory;

    /**
     * @var \Dtn\Employee\Model\EmployeeFactory
     */
    protected $employeeFactory;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $request;
    /**
     * @var \Dtn\Employee\Model\Employee
     */
    private $employee;

    private $collectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Dtn\Employee\Model\ResourceModel\Employee\CollectionFactory $employeeFactoryFactory,
        \Dtn\Employee\Model\EmployeeFactory $employeeFactory,
        CollectionFactory $collectionFactory,
        \Dtn\Employee\Model\Employee $employee
    ) {
        $this->_employeeFactory = $employeeFactoryFactory;
        $this->employeeFactory = $employeeFactory;
        $this->employee = $employee;
        $this->request = $request;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Custom Pagination'));
        if ($this->getCustomCollection()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'custom.history.pager'
            )->setAvailableLimit([1 => 1, 10 => 10, 15 => 15, 20 => 20])
                ->setShowPerPage(true)->setCollection(
                    $this->getCustomCollection()
                );
            $this->setChild('pager', $pager);
            $this->getCustomCollection()->load();
        }
        return $this;
    }

    public function getCustomCollection()
    {
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest(

        )->getParam('limit') : 1;
        $collection = $this->employee->getCollection();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    public function getEmployee()
    {
        $employee = $this->_employeeFactory->create();
        return $employee;
    }
    public function getDepartment()
    {
        $department = $this->collectionFactory->create();
        return $department;
    }
}
