<?php

namespace Forever\Megamenu\Model\System\Config;
    
class Width implements \Magento\Framework\Option\ArrayInterface
{

    const WIDTH_BOXED = 0;
    const WIDTH_AUTO  = 1;
    const WIDTH_FULL  = 2;

    /**
     * get available statuses.
     *
     * @return []
     */
    public function getWidth()
    {
        return [
            self::WIDTH_AUTO => __('Auto')
            , self::WIDTH_BOXED => __('Boxed')
            , self::WIDTH_FULL => __('Full')
        ];
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::WIDTH_AUTO, 'label' => __('Auto')],
            ['value' => self::WIDTH_BOXED, 'label' => __('Boxed')],
            ['value' => self::WIDTH_FULL, 'label' => __('Full')]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return self::getWidth();
    }
}
