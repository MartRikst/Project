<?php
namespace Riksten\PreviousTabCAP\Controller\Customer;

use Magento\Framework\App\Action\Action;

/**
 * Class Index
 * @package Riksten\PreviousCAP\Controller\Customer
 */
Class Index extends Action
{

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }

}