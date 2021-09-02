<?php
namespace Training\ProductDescriptionWidget\Block\Widget;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;


class ProductDescriptionWidget extends Template implements BlockInterface
{

//    const DEFAULT_TEMPLATE = 'widget/product_description_widget.phtml';

    protected $_template = 'widget/product_description_widget.phtml';
    /**
     *
     */
//    public function _construct()
//    {
//        if (!$this->hasData('template')) {
//            $this->setData('template', self::DEFAULT_TEMPLATE);
//        }
//
//        return parent::_construct();
//    }
//
//    /**
//     * ProductDescriptionWidget constructor.
//     * @param Context $context
//     * @param array $data
//     */
//    public function __construct(
//        Context $context,
//
//        array $data = []
//    ) {
//        parent::__construct($context, $data);
//    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getBackground(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('description_background');
    }

    /**
     * @return array|mixed|null
     */
    public function getProductDescriptionHeader() {
        return $this->getData('description_header');
    }

    /**
     * @return string
     */
    public function getProductDescriptionText(): string
    {
        return $this->getData('description_text');
    }

    /**
     * @return array|mixed|null
     */
    public function getProductDescriptionTitle() {
        return $this->getData('title');
    }

}
