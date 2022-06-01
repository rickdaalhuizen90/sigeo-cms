<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Setup\Fixtures;

use Magento\Store\Model\StoreManager;

/**
 * Provide category id. Find category in default store group by specified website and category name or create new one
 */
class CategoryResolver
{
    /**
     * @var StoreManager
     */
    private $storeManager;

    /**
     * @param StoreManager $storeManager
     * @internal param Category $category
     */
    public function __construct(
        StoreManager $storeManager
    ) {
        $this->storeManager = $storeManager;
    }
}
