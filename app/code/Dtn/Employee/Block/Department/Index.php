<?php

namespace Dtn\Employee\Block\Department;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $_departmentFactory;
    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $request;
    /**
     * @var \Dtn\Employee\Model\Employee
     */
    private $department;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Dtn\Employee\Model\ResourceModel\Department\CollectionFactory $departmentFactoryFactory,
        \Dtn\Employee\Model\Department $department
    ) {
        $this->_departmentFactory = $departmentFactoryFactory;
        $this->department = $department;
        $this->request = $request;
        parent::__construct($context);
    }
    public function getDepartment()
    {
        $department = $this->_departmentFactory->create();
        return $department;
    }
}
