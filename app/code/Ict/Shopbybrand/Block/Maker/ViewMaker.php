<?php

namespace Ict\Shopbybrand\Block\Maker;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;

class ViewMaker extends Template
{
    private $coreRegistry;

    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * get current maker
     * @return \Ict\Shopbybrand\Model\Maker
     */
    public function getCurrentMaker()
    {
        return $this->coreRegistry->registry('current_maker');
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
