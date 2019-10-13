<?php

namespace AHT\G1T563\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_scopeConfig;
    protected $resultPageFactory;
    protected $resultForwardFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_scopeConfig = $scopeConfig;
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    public function execute()
    {

        $resultPage = $this->_scopeConfig->getValue('helloworld/general/enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if (!$resultPage) { 
            $resultForward = $this->resultForwardFactory->create();
            $resultForward->forward('defaultNoRoute'); 
            // $resultRedirect = $this->resultRedirectFactory->create();
            // $resultRedirect->setPath('helloworld/index/defaultnoroute');
            return $resultForward;
            // return $resultRedirect;
        } else {
            /*Module is enabled */
            return $this->resultPageFactory->create();
        }
    }
}
