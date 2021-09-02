<?php
namespace Training\WinnersWidget\Block\Widget;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;


class WinnersWidget extends Template implements BlockInterface
{

    const DEFAULT_TEMPLATE = 'widget/winners_widget.phtml';

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
     * WinnersWidget constructor.
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
    public function getFirstWinner(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('first_winner_icon');
    }

    /**
     * @return array|mixed|null
     */
    public function getFirstWinnerCar() {
        return $this->getData('first_winner_text');
    }

    /**
     * @return array|mixed|null
     */
    public function getFirstWinnerDate() {
        return $this->getData('fourth_winner_date');
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getSecondWinner(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('second_winner_icon');
    }

    /**
     * @return array|mixed|null
     */
    public function getSecondWinnerCar() {
        return $this->getData('second_winner_text');
    }

    /**
     * @return array|mixed|null
     */
    public function getSecondWinnerDate() {
        return $this->getData('fourth_winner_date');
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getThirdWinner(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('third_winner_icon');
    }

    /**
     * @return array|mixed|null
     */
    public function getThirdWinnerCar() {
        return $this->getData('third_winner_text');
    }

    /**
     * @return array|mixed|null
     */
    public function getThirdWinnerDate() {
        return $this->getData('fourth_winner_date');
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getFourthWinner(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('fourth_winner_icon');
    }

    /**
     * @return array|mixed|null
     */
    public function getFourthWinnerCar() {
        return $this->getData('fourth_winner_text');
    }

    /**
     * @return array|mixed|null
     */
    public function getFourthWinnerDate() {
        return $this->getData('fourth_winner_date');
    }

    /**
     * @return bool
     */
    public function hasWidgetTitle() {
        return $this->hasData('title');
    }

    /**
     * @return array|mixed|null
     */
    public function widgetTitle() {
        return $this->getData('title');
    }
}
