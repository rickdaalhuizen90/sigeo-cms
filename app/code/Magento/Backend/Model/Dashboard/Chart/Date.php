<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\Backend\Model\Dashboard\Chart;

use DateTimeZone;
use Magento\Backend\Model\Dashboard\Period;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

/**
 * Dashboard chart dates retriever
 */
class Date
{
    /**
     * @var TimezoneInterface
     */
    private $localeDate;
    private \Magento\Framework\App\Config\ScopeConfigInterface $_scopeConfig;

    /**
     * Date constructor.
     * @param CollectionFactory $collectionFactory
     * @param TimezoneInterface $localeDate
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        TimezoneInterface $localeDate
    ) {
        $this->localeDate = $localeDate;
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * Get chart dates data by period
     *
     * @param string $period
     *
     * @return array
     */
    public function getByPeriod(string $period): array
    {
        [$dateStart, $dateEnd] = $this->getDateRange(
            $period,
            '',
            '',
            true
        );

        $timezoneLocal = $this->localeDate->getConfigTimezone();

        $dateStart->setTimezone(new DateTimeZone($timezoneLocal));
        $dateEnd->setTimezone(new DateTimeZone($timezoneLocal));

        if ($period === Period::PERIOD_24_HOURS) {
            $dateEnd->modify('-1 hour');
        } elseif ($period === Period::PERIOD_TODAY) {
            $dateEnd->modify('now');
        } else {
            $dateEnd->setTime(23, 59, 59);
            $dateStart->setTime(0, 0, 0);
        }

        $dates = [];

        while ($dateStart <= $dateEnd) {
            switch ($period) {
                case Period::PERIOD_7_DAYS:
                case Period::PERIOD_1_MONTH:
                    $d = $dateStart->format('Y-m-d');
                    $dateStart->modify('+1 day');
                    break;
                case Period::PERIOD_1_YEAR:
                case Period::PERIOD_2_YEARS:
                    $d = $dateStart->format('Y-m');
                    $dateStart->modify('first day of next month');
                    break;
                default:
                    $d = $dateStart->format('Y-m-d H:00');
                    $dateStart->modify('+1 hour');
            }

            $dates[] = $d;
        }

        return $dates;
    }

    public function getDateRange($range, $customStart, $customEnd, $returnObjects = false)
    {
        $dateEnd = new \DateTime();
        $dateStart = new \DateTime();

        // go to the end of a day
        $dateEnd->setTime(23, 59, 59);

        $dateStart->setTime(0, 0, 0);

        switch ($range) {
            case 'today':
                $dateEnd->modify('now');
                break;
            case '24h':
                $dateEnd = new \DateTime();
                $dateEnd->modify('+1 hour');
                $dateStart = clone $dateEnd;
                $dateStart->modify('-1 day');
                break;

            case '7d':
                // substract 6 days we need to include
                // only today and not hte last one from range
                $dateStart->modify('-6 days');
                break;

            case '1m':
                $dateStart->setDate(
                    $dateStart->format('Y'),
                    $dateStart->format('m'),
                    $this->_scopeConfig->getValue(
                        'reports/dashboard/mtd_start',
                        \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                    )
                );
                break;

            case 'custom':
                $dateStart = $customStart ? $customStart : $dateStart;
                $dateEnd = $customEnd ? $customEnd : $dateEnd;
                break;

            case '1y':
            case '2y':
                $startMonthDay = explode(
                    ',',
                    $this->_scopeConfig->getValue(
                        'reports/dashboard/ytd_start',
                        \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                    )
                );
                $startMonth = isset($startMonthDay[0]) ? (int)$startMonthDay[0] : 1;
                $startDay = isset($startMonthDay[1]) ? (int)$startMonthDay[1] : 1;
                $dateStart->setDate($dateStart->format('Y'), $startMonth, $startDay);
                $dateStart->modify('-1 year');
                if ($range == '2y') {
                    $dateStart->modify('-1 year');
                }
                break;
        }

        if ($returnObjects) {
            return [$dateStart, $dateEnd];
        } else {
            return ['from' => $dateStart, 'to' => $dateEnd, 'datetime' => true];
        }
    }
}
