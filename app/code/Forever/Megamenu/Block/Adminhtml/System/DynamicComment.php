<?php
namespace Forever\Megamenu\Block\Adminhtml\System;

use Magento\Framework\View\Element\AbstractBlock;
use Magento\Config\Model\Config\CommentInterface;

class DynamicComment extends AbstractBlock implements CommentInterface
{
    public function getCommentText($elementValue)
    {
        // $url = $this->_urlBuilder->getUrl('dynamic/dynamic/dynamic');
        $url = 'https://magepow.com/magento2-speed-optimizer.html';
        return "This feature require module a <a href='$url'>Magepow_SpeedOptimizer</a>";
    }
}
