<?php
/**
 * Options for Query Id column
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\AdvancedSearch\Model\Adminhtml\Search\Grid;

/**
 * @api
 * @since 100.0.2
 */
class Options implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $_request;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registryManager;

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Registry $registry
    ) {
        $this->_request = $request;
        $this->_registryManager = $registry;
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        $queries = $this->_request->getPost('selected_queries');

        $currentQueryId = $this->_registryManager->registry('current_catalog_search')->getId();
        $queryIds = [];

        return $queryIds;
    }
}
