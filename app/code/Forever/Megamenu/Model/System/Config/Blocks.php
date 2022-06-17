<?php
namespace Forever\Megamenu\Model\System\Config;

use Magento\Cms\Model\ResourceModel\Block\CollectionFactory;

/*class Blocks implements \Magento\Framework\Option\ArrayInterface
{

    protected $_blockCollectionFactory;
    
    protected $_request;

    protected $_blocks;

    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        CollectionFactory $blockCollectionFactory
    ) {
           $this->_request = $request;
           $this->_blockCollectionFactory = $blockCollectionFactory;
    }

    public function toOptionArray()
    {
        
            $collection =$this->_blockCollectionFactory->create();
                echo'<pre>';print_r($collection->getData());die();
            $collection->addStoreFilter($store)->load();
            $options = [];
            foreach ($collection as $block) {
                $options[$block->getIdentifier()] = $block->getTitle();
            }
            array_unshift($options, ['value' => '', 'label' => __('Please select a static block.')]);
            $this->_blocks = $options;
            return $this->_blocks;
        
    }
}*/


class Blocks extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Block collection factory
     *
     * @var CollectionFactory
     */
    protected $_blockCollectionFactory;

    /**
     * Construct
     *
     * @param CollectionFactory $blockCollectionFactory
     */
    public function __construct(CollectionFactory $blockCollectionFactory)
    {
        $this->_blockCollectionFactory = $blockCollectionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = $this->_blockCollectionFactory->create()->load()->toOptionArray();
            $itemArray=['value' => '', 'label' => __('Please select a static block.')];
            $blockArray=[];
            $blockArray[]=$itemArray;
            foreach ($this->_options as $value) {
                $blockArray[] = ['label' => $value['label'],'value' => $value['label'],];            
            }
            return $blockArray;
        }
        return $blockArray;
    }
}
