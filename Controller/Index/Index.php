<?php

namespace Tbb\Ajax\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * Booking action
     *
     * @return void
     */
    protected $_pageFactory;


    public function execute()
    {

        // 2. GET request : Render the booking page
        $this->_view->loadLayout();
        $this->_view->renderLayout();

    }
}