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
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $this->pageConfig->getTitle()->set(__('Custom Pagination'));
        if ($this->getDepartment()) {
            $pager = $this->getLayout()->createBlock(
                'Magento\Theme\Block\Html\Pager',
                'custom.history.pager'
            )->setAvailableLimit([1 => 1, 10 => 10, 15 => 15, 20 => 20])
                ->setShowPerPage(true)->setCollection(
                    $this->getDepartment()
                );
            $this->setChild('pager', $pager);
            $this->getDepartment()->load();
        }
        return $this;
    }

    public function getDepartment()
    {
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize = ($this->getRequest()->getParam('limit')) ? $this->getRequest(

        )->getParam('limit') : 1;
        $collection = $this->department->getCollection();
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);
        return $collection;
    }
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
