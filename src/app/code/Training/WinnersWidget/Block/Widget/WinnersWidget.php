<?php
namespace Training\WinnersWidget\Block\Widget;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;



class WinnersWidget extends Template implements BlockInterface
{

    const DEFAULT_TEMPLATE = 'widget/winners_widget.phtml';

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



    public function getFirstWinner(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('first_winner_icon');
    }

    public function getFirstWinnerCar() {
        return $this->getData('first_winner_text');
    }

    public function getFirstWinnerDate() {
        return $this->getData('fourth_winner_date');
    }


    public function getSecondWinner(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('second_winner_icon');
    }

    public function getSecondWinnerCar() {
        return $this->getData('second_winner_text');
    }

    public function getSecondWinnerDate() {
        return $this->getData('fourth_winner_date');
    }

    public function getThirdWinner(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('third_winner_icon');
    }

    public function getThirdWinnerCar() {
        return $this->getData('third_winner_text');
    }

    public function getThirdWinnerDate() {
        return $this->getData('fourth_winner_date');
    }

    public function getFourthWinner(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('fourth_winner_icon');
    }

    public function getFourthWinnerCar() {
        return $this->getData('fourth_winner_text');
    }

    public function getFourthWinnerDate() {
        return $this->getData('fourth_winner_date');
    }

    public function hasWidgetTitle() {
        return $this->hasData('title');
    }

    public function widgetTitle() {
        return $this->getData('title');
    }
}
