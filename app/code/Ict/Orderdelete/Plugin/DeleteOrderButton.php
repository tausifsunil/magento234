<?php

/**
 * Copyright © Icreative Technologies. All rights reserved.
 *
 * @author : Icreative Technologies
 * @package : Ict_Orderdelete
 * @copyright : Copyright © Icreative Technologies (https://www.icreativetechnologies.com/)
 */

namespace Ict\Orderdelete\Plugin;

use Magento\Sales\Block\Adminhtml\Order\View as OrderView;
use Ict\Orderdelete\Helper\Data as DataHelper;

class DeleteOrderButton
{
    public const XML_CONFIG_PATH_ENABLE = 'orderdelete/general/enable';
    public const XML_CONFIG_PATH_DELETE = 'orderdelete/order/delete';

    /**
     * @var DataHelper
     */
    protected $dataHelper;

    /**
     * @param DataHelper $dataHelper
     */
    public function __construct(
        DataHelper $dataHelper
    ) {
            $this->helper = $dataHelper;
    }

    /**
     * Delete button
     */
    public function beforeSetLayout(OrderView $subject)
    {
        $enableOrderDelete = $this->helper->getConfig(self::XML_CONFIG_PATH_ENABLE);
        if ($enableOrderDelete == 1) {
            $message = "Are you sure you want to delete this order?";

            $subject->addButton(
                'order_delete_button',
                [
                'label' => __('Delete'),
                'class' => __('delete'),
                'id' => 'order-view-delete-button',
                'onclick' => 'confirmSetLocation(\'' . $message . '\',
                \'' . $subject->getUrl(self::XML_CONFIG_PATH_DELETE) . '\')'
                ]
            );
        }
    }
}
