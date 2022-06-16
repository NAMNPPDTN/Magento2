<?php

namespace Dtn\Employee\Model\Config;

/**
 * Class Status
 * @package ViMagento\HelloWorld\Model\Config
 */
class Status implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array[]
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Disabled')],
            ['value' => 1, 'label' => __('Actived')]
        ];
    }
}