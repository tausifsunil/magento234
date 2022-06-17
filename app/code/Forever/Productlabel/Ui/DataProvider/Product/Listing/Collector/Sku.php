<?php

namespace Forever\Productlabel\Ui\DataProvider\Product\Listing\Collector;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\Data\ProductRenderExtensionFactory;
use Magento\Catalog\Ui\DataProvider\Product\ProductRenderCollectorInterface;
use Magento\Catalog\Api\Data\ProductRenderInterface;

class Sku implements ProductRenderCollectorInterface
{
    /** SKU html key */
    // const KEY = "sku";

    /** PRODUCTLABEL html key */
    // const KEY = "productlabel";

    /** PRODUCTLABEL html key */
    const   PRODUCTOPTIONKEY = "productoption";

    /**
     * @var ProductRenderExtensionFactory
    */
    private $productRenderExtensionFactory;

     /**
     * @var ProductLabelViewModel
     */
    private $ProductLabelViewModel;

    /**
     * Sku constructor.
     * @param ProductRenderExtensionFactory $productRenderExtensionFactory
     * @param ProductLabelViewModel $ProductLabelViewModel
     */
    public function __construct(
        ProductRenderExtensionFactory $productRenderExtensionFactory,
        \Forever\Productlabel\ViewModel\ProductLabelViewModel $ProductLabelViewModel
    ) {
        $this->productRenderExtensionFactory = $productRenderExtensionFactory;
        $this->ProductLabelViewModel = $ProductLabelViewModel;
    }

    /**
     * @inheritdoc
     */
    public function collect(ProductInterface $product, ProductRenderInterface $productRender)
    {
        // echo "string";die();
        // echo "123";die;
        /*if ($select = $product->getProductoption()): 

        $selectAttr =  $product->getResource()->getAttribute('productoption');
            if ($selectAttr->usesSource())
                {
                    $select = $selectAttr->getSource()->getOptionText($select);
                    $productoption = strtolower(str_replace(' ', '_', $select));
                }
        // echo "$select";
         endif;
         $data=$product->getProductoption();*/

        $extensionAttributes = $productRender->getExtensionAttributes();

        if (!$extensionAttributes) {
            $extensionAttributes = $this->productRenderExtensionFactory->create();
        }
        $option=$this->ProductLabelViewModel->getProductoption($product);
        // print_r($option);die();
        $productlabel=$this->ProductLabelViewModel->getProductlabel($product);
        $confproductlabel=$this->ProductLabelViewModel->getScopeconfig('productlabel/general/productlabelenable');
        // print_r($productlabel);die;
        // if($product->getSku())
        if(!empty($productlabel) && $confproductlabel)
        {
            // $data=json_encode($productlabel);
            
            // print_r($data);die;
            // $extensionAttributes->setSku($product->getSku());
            // $extensionAttributes->setData('productlabel',$data);
            // $extensionAttributes->setData('productlabel',$productlabel);
            // $extensionAttributes->setData('productlabel','mahendra');
            $extensionAttributes->setData('productlabel',$productlabel);
            $extensionAttributes->setData('productoption',$option);
        }
        // print_r($extensionAttributes);die();
            // echo "string";
        $productRender->setExtensionAttributes($extensionAttributes);
        // die;
    }
}