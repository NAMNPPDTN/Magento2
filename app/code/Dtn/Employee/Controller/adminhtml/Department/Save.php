<?php
namespace Dtn\Employee\Controller\Adminhtml\Department;

use Dtn\Employee\Model\DepartmentFactory;
use Magento\Backend\App\Action;

/**
 * Class Save
 * @package ViMagento\HelloWorld\Controller\Adminhtml\Post
 */
class Save extends Action
{
    /**
     * @var DepartmentFactory
     */
    private $departmentFactory;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param DepartmentFactory $departmentFactory
     */
    public function __construct(
        Action\Context $context,
        DepartmentFactory $departmentFactory
    ) {
        parent::__construct($context);
        $this->departmentFactory = $departmentFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['department_id']) ? $data['department_id'] : null;

        $newData = [
            'department_name' => $data['department_name'],
        ];

        $department = $this->departmentFactory->create();

        if ($id) {
            $department->load($id);
        }
        try {
            $department->addData($newData);
            $department->save();
            $this->messageManager->addSuccessMessage(__('You saved the post.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }

        return $this->resultRedirectFactory->create()->setPath('employee/department/index');
    }
}
