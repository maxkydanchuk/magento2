<?php
namespace Training\DescriptionWidget\Block\Widget;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;


class DescriptionWidget extends Template implements BlockInterface
{

    const DEFAULT_TEMPLATE = 'widget/description_widget.phtml';

    /**
     *
     */
    public function _construct()
    {
        if (!$this->hasData('template')) {
            $this->setData('template', self::DEFAULT_TEMPLATE);
        }

        return parent::_construct();
    }

    /**
     * DescriptionWidget constructor.
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,

        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getFirstIcon(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('first_step_icon');
    }

    /**
     * @return array|mixed|null
     */
    public function getFirstStepText() {
        return $this->getData('first_step_text');
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getSecondIcon(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('second_step_icon');
    }

    /**
     * @return array|mixed|null
     */
    public function getSecondStepText() {
        return $this->getData('second_step_text');
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getThirdIcon(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('third_step_icon');
    }

    /**
     * @return array|mixed|null
     */
    public function getThirdStepText() {
        return $this->getData('third_step_text');
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getFourthIcon(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('fourth_step_icon');
    }

    /**
     * @return array|mixed|null
     */
    public function getFourthStepText() {
        return $this->getData('fourth_step_text');
    }

}
