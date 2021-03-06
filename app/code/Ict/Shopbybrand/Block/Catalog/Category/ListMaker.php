<?php
/**
 * @author Ict Team
 * @copyright Copyright (c) 2017 Ict (http://icreativetechnologies.com/)
 * @package Ict_Shopbybrand
 */

namespace Ict\Shopbybrand\Block\Catalog\Category;

use Magento\Framework\View\Element\Template;
use Ict\Shopbybrand\Model\Maker\Category as CategoryModel;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;

class ListMaker extends Template
{

    private $registry;

    private $categoryModel;

    private $makerCollection;

    

    public function __construct(
        CategoryModel $categoryModel,
        Registry $registry,
        Context $context,
        array $data = []
    ) {
        $this->categoryModel = $categoryModel;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return \Ict\Shopbybrand\Model\ResourceModel\Maker\Collection
     */
    public function getMakerCollection()
    {
        if (is_null($this->makerCollection)) {
            $this->makerCollection = $this->categoryModel
                ->getSelectedMakersCollection($this->getCategory())
                ->addStoreFilter($this->storeManager->getStore()->getId())
                ->addFieldToFilter('is_active', 1);//TODO: use constant here
            // $this->makerCollection->getSelect()->order('related_category.position');
        }
        return $this->makerCollection;
    }

    /**
     * @return \Magento\Catalog\Model\Category
     */
    public function getCategory()
    {
        return $this->registry->registry('current_category');
    }

    /**
    * @return class name
    */
    public function getAnchorName()
    {
        return 'catalog.category.list.ict.shopbybrand.maker';
    }

    /**
    * @return media URL for brands
    */
    public function getBaseUrl()
    { 
        return $this->storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
            ).'ict/shopbybrand/maker/image' ;
    }
}
