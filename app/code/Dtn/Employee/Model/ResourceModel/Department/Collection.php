<?php

namespace Dtn\Employee\Model\ResourceModel\Department;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'department_id';

    protected function _construct()
    {
        $this->_init('Dtn\Employee\Model\Department', 'Dtn\Employee\Model\ResourceModel\Department');
    }
}