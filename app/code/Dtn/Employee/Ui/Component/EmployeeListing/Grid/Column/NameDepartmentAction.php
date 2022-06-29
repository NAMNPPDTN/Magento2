<?php
namespace Dtn\Employee\Ui\Component\EmployeeListing\Grid\Column;

use Dtn\Employee\Model\ResourceModel\Department\CollectionFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class Action
 * @package Dtn\Employee\Ui\Component\Listing\Grid\Column
 */
class NameDepartmentAction extends Column
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;
    private $collectionFactory;

    /**
     * Action constructor.
     * @param UrlInterface $urlBuilder
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        UrlInterface $urlBuilder,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CollectionFactory $collectionFactory,
        array $components = [],
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $collection = $this->collectionFactory->create();
        $departments = $collection->getItems();
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                foreach ($departments as $department) {
                    if ($item['department_id'] == $department->getData('department_id')) {
                        $item['department_id'] = $department->getData('department_name');
                    }
                }
            }
        }

        return $dataSource;
    }
}
