<?php
namespace Training\ReviewWidget\Block\Widget;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;



class ReviewWidget extends Template implements BlockInterface
{

    const DEFAULT_TEMPLATE = 'widget/review_widget.phtml';

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



    public function getFirstPhoto(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('first_review_photo');
    }

    public function getFirstReview() {
        return $this->getData('first_review_text');
    }

    public function getFirstReviewAuthor() {
        return $this->getData('first_review_author');
    }


    public function getSecondPhoto(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('second_review_photo');
    }

    public function getSecondReview() {
        return $this->getData('second_review_text');
    }

    public function getSecondReviewAuthor() {
        return $this->getData('second_review_author');
    }


}
