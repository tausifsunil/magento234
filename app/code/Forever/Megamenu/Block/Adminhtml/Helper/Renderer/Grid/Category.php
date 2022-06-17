<?php
namespace Forever\Megamenu\Block\Adminhtml\Helper\Renderer\Grid;

class Category extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    protected $_storeManager;

     protected $_categoryFactory;

    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
        $this->_categoryFactory  = $categoryFactory;
    }

    public function render(\Magento\Framework\DataObject $row)
    {
        $id = $row->getData($this->getColumn()->getIndex()); // $row->getCatId(); // $row->getData('cat_id');
        // print_r($id);die;
        $category = $this->_categoryFactory->create()->load($id);
        $url = $this->getUrl('catalog/category/edit', ['id' => $id]);

        return '<a href="'.$url.'" alt="'.$url.'" >'. $category->getName() .'</a>';
    }
}
