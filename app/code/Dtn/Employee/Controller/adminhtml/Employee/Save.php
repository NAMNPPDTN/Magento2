<?php
namespace Dtn\Employee\Controller\Adminhtml\Employee;

use Dtn\Employee\Model\EmployeeFactory;
use Magento\Backend\App\Action;

/**
 * Class Save
 * @package ViMagento\HelloWorld\Controller\Adminhtml\Post
 */
class Save extends Action
{
    /**
     * @var EmployeeFactory
     */
    private $employeeFactory;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param EmployeeFactory $employeeFactory
     */
    public function __construct(
        Action\Context $context,
        EmployeeFactory $employeeFactory
    ) {
        parent::__construct($context);
        $this->employeeFactory = $employeeFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['employee_id']) ? $data['employee_id'] : null;

        $newData = [
            'employee_name' => $data['employee_name'],
            'age' => $data['age'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'department_id' => $data['department_id'],
            'status' => $data['status'],
        ];

        $employee = $this->employeeFactory->create();

        if ($id) {
            $employee->load($id);
        }
        try {
            $employee->addData($newData);
            $employee->save();
            $this->messageManager->addSuccessMessage(__('You saved the post.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }

        return $this->resultRedirectFactory->create()->setPath('employee/employee/index');
    }
}
