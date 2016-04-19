<?php
namespace Yotpo\Yotpo\Block;
class Yotpo extends \Magento\Framework\View\Element\Template
{
    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context,
    \Magento\Framework\Registry $registry,
    \Magento\Catalog\Helper\Image $imageHelper,
    \Yotpo\Yotpo\Block\Config $config,
    array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_config = $config;
        $this->_imageHelper = $imageHelper;
        parent::__construct($context, $data);
    }

    public function getProduct()
	{
		if (!$this->hasData('product')) {
            $this->setData('product', $this->_coreRegistry->registry('current_product'));
        }
        return $this->getData('product');
    }

    public function getProductId() {
    	return $this->getProduct()->getId();
    }

    public function getProductName() {
        $productName = $this->getProduct()->getName();
        return htmlspecialchars($productName);
    }
    
    public function getProductDescription()
    {
        return $this->getProduct()->getShortDescription();        
    }

    public function getProductUrl()
    {
        return $this->getProduct()->getProductUrl();
    }    

    public function isRenderWidget()
    {
        return $this->getProduct() != null && 
        ($this->_config->isWidgetEnabled() || $this->getData('fromHelper'));
    }    

    public function isRenderBottomline()
    {
        return $this->_config->isBottomlineEnabled();
    } 

    public function getProductImageUrl()
    {
        return $this->_imageHelper->init($this->getProduct(), 'product_page_image_large')->getUrl();
    } 
    
    private function isProductPage()
    {
        return $this->getProduct() != null;
    }     
}