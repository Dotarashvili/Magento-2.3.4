<?php

namespace Devall\DavidOtarashvili\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;
use Magento\Framework\Api\SearchResultsInterface;

interface CompanySearchResultInterface extends SearchResultsInterface
{
    /**
     * @return ExtensibleDataInterface[]
     */
    public function getItems();

    /**
     * @param CompanyInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
