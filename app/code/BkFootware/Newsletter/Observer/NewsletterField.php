<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace BkFootware\Newsletter\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Request\Http;

class NewsletterField implements ObserverInterface
{
    protected $request;

    public function __construct(
        \Magento\Newsletter\Model\SubscriberFactory  $subscriberFactory,
        Http $request
    )
    {
        $this->subscriberFactory = $subscriberFactory;
        $this->request = $request;
    }

    public function execute(Observer $observer)
    {
        $subscriber = $observer->getEvent()->getSubscriber();
        $name = $this->request->getPost('name');

        $subscriber->setName($name);

        return $this;
    }
}
