<?php

namespace Training\ProductDescriptionWidget\Block\Adminhtml\Widget;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context as TemplateContext;
use Magento\Backend\Block\Widget\Button;
use Magento\Framework\Data\Form\Element\AbstractElement as Element;
use Magento\Framework\Data\Form\Element\Factory as FormElementFactory;
use Magento\Framework\Data\Form\Element\Text;


class ImageChooser extends Template
{
    /**
     * @var FormElementFactory
     */
    protected $elementFactory;

    /**
     * @param TemplateContext $context
     * @param FormElementFactory $elementFactory
     * @param array $data
     */
    public function __construct(
        TemplateContext $context,
        FormElementFactory $elementFactory,
        $data = []
    ) {
        $this->elementFactory = $elementFactory;
        parent::__construct($context, $data);
    }

    /**
     * Prepare chooser element HTML
     *
     * @param Element $element
     * @return Element
     */
    public function prepareElementHtml(Element $element)
    {
        $config = $this->_getData('config');
        $sourceUrl = $this->getUrl('cms/wysiwyg_images/index',
            ['target_element_id' => $element->getId(), 'type' => 'file']);

        /** @var Button $chooser */
        $chooser = $this->getLayout()->createBlock('Magento\Backend\Block\Widget\Button')
            ->setType('button')
            ->setClass('btn-chooser')
            ->setLabel($config['button']['open'])
            ->setOnClick('MediabrowserUtility.openDialog(\''. $sourceUrl .'\')')
            ->setDisabled($element->getReadonly());

        /** @var Text $input */
        $input = $this->elementFactory->create("text", ['data' => $element->getData()]);
        $input->setId($element->getId());
        $input->setForm($element->getForm());
        $input->setClass("widget-option input-text admin__control-text");
        if ($element->getRequired()) {
            $input->addClass('required-entry');
        }

        $element->setData('after_element_html', $input->getElementHtml() . $chooser->toHtml());

        return $element;
    }
}
