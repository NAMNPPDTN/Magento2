<?php

namespace Dtn\employee\Observer;

    use Magento\Framework\Data\Tree\Node;
    use Magento\Framework\Event\Observer as EventObserver;
    use Magento\Framework\Event\ObserverInterface;

    class Topmenu implements ObserverInterface
    {
        protected $urlBuilder;

        public function __construct(\Magento\Framework\UrlInterface $urlBuilder)
        {
            $this->urlBuilder = $urlBuilder;
        }

        public function execute(EventObserver $observer)
        {
            $menu = $observer->getMenu();
            $tree = $menu->getTree();
            $datas = [
                [
                'name' => __('Employee'),
                'id' => 'employee',
                'url' => $this->urlBuilder->getUrl('employee/employee/index'),
                'is_active' => false
                ],
                [
                    'name' => __('Department'),
                    'id' => 'department',
                    'url' => $this->urlBuilder->getUrl('employee/department/index'),
                    'is_active' => false
                ]
                ];
            foreach ($datas as $data) {
                $node = new Node($data, 'id', $tree, $menu);
                $menu->addChild($node);
            }
            return $this;
        }
    }
