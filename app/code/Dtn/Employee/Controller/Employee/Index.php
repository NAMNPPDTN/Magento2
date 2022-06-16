<?php

namespace Dtn\Employee\Controller\Employee;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $employeeFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Dtn\Employee\Model\EmployeeFactory $employeeFactory
    )
    {
        $this->employeeFactory = $employeeFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->employeeFactory->create()->getCollection();
        foreach ($data as $value) {
            echo "<pre>";
            print_r($value->getData());
            echo "</pre>";
        }
    }
}