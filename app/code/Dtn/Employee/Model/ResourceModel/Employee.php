<?php

namespace Dtn\Employee\Model\ResourceModel;

class Employee extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('employees', 'employee_id');
    }
}