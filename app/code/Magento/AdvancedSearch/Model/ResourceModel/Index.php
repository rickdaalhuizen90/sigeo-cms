<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\AdvancedSearch\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Search\Request\IndexScopeResolverInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Search\Request\Dimension;
use Magento\Framework\Search\Request\IndexScopeResolverInterface as TableResolver;
use Magento\Store\Model\Indexer\WebsiteDimensionProvider;

/**
 * @api
 * @since 100.1.0
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Index extends AbstractDb
{
    /**
     * @var StoreManagerInterface
     * @since 100.1.0
     */
    protected $storeManager;

    /**
     * @var MetadataPool
     * @since 100.1.0
     */
    protected $metadataPool;

    /**
     * @var TableResolver
     */
    private $tableResolver;

    /**
     * @var DimensionCollectionFactory|null
     */
    private $dimensionCollectionFactory;

    /**
     * @var int|null
     */
    private $websiteId;

    /**
     * Index constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param MetadataPool $metadataPool
     * @param string|null $connectionName
     * @param TableResolver|null $tableResolver
     * @param DimensionCollectionFactory|null $dimensionCollectionFactory
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        MetadataPool $metadataPool,
        $connectionName = null,
        TableResolver $tableResolver = null
    ) {
        parent::__construct($context, $connectionName);
        $this->storeManager = $storeManager;
        $this->metadataPool = $metadataPool;
        $this->tableResolver = $tableResolver ?: ObjectManager::getInstance()->get(IndexScopeResolverInterface::class);

    }

    /**
     * Implementation of abstract construct
     *
     * @return void
     * @since 100.1.0
     * phpcs:disable Magento2.CodeAnalysis.EmptyBlock
     */
    protected function _construct()
    {
    }

    /**
     * Prepare system index data for products.
     *
     * @param int $storeId
     * @param null|array $productIds
     * @return array
     * @since 100.1.0
     */
    public function getCategoryProductIndexData($storeId = null, $productIds = null)
    {
        $connection = $this->getConnection();

        $catalogCategoryProductDimension = new Dimension(\Magento\Store\Model\Store::ENTITY, $storeId);

        $catalogCategoryProductTableName = $this->tableResolver->resolve(
            AbstractAction::MAIN_INDEX_TABLE,
            [
                $catalogCategoryProductDimension
            ]
        );

        $select = $connection->select()->from(
            [$catalogCategoryProductTableName],
            ['category_id', 'product_id', 'position', 'store_id']
        )->where(
            'store_id = ?',
            $storeId
        );

        if ($productIds) {
            $select->where('product_id IN (?)', $productIds);
        }

        $result = [];
        foreach ($connection->fetchAll($select) as $row) {
            $result[$row['product_id']][$row['category_id']] = $row['position'];
        }

        return $result;
    }

    /**
     * Retrieve moved categories product ids
     *
     * @param int $categoryId
     * @return array
     * @since 100.1.0
     */
    public function getMovedCategoryProductIds($categoryId)
    {
        $connection = $this->getConnection();

        $identifierField = $this->metadataPool->getMetadata(CategoryInterface::class)->getIdentifierField();

        $select = $connection->select()->distinct()->from(
            ['c_p' => $this->getTable('catalog_category_product')],
            ['product_id']
        )->join(
            ['c_e' => $this->getTable('catalog_category_entity')],
            'c_p.category_id = c_e.' . $identifierField,
            []
        )->where(
            $connection->quoteInto('c_e.path LIKE ?', '%/' . $categoryId . '/%')
        )->orWhere(
            'c_p.category_id = ?',
            $categoryId
        );

        return $connection->fetchCol($select);
    }
}
