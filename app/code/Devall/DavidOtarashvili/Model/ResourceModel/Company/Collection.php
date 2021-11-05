<?php

namespace Devall\DavidOtarashvili\Model\ResourceModel\Company;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Devall\DavidOtarashvili\Model\ResourceModel\Company;

class Collection extends AbstractCollection
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init(\Devall\DavidOtarashvili\Model\Company::class, Company::class);
    }
}
