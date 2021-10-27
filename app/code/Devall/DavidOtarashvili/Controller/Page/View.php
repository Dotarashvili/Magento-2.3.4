<?php

declare(strict_types=1);

namespace Devall\DavidOtarashvili\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;

class View extends Action
{
    /**
     * @return Page|ResultInterface
     */
    public function execute()
    {
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $block = $page->getLayout()->getBlock('devall.david.otarashvili.example');
        $block->setData('custom_param', 'Data from the controller');
        return $page;
    }
}
