<?php


namespace Training\CustomGrid\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Framework\View\Result\PageFactory;


class Render extends Action
{

    /**
     * @var UiComponentFactory
     */
    private $uiComponentFactory;

    /**
     * @var pageFactory
     */
    private $pageFactory;

    public function __construct(
        Context $context,
        pageFactory $pageFactory,
        UiComponentFactory $uiComponentFactory
    )
    {
        $this->pageFactory = $pageFactory;
        $this->uiComponentFactory = $uiComponentFactory;
        parent::__construct($context);
    }

    /**
     * @return void
     * @throws LocalizedException
     */
    public function execute()
    {
        if ($this->_request->getParam('namespace') === null) {
            $this->_redirect('cms/index/index');
            return;
        }
        $component = $this->uiComponentFactory->create($this->_request->getParam('namespace'));
        $this->prepareComponent($component);
        $this->_response->appendBody((string)$component->render());
    }

    /**
     * Call prepare method in the component UI
     *
     * @param UiComponentInterface $component
     * @return void
     */
    protected function prepareComponent(UiComponentInterface $component)
    {
        foreach ($component->getChildComponents() as $child) {
            $this->prepareComponent($child);
        }
        $component->prepare();
    }
}
