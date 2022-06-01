<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\GoogleAnalytics\Block;

use Magento\Framework\App\ObjectManager;

/**
 * GoogleAnalytics Page Block
 *
 * @api
 * @since 100.0.2
 */
class Ga extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\GoogleAnalytics\Helper\Data
     */
    protected $_googleAnalyticsData = null;

    /**
     * @var \Magento\Cookie\Helper\Cookie
     */
    private $cookieHelper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\GoogleAnalytics\Helper\Data $googleAnalyticsData
     * @param array $data
     * @param \Magento\Cookie\Helper\Cookie|null $cookieHelper
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\GoogleAnalytics\Helper\Data $googleAnalyticsData,
        array $data = [],
        \Magento\Cookie\Helper\Cookie $cookieHelper = null
    ) {
        $this->_googleAnalyticsData = $googleAnalyticsData;
        $this->cookieHelper = $cookieHelper ?: ObjectManager::getInstance()->get(\Magento\Cookie\Helper\Cookie::class);
        parent::__construct($context, $data);
    }

    /**
     * Get config
     *
     * @param string $path
     * @return mixed
     */
    public function getConfig($path)
    {
        return $this->_scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get a specific page name (may be customized via layout)
     *
     * @return string|null
     */
    public function getPageName()
    {
        return $this->_getData('page_name');
    }

    /**
     * Render regular page tracking javascript code.
     *
     * The custom "page name" may be set from layout or somewhere else. It must start from slash.
     *
     * @param string $accountId
     * @return string
     * @link https://developers.google.com/analytics/devguides/collection/analyticsjs/method-reference#set
     * @link https://developers.google.com/analytics/devguides/collection/analyticsjs/method-reference#gaObjectMethods
     * @deprecated 100.2.0 please use getPageTrackingData method
     */
    public function getPageTrackingCode($accountId)
    {
        $anonymizeIp = "";
        if ($this->_googleAnalyticsData->isAnonymizedIpActive()) {
            $anonymizeIp = "\nga('set', 'anonymizeIp', true);";
        }

        return "\nga('create', '" . $this->escapeHtmlAttr($accountId, false)
           . "', 'auto');{$anonymizeIp}\nga('send', 'pageview'{$this->getOptPageUrl()});\n";
    }

    /**
     * Render GA tracking scripts
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->_googleAnalyticsData->isGoogleAnalyticsAvailable()) {
            return '';
        }

        return parent::_toHtml();
    }

    /**
     * Return cookie restriction mode value.
     *
     * @return bool
     * @since 100.2.0
     */
    public function isCookieRestrictionModeEnabled()
    {
        return $this->cookieHelper->isCookieRestrictionModeEnabled();
    }

    /**
     * Return current website id.
     *
     * @return int
     * @since 100.2.0
     */
    public function getCurrentWebsiteId()
    {
        return $this->_storeManager->getWebsite()->getId();
    }

    /**
     * Return information about page for GA tracking
     *
     * @link https://developers.google.com/analytics/devguides/collection/analyticsjs/method-reference#set
     * @link https://developers.google.com/analytics/devguides/collection/analyticsjs/method-reference#gaObjectMethods
     *
     * @param string $accountId
     * @return array
     * @since 100.2.0
     */
    public function getPageTrackingData($accountId)
    {
        return [
            'optPageUrl' => $this->getOptPageUrl(),
            'isAnonymizedIpActive' => $this->_googleAnalyticsData->isAnonymizedIpActive(),
            'accountId' => $this->escapeHtmlAttr($accountId, false)
        ];
    }

    /**
     * Return page url for tracking.
     *
     * @return string
     */
    private function getOptPageUrl()
    {
        $optPageURL = '';
        $pageName = $this->getPageName() !== null ? trim($this->getPageName()) : '';
        if ($pageName && substr($pageName, 0, 1) === '/' && strlen($pageName) > 1) {
            $optPageURL = ", '" . $this->escapeHtmlAttr($pageName, false) . "'";
        }
        return $optPageURL;
    }
}
