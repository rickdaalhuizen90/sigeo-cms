<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Backend\Block\Dashboard;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Adminhtml dashboard tab abstract
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
abstract class AbstractDashboard extends \Magento\Backend\Block\Widget
{
    /**
     * @var \Magento\Backend\Helper\Dashboard\AbstractDashboard
     */
    protected $_dataHelper = null;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return array|AbstractCollection|\Magento\Eav\Model\Entity\Collection\Abstract
     */
    public function getCollection()
    {
        return $this->getDataHelper()->getCollection();
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->getDataHelper()->getCount();
    }

    /**
     * Get data helper
     *
     * @return \Magento\Backend\Helper\Dashboard\AbstractDashboard
     */
    public function getDataHelper()
    {
        return $this->_dataHelper;
    }

    /**
     * @return $this
     */
    protected function _prepareData()
    {
        return $this;
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        $this->_prepareData();
        return parent::_prepareLayout();
    }
}
