<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Elasticsearch\Model\ResourceModel;

use Magento\Elasticsearch\Model\ResourceModel\EngineInterface;
use Magento\Framework\Indexer\ScopeResolver\IndexScopeResolver;

/**
 * Search engine resource model
 */
class Engine implements EngineInterface
{

    const VISIBILITY_BOTH = 4;

    /**
     * @var IndexScopeResolver
     */
    private $indexScopeResolver;

    /**
     * Construct
     *
     * @param IndexScopeResolver $indexScopeResolver
     */
    public function __construct(
        IndexScopeResolver $indexScopeResolver
    ) {
        $this->indexScopeResolver = $indexScopeResolver;
    }

    /**
     * Retrieve allowed visibility values for current engine
     *
     * @return int[]
     */
    public function getAllowedVisibility()
    {
        return [self::VISIBILITY_BOTH];
    }

    /**
     * Define if current search engine supports advanced index
     *
     * @return bool
     */
    public function allowAdvancedIndex()
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function processAttributeValue($attribute, $value)
    {
        return $value;
    }

    /**
     * Prepare index array as a string glued by separator
     *
     * Support 2 level array gluing
     *
     * @param array $index
     * @param string $separator
     * @return array
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function prepareEntityIndex($index, $separator = ' ')
    {
        return $index;
    }

    /**
     * @inheritdoc
     */
    public function isAvailable()
    {
        return true;
    }
}
