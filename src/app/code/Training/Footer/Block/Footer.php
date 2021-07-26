<?php

namespace Training\Footer\Block;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;

class Footer extends Template
{

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var CollectionFactory
     */
    private CollectionFactory $_categoryCollection;

    public function __construct(
        Template\Context $context,
        StoreManagerInterface $storeManager,
        CollectionFactory $categoryCollection,
        $data = []
    )
    {
        $this->_categoryCollection = $categoryCollection;
        $this->_storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    public function getCategoryCollection()
    {
        return $this->_categoryCollection->create()
            ->addAttributeToSelect('*')
            ->setStore($this->_storeManager->getStore())
            //->addAttributeToFilter('attribute_code', '1')
            ->addAttributeToFilter('is_active','1');
    }

}
