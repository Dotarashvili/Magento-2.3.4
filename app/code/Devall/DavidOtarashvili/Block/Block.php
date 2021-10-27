<?php

namespace Devall\DavidOtarashvili\Block;

use Magento\Framework\View\Element\Template;

class Block extends Template
{
    /**
     * @return string
     */
    public function getString(){
        return "String from a block";
    }
}
