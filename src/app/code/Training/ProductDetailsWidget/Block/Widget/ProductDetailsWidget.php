<?php


namespace Training\ProductDetailsWidget\Block\Widget;

use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Block\Product\ListProduct;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Catalog\Helper\Image as ImageHelper;



class ProductDetailsWidget extends Template implements BlockInterface
{

    protected $_template = 'widget/product_details_widget.phtml';

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var Product
     */
    private $product;
    /**
     * @var ImageHelper
     */
    protected $imageHelper;
    protected $listProduct;

    /**
     * @return string
     * @throws NoSuchEntityException
     */

    /**
     * ProductDetailsWidget constructor.
     * @param Template\Context $context
     * @param Registry $registry
     * @param ImageHelper $imageHelper
     * @param array $data
     */
    public function __construct(Template\Context $context,
                                Registry $registry,
                                ImageHelper $imageHelper,
                                ListProduct $listProduct,
                                array $data)
    {
        $this->registry = $registry;
        $this->imageHelper = $imageHelper;
        $this->listProduct = $listProduct;

        parent::__construct($context, $data);
    }

    /**
     * @return Product
     * @throws LocalizedException
     */
    public function getProduct()
    {
        if (is_null($this->product)) {
            $this->product = $this->registry->registry('product');

            if (!$this->product->getId()) {
                throw new LocalizedException(__('Failed to initialize product'));
            }
        }

        return $this->product;
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    public function getProductName()
    {
        return $this->getProduct()->getName();
    }

    /**
     * @return float
     * @throws LocalizedException
     */
    public function getProductPrice($product) {
        return $product->getPrice();
    }
    /**
     * @param Product $product
     * @return string
     */
    public function getImageUrl(Product $product)
    {
        return $this->imageHelper->init($product, 'related_products_list')
            ->setImageFile($product->getRelatedProductListImage()) // image,small_image,thumbnail
            ->resize(250)
            ->getUrl();
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getBackground(): string
    {
        $mediaUrl = $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . $this->getData('details_background');
    }

    /**
     * @return array|mixed|null
     */
    public function getProductDescriptionHeader()
    {
        return $this->getData('description_header');
    }

    /**
     * @return string
     */
    public function getProductDescriptionText(): string
    {
        return $this->getData('description_text');
    }

    /**
     * @return array|mixed|null
     */
    public function getProductDescriptionTitle()
    {
        return $this->getData('title');
    }

    /**
     * @return array|mixed|null
     */
    public function getWysiwygContent () {
        return $this->getData('details_wysiwyg');
    }

    /**
     * @param $product
     * @return mixed
     */
    public function getAddToCartPostParams($product) {
        return $this->listProduct->getAddToCartPostParams($product);
    }

}
