<?php


namespace Training\NewTheme\Block;
 use Magento\Catalog\Block\Product\Context;
 use Magento\Catalog\Block\Product\View\AbstractView;
 use Magento\Framework\Stdlib\ArrayUtils;
 use Zend_Filter_Interface;

 class CustomAttribute extends AbstractView
{
    protected $templateProcessor;

     /**
      * CustomAttribute constructor.
      * @param Context $context
      * @param ArrayUtils $arrayUtils
      * @param Zend_Filter_Interface $templateProcessor
      * @param array $data
      */
    public function __construct
    (
        Context $context,
        ArrayUtils $arrayUtils,
        Zend_Filter_Interface $templateProcessor,
        array $data = []
    ) {
        $this->templateProcessor = $templateProcessor;
        parent::__construct($context, $arrayUtils, $data);
    }

     /**
      * @param $string
      * @return mixed
      * @throws \Zend_Filter_Exception
      */
    public function filterOutputHtml($string) {
        return $this->templateProcessor->filter($string);
    }

     /**
      * @return false|mixed
      */
    public function getCustomEditor () {
        if($this->getProduct()->getCustomAttribute('editor')) {
            return $this->getProduct()->getCustomAttribute('editor')->getValue();
        }
        else {
            return false;
        }
    }
}
