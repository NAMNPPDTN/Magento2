<?php

namespace Dtn\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $pageFactory;

    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Employee Listing'));
        return $resultPage;
    }
}
