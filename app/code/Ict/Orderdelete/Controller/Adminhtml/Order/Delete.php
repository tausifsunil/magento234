<?php

/**
 * Copyright © Icreative Technologies. All rights reserved.
 *
 * @author : Icreative Technologies
 * @package : Ict_Orderdelete
 * @copyright : Copyright © Icreative Technologies (https://www.icreativetechnologies.com/)
 */

namespace Ict\Orderdelete\Controller\Adminhtml\Order;

class Delete extends \Magento\Backend\App\Action
{
    public const XML_PATH_INDEX = 'sales/order/index';
    public const XML_PATH_VIEW = 'sales/order/view';

    /**
     * @var \Magento\Sales\Model\Order
     */
    protected $order;

    /**
     * @var \Ict\Orderdelete\Helper\Data
     */
    protected $dataHelper;

    /**
     * @param Magento\Backend\App\Action\Context $context
     * @param Magento\Sales\Model\Order $order
     * @param Ict\Orderdelete\Helper\Data $dataHelper
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Sales\Model\Order $order,
        \Ict\Orderdelete\Helper\Data $dataHelper
    ) {
            parent::__construct($context);
            $this->order = $order;
            $this->helper = $dataHelper;
    }

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('order_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $order = $this->order->load($id);
                $order->delete();
                $this->helper->deleteRecord($order->getId());
                $this->helper->deleteReservationInventory($order->getId(), $order->getIncrementId());
                $this->messageManager->addSuccess(__('Order has been deleted.'));
                return $resultRedirect->setPath(self::XML_PATH_INDEX);
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath(self::XML_PATH_VIEW, ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find an item to delete.'));
        return $resultRedirect->setPath(self::XML_PATH_INDEX);
    }
}
