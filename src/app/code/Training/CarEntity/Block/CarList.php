<?php


namespace Training\CarEntity\Block;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;
use Training\CarEntity\Api\Data\CarEntityInterface;
use Training\CarEntity\Model\ResourceModel\CarEntityModel\CarEntityCollection;
use Training\CarEntity\Model\ResourceModel\CarEntityModel\CarEntityCollectionFactory;


class CarList extends Template
{
    const DETAILS_URL_PATH = 'car_entity/entity/view';

    /**
     * @var CarEntityCollectionFactory
     */
    protected $_carEntityCollectionFactory;

    /**
     * @var UrlInterface
     */

    private $urlBuilder;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    public function __construct(
        Template\Context $context,
        CarEntityCollectionFactory $carEntityCollectionFactory,
        StoreManagerInterface $storeManager,
        UrlInterface $urlBuilder,
        array $data = [])
    {
        parent::__construct($context, $data);
        $this->_carEntityCollectionFactory = $carEntityCollectionFactory;
        $this->urlBuilder = $urlBuilder;
        $this->storeManager = $storeManager;
    }


    /**
     * @return CarEntityCollection
     */
    public function getEntityCollection(): CarEntityCollection
    {
        return $this->_carEntityCollectionFactory->create();

    }

    /**
     * @param $carEntity
     * @return string
     */
    public function getEntityUrl($carEntity): string
    {
        if (isset($carEntity[CarEntityInterface::CAR_ENTITY_ID])) {
            $urlData = [CarEntityInterface::CAR_ENTITY_ID => $carEntity[CarEntityInterface::CAR_ENTITY_ID]];
            return $this->urlBuilder->getUrl(self::DETAILS_URL_PATH, $urlData);
        }
    }

    /**
     * @param $carEntity
     * @return string
     * @throws NoSuchEntityException
     */
    public function getImage($carEntity): string
    {
        return $this->storeManager->getStore()
                ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA)
            . CarEntityInterface::BASE_IMAGE_PATH . '/' . $carEntity->getImage();

    }

    /**
     * @return CarList
     */
    public function _prepareLayout(): CarList
    {
        $this->pageConfig->getTitle()->set('Entity List');

        return parent::_prepareLayout();
    }
}
