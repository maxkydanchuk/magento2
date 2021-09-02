<?php
namespace Training\CompetitionsWidget\Block\Widget;

use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Helper\Image;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\CatalogInventory\Api\Data\StockItemInterface;
use Magento\CatalogInventory\Model\Stock\StockItemRepository;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;


class CompetitionsWidget extends Template implements BlockInterface
{

    /**
     * @var CollectionFactory
     */
    protected $_productCollectionFactory;
    /**
     * @var StockItemRepository
     */
    protected $_stockItemRepository;
    /**
     * @var imageHelper
     */
    protected $imageHelper;
    /**
     * @var productFactory
     */
    protected $productFactory;
    /**
     * Template
     */


    const DEFAULT_TEMPLATE = 'widget/competitions_widget.phtml';

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
     * CompetitionsWidget constructor.
     * @param Context $context
     * @param CollectionFactory $productCollectionFactory
     * @param StockItemRepository $stockItemRepository
     * @param Image $imageHelper
     * @param ProductFactory $productFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory,
        StockItemRepository $stockItemRepository,
        Image $imageHelper,
        ProductFactory $productFactory,
        array $data = []
    ) {
        $this->imageHelper = $imageHelper;
        $this->productFactory = $productFactory;
        $this->_stockItemRepository = $stockItemRepository;
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @param $productId
     * @return StockItemInterface
     * @throws NoSuchEntityException
     */
    public function getStockItemInformation($productId)
    {
        return $this->_stockItemRepository->get($productId);
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function getProductCollectionByCategories($ids) {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => $ids]);
        return $collection;
    }

    /**
     * @param $id
     * @return \Exception|NoSuchEntityException|string
     */
    public function getProductImageUrl($id)
    {
        try
        {
            $product = $this->productFactory->create()->load($id);
        }
        catch (NoSuchEntityException $e)
        {
            return $e;
        }

        return $this->imageHelper->init($product, 'product_page_image_large')->getUrl();
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
