<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\Elasticsearch\SearchAdapter\Filter\Builder;

use Magento\Elasticsearch\Model\Adapter\FieldMapperInterface;
use Magento\Framework\Search\Request\Filter\Term as TermFilterRequest;
use Magento\Framework\Search\Request\FilterInterface as RequestFilterInterface;

/**
 * Term filter builder
 */
class Term implements FilterInterface
{
    /**
     * @var FieldMapperInterface
     */
    private $fieldMapper;

    /**
     * @var array */
    private $integerTypeAttributes = ['category_ids'];

    /**
     * @param FieldMapperInterface $fieldMapper
     * @param array $integerTypeAttributes
     */
    public function __construct(
        FieldMapperInterface $fieldMapper,
        array $integerTypeAttributes = []
    ) {
        $this->fieldMapper = $fieldMapper;
        $this->integerTypeAttributes = array_merge($this->integerTypeAttributes, $integerTypeAttributes);
    }

    /**
     * Build term filter request
     *
     * @param RequestFilterInterface|TermFilterRequest $filter
     * @return array
     */
    public function buildFilter(RequestFilterInterface $filter)
    {
        $filterQuery = [];

        $fieldName = $this->fieldMapper->getFieldName($filter->getField());

        if ($filter->getValue() !== false) {
            $operator = is_array($filter->getValue()) ? 'terms' : 'term';
            $filterQuery []= [
                $operator => [
                    $fieldName => $filter->getValue(),
                ],
            ];
        }
        return $filterQuery;
    }
}
