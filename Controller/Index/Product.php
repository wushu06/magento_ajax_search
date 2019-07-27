<?php

namespace Tbb\Ajax\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Product extends \Magento\Framework\App\Action\Action
{

    protected $resultJsonFactory;
    public $helper;
    protected $imageHelperFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory    $resultJsonFactory,
        \Magento\Catalog\Helper\Image $imageHelperFactory,
        \Tbb\Form\Helper\Index $helper

    ) {
        parent::__construct($context);
        $this->resultJsonFactory            = $resultJsonFactory;
        $this->helper = $helper;
        $this->imageHelperFactory = $imageHelperFactory;

    }

    public function urlGenerator($collection)
    {
        $url = [];
        foreach ($collection as $product){

            $url[]  = array(
                'url'=>$product->getProductUrl(),
                'name'=> $product->getName(),
                'image'=> $this->imageHelperFactory->init($product, 'product_base_image')->getUrl()
            );
        }
        return $url;


    }

    public function execute() {
        /* @var \Magento\Framework\Controller\Result\Json $result */
        $params = $this->getRequest()->getParams();
        if($params['name'] !=='') {
            $response1 = $this->helper->productsHelper->getProductCollectionByName($params['name'], false);
            $response = $this->helper->productsHelper->getProductCollectionByName($params['name'], 5);
            $url = $this->urlGenerator($response);
            $resultJson = $this->resultJsonFactory->create();
            return $resultJson->setData([
                'count' => $response1->getSize(),
               // 'result'=>$response->getData(),
                'result' => $url
            ]);
        }
    }
}