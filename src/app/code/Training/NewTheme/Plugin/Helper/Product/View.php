<?php


namespace Training\NewTheme\Plugin\Helper\Product;

use Magento\Cms\Model\Template\FilterProvider;


class View
{
    /**
     * @var FilterProvider
     */
    private $_filterProvider;

    /**
     * Constructor.
     *
     * @param FilterProvider $filterProvider
     */
    public function __construct(
        FilterProvider $filterProvider
    ) {
        $this->_filterProvider = $filterProvider;
    }

    /**
     * Init layout for viewing product page
     *
     * @param \Magento\Catalog\Helper\Product\View $subject
     * @param \Magento\Catalog\Helper\Product\View $result
     * @param \Magento\Framework\View\Result\Page $resultPage
     * @param \Magento\Catalog\Model\Product $product
     * @param null|\Magento\Framework\DataObject $params
     * @return \[Vendor]\[ModuleName]\Plugin\Helper\Product\View
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterInitProductLayout(
        \Magento\Catalog\Helper\Product\View $subject,
        $result,
        $resultPage,
        $product,
        $params
    ) {
        // filter product description to process widgets
        $description = $product->getResource()->getAttribute('editor')->getFrontend()->getValue($product);
        $filteredDescription = $this->_filterProvider->getPageFilter()->filter($description);
        $product->setDescription($filteredDescription);

        return $this;
    }
}
