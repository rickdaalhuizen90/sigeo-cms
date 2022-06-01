<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Rss\Controller;

/**
 * Class Feed
 */
abstract class Feed extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\HTTP\Authentication
     */
    protected $httpAuthentication;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \Magento\Rss\Model\RssManager
     */
    protected $rssManager;

    /**
     * @var \Magento\Rss\Model\RssFactory
     */
    protected $rssFactory;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Rss\Model\RssManager $rssManager
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Rss\Model\RssFactory $rssFactory
     * @param \Magento\Framework\HTTP\Authentication $httpAuthentication
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Rss\Model\RssManager $rssManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Rss\Model\RssFactory $rssFactory,
        \Magento\Framework\HTTP\Authentication $httpAuthentication,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->rssManager = $rssManager;
        $this->scopeConfig = $scopeConfig;
        $this->rssFactory = $rssFactory;
        $this->httpAuthentication = $httpAuthentication;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * Authenticate not logged in customer.
     *
     * @return bool
     */
    protected function auth()
    {
        return false;
    }
}
