<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\Backend\Block\Dashboard;

/**
 * Adminhtml dashboard google chart block
 * @deprecated dashboard graphs were migrated to dynamic chart.js solution
 * @see dashboard.chart.amounts and dashboard.chart.orders in adminhtml_dashboard_index.xml
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Graph extends \Magento\Backend\Block\Dashboard\AbstractDashboard
{
    const API_URL = 'https://image-charts.com/chart';

    /**
     * All series
     *
     * @var array
     */
    protected $_allSeries = [];

    /**
     * Axis labels
     *
     * @var array
     */
    protected $_axisLabels = [];

    /**
     * Axis maps
     *
     * @var array
     */
    protected $_axisMaps = [];

    /**
     * Data rows
     *
     * @var array
     */
    protected $_dataRows = [];

    /**
     * Simple encoding chars
     *
     * @var string
     */
    protected $_simpleEncoding = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    /**
     * Extended encoding chars
     *
     * @var string
     */
    protected $_extendedEncoding = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-.';

    /**
     * Chart width
     *
     * @var string
     */
    protected $_width = '780';

    /**
     * Chart height
     *
     * @var string
     */
    protected $_height = '384';

    /**
     * Google chart api data encoding
     *
     * @deprecated 101.0.2 since the Google Image Charts API not accessible from March 14, 2019
     * @var string
     */
    protected $_encoding = 'e';

    /**
     * Html identifier
     *
     * @var string
     */
    protected $_htmlId = '';

    /**
     * @var string
     */
    protected $_template = 'Magento_Backend::dashboard/graph.phtml';

    /**
     * Adminhtml dashboard data
     *
     * @var \Magento\Backend\Helper\Dashboard\Data
     */
    protected $_dashboardData = null;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Dashboard\Data $dashboardData
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Dashboard\Data $dashboardData,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_dashboardData = $dashboardData;
    }

    /**
     * Get tab template
     *
     * @return string
     */
    protected function _getTabTemplate()
    {
        return 'dashboard/graph.phtml';
    }

    /**
     * Set data rows
     *
     * @param string $rows
     * @return void
     */
    public function setDataRows($rows)
    {
        $this->_dataRows = (array)$rows;
    }

    /**
     * Add series
     *
     * @param string $seriesId
     * @param array $options
     * @return void
     */
    public function addSeries($seriesId, array $options)
    {
        $this->_allSeries[$seriesId] = $options;
    }

    /**
     * Get series
     *
     * @param string $seriesId
     * @return array|bool
     */
    public function getSeries($seriesId)
    {
        if (isset($this->_allSeries[$seriesId])) {
            return $this->_allSeries[$seriesId];
        }
        return false;
    }

    /**
     * Get all series
     *
     * @return array
     */
    public function getAllSeries()
    {
        return $this->_allSeries;
    }

    /**
     * Format dates for axis labels
     *
     * @param string $idx
     * @param string $timezoneLocal
     *
     * @return void
     */
    private function formatAxisLabelDate($idx, $timezoneLocal)
    {
        foreach ($this->_axisLabels[$idx] as $_index => $_label) {
            if ($_label != '') {
                $period = new \DateTime($_label, new \DateTimeZone($timezoneLocal));
                switch ($this->getDataHelper()->getParam('period')) {
                    case '24h':
                        $this->_axisLabels[$idx][$_index] = $this->_localeDate->formatDateTime(
                            $period->setTime((int)$period->format('H'), 0, 0),
                            \IntlDateFormatter::NONE,
                            \IntlDateFormatter::SHORT
                        );
                        break;
                    case '7d':
                    case '1m':
                        $this->_axisLabels[$idx][$_index] = $this->_localeDate->formatDateTime(
                            $period,
                            \IntlDateFormatter::SHORT,
                            \IntlDateFormatter::NONE
                        );
                        break;
                    case '1y':
                    case '2y':
                        $this->_axisLabels[$idx][$_index] = date('m/Y', strtotime($_label));
                        break;
                }
            } else {
                $this->_axisLabels[$idx][$_index] = '';
            }
        }
    }

    /**
     * Get rows data
     *
     * @param array $attributes
     * @param bool $single
     * @return array
     */
    protected function getRowsData($attributes, $single = false)
    {
        $items = $this->getCollection()->getItems();
        $options = [];
        foreach ($items as $item) {
            if ($single) {
                $options[] = max(0, $item->getData($attributes));
            } else {
                foreach ((array)$attributes as $attr) {
                    $options[$attr][] = max(0, $item->getData($attr));
                }
            }
        }
        return $options;
    }

    /**
     * Set axis labels
     *
     * @param string $axis
     * @param array $labels
     * @return void
     */
    public function setAxisLabels($axis, $labels)
    {
        $this->_axisLabels[$axis] = $labels;
    }

    /**
     * Set html id
     *
     * @param string $htmlId
     * @return void
     */
    public function setHtmlId($htmlId)
    {
        $this->_htmlId = $htmlId;
    }

    /**
     * Get html id
     *
     * @return string
     */
    public function getHtmlId()
    {
        return $this->_htmlId;
    }

    /**
     * Return pow
     *
     * @param int $number
     * @return int
     */
    protected function _getPow($number)
    {
        $pow = 0;
        while ($number >= 10) {
            $number = $number / 10;
            $pow++;
        }
        return $pow;
    }

    /**
     * Return chart width
     *
     * @return string
     */
    protected function getWidth()
    {
        return $this->_width;
    }

    /**
     * Return chart height
     *
     * @return string
     */
    protected function getHeight()
    {
        return $this->_height;
    }

    /**
     * Sets data helper
     *
     * @param \Magento\Backend\Helper\Dashboard\AbstractDashboard $dataHelper
     * @return void
     */
    public function setDataHelper(\Magento\Backend\Helper\Dashboard\AbstractDashboard $dataHelper)
    {
        $this->_dataHelper = $dataHelper;
    }

    /**
     * Prepare chart data
     *
     * @return void
     */
    protected function _prepareData()
    {
        if ($this->_dataHelper !== null) {
            $availablePeriods = array_keys($this->_dashboardData->getDatePeriods());
            $period = $this->getRequest()->getParam('period');
            $this->getDataHelper()->setParam(
                'period',
                $period && in_array($period, $availablePeriods) ? $period : '24h'
            );
        }
    }
}
