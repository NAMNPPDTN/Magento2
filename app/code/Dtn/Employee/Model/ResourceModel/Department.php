<?php

namespace Dtn\Employee\Model\ResourceModel;

class Department extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('departments', 'department_id');
    }
}
