<?php
/**
 * @author Ict Team
 * @copyright Copyright (c) 2017 Ict (http://icreativetechnologies.com/)
 * @package Ict_Shopbybrand
 */

namespace Ict\Shopbybrand\Controller\Adminhtml\Maker;

use Ict\Shopbybrand\Controller\Adminhtml\Maker;
use Magento\Framework\Registry;
use Ict\Shopbybrand\Model\MakerFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\LayoutFactory;
use Magento\Framework\Stdlib\DateTime\Filter\Date;

class Products extends Maker
{

    protected $resultLayoutFactory;

    public function __construct(
        LayoutFactory $resultLayoutFactory,
        Registry $registry,
        MakerFactory $makerFactory,
        Date $dateFilter,
        Context $context

    )
    {
        $this->resultLayoutFactory = $resultLayoutFactory;
        parent::__construct($registry, $makerFactory, $dateFilter, $context);
    }

    /**
     * @return \Magento\Framework\View\Result\Layout
     */
    public function execute()
    {
        $this->initMaker();
        $resultLayout = $this->resultLayoutFactory->create();
        /** @var \Ict\Shopbybrand\Block\Adminhtml\Maker\Edit\Tab\Product $productsBlock */
        $productsBlock = $resultLayout->getLayout()->getBlock('maker.edit.tab.product');
        if ($productsBlock) {
            $productsBlock->setMakerProducts($this->getRequest()->getPost('maker_products', null));
        }
        return $resultLayout;
    }
}
