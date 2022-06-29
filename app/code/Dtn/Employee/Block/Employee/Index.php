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
