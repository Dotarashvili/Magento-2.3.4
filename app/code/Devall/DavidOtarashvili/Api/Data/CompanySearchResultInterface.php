<?php

namespace Devall\DavidOtarashvili\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface CompanySearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getItems();

    /**
     * @param \Devall\DavidOtarashvili\Api\Data\CompanyInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
