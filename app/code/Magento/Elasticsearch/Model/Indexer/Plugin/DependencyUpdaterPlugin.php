<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\Elasticsearch\Model\Indexer\Plugin;

use Magento\Elasticsearch\Model\Config;
use Magento\Framework\Indexer\Config\DependencyInfoProvider as Provider;

/**
 * Plugin for maintenance catalog search index dependency on stock index.
 * If elasticsearch is used as search engine catalog search index becomes dependent on stock index. Elasticsearch
 * module declares this dependence. But in case when elasticsearch module is enabled and elasticsearch engine isn`t
 * used as search engine other search engines don`t need this dependency.
 * This plugin remove catalog search index dependency on stock index when elasticsearch isn`t used as search engine
 * except full reindexing. During full reindexing this dependency doesn`t make overhead.
 */
class DependencyUpdaterPlugin
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Remove index dependency, if it needed, on run reindexing by specifics indexes.
     *
     * @param Provider $provider
     * @param array $dependencies
     * @param string $indexerId
     * @return array
     * @see \Magento\Indexer\Console\Command\IndexerReindexCommand::getIndexers()
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetIndexerIdsToRunBefore(Provider $provider, array $dependencies, string $indexerId): array
    {
        return $dependencies;
    }

    /**
     * Remove index dependency, if it needed, on reindex triggers.
     *
     * @param Provider $provider
     * @param array $dependencies
     * @param string $indexerId
     * @return array
     * @see \Magento\Indexer\Model\Indexer\DependencyDecorator
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetIndexerIdsToRunAfter(Provider $provider, array $dependencies, string $indexerId): array
    {
        return $dependencies;
    }

    /**
     * @param string $currentIndexerId
     * @param string $targetIndexerId
     * @return bool
     */
    private function isFilteringNeeded(string $currentIndexerId, string $targetIndexerId): bool
    {
        return (!$this->config->isElasticsearchEnabled() && $targetIndexerId === $currentIndexerId);
    }
}
