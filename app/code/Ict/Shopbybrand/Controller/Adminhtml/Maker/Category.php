<?php
namespace Ict\Shopbybrand\Controller\Adminhtml\Maker;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Category extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPage;
    
    /**
     * @var resultJsonFactory
     */
    private $resultJsonFactory;
    
    public function __construct(
        Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return void
     */
    public function execute()
    {	
        $categoryIds = $this->getRequest()->getParam('catids');
        
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $result = $this->resultJsonFactory->create();
        $resultPage = $this->resultPageFactory->create();
      
        $block = $resultPage->getLayout()
                                ->createBlock('Ict\Shopbybrand\Block\Adminhtml\Maker')
                                ->setTemplate('Ict_Shopbybrand::tree_category.phtml')
                                ->setData('products',$categoryIds)
                                ->toHtml();
        $result->setData(['suggetion' => $block]);
        return $result;
        
    }
}
