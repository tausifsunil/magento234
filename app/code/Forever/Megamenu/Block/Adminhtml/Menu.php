<?php
namespace Forever\Megamenu\Block\Adminhtml;

class Menu extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor.
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_menu';
        $this->_blockGroup = 'Forever_Megamenu';
        $this->_headerText = __('Menu Menu');
        $this->_addButtonLabel = __('Add New Menu');
        parent::_construct();
    }
}
