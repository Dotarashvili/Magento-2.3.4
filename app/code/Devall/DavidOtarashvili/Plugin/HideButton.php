<?php

namespace Devall\DavidOtarashvili\Plugin;
use Magento\Catalog\Model\Product;

class HideButton extends Product
{
    public function afterIsSaleable(Product $product) {
        if($product->getData('expiry_date') < date('Y-m-d H:m:s')) {
            return false;
        }
        return true;
    }
}
