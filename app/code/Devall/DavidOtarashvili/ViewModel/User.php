<?php

namespace Devall\DavidOtarashvili\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class User implements ArgumentInterface
{
    /**
     *
     */
    public function getText(){
        echo 'This text is from ViewModel';
    }
}
