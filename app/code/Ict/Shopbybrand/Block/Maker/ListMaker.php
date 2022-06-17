<?php
/**
 * @author Ict Team
 * @copyright Copyright (c) 2017 Ict (http://icreativetechnologies.com/)
 * @package Ict_Shopbybrand
 */

namespace Ict\Shopbybrand\Block\Maker;

use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\UrlFactory;
use Ict\Shopbybrand\Model\ResourceModel\Maker\CollectionFactory as MakerCollectionFactory;

class ListMaker extends Template
{
    private $makerCollectionFactory;

    private $urlFactory;

    public function __construct(
        MakerCollectionFactory $makerCollectionFactory,
        UrlFactory $urlFactory,
        Context $context,
        array $data = []
    )
    {
        $this->makerCollectionFactory = $makerCollectionFactory;
        $this->urlFactory = $urlFactory;
        parent::__construct($context, $data);
    }

    /**
     * load the makers
     */
    protected  function _construct()
    {
        parent::_construct();
        $shopbybrand = $this->getRequest()->getPost("maker-search");
        if($shopbybrand){
            /** @var \Ict\Shopbybrand\Model\ResourceModel\Maker\Collection $makers */
            $makers = $this->makerCollectionFactory->create()->addFieldToSelect('*')
                ->addFieldToFilter('is_active', 1)
                ->addFieldToFilter('name', array("like"=>"%".$shopbybrand."%"))
                ->addStoreFilter($this->storeManager->getStore()->getId())
                ->setOrder('name', 'ASC');
                
            $this->setMakers($makers);    
        } else {
            /** @var \Ict\Shopbybrand\Model\ResourceModel\Maker\Collection $makers */
            $makers = $this->makerCollectionFactory->create()->addFieldToSelect('*')
                ->addFieldToFilter('is_active', 1)
                ->addStoreFilter($this->storeManager->getStore()->getId())
                ->setOrder('name', 'ASC');
            $this->setMakers($makers);
        }
    }

    /**
     * @return Media URL for brands
     */

    public function getBaseUrl()
    { 
        return $this->storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
            ).'ict/shopbybrand/maker/image' ;
    }
}
