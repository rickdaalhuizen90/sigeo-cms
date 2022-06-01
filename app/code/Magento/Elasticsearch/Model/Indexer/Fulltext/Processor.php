<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Elasticsearch\Model\Indexer\Fulltext;

use Magento\Framework\Indexer\AbstractProcessor;
use Magento\Elasticsearch\Model\Indexer\Fulltext;

/**
 * Class Processor
 * @api
 * @since 100.1.0
 */
class Processor extends AbstractProcessor
{
    /**
     * Indexer ID
     */
    const INDEXER_ID = Fulltext::INDEXER_ID;
}
