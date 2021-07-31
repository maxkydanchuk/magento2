<?php


namespace Training\NewTheme\Block;
 use Magento\Catalog\Block\Product\View\AbstractView;

class CustomAttribute extends AbstractView
{
    protected $templateProcessor;

    public function __construct
    (
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Stdlib\ArrayUtils $arrayUtils,
        \Zend_Filter_Interface $templateProcessor,
        array $data = []
    )
    {
        $this->templateProcessor = $templateProcessor;
        parent::__construct($context, $arrayUtils, $data);
    }

    public function filterOutputHtml($string) {
        return $this->templateProcessor->filter($string);
    }

    public function getCustomEditor () {
        if($this->getProduct()->getCustomAttribute('editor')) {
            return $this->getProduct()->getCustomAttribute('editor')->getValue();
        }
        else {
            return false;
        }
    }
}
