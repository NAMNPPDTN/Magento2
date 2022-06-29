<?php

namespace Dtn\Employee\Model\Config\Employee;

use Dtn\Employee\Model\ResourceModel\Department\CollectionFactory;

/**
 * Class Status
 * @package ViMagento\HelloWorld\Model\Config
 */
class Department implements \Magento\Framework\Option\ArrayInterface
{
    private $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }
    /**
     * @return array[]
     */
    public function toOptionArray()
    {
        $collection = $this->collectionFactory->create();
        $departments = $collection->getItems();
        $arrayDepartment = [];

        foreach ($departments as $department) {
            $arrayDepartment[] = ['value' => $department->getData('department_id'), 'label' => __($department->getData('department_name'))];
        }

        return $arrayDepartment;
    }
}
