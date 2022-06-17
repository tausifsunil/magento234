<?php

namespace Forever\Team\Model\ResourceModel;

/**
 * Modulename Entity mysql resource.
 */
class Team extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Construct.
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     *
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) 
    {
        parent::__construct($context);
    }
 
    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('forever_team', 'id');
    }
}