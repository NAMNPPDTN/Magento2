<?php

namespace Dtn\Employee\Model\ResourceModel\Employee;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'employee_id';

    protected function _construct()
    {
        $this->_init('Dtn\Employee\Model\Employee', 'Dtn\Employee\Model\ResourceModel\Employee');
    }
}