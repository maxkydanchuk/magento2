<?php
namespace Training\DescriptionWidget\Block\Widget;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;



class DescriptionWidget extends Template implements BlockInterface
{

    const DEFAULT_TEMPLATE = 'widget/description_widget.phtml';

    public function _construct()
    {
        if (!$this->hasData('template')) {
            $this->setData('template', self::DEFAULT_TEMPLATE);
        }

        return parent::_construct();
    }

    public function __construct(
        Context $context,

        array $data = []
    )
    {
        parent::__construct($context, $data);
    }



    public function getFirstIcon(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('first_step_icon');
    }

    public function getFirstStepText() {
        return $this->getData('first_step_text');
    }


    public function getSecondIcon(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('second_step_icon');
    }

    public function getSecondStepText() {
        return $this->getData('second_step_text');
    }

    public function getThirdIcon(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('third_step_icon');
    }

    public function getThirdStepText() {
        return $this->getData('third_step_text');
    }

    public function getFourthIcon(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('fourth_step_icon');
    }

    public function getFourthStepText() {
        return $this->getData('fourth_step_text');
    }

}
