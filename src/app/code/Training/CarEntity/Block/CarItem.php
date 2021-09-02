<?php


namespace Training\CarEntity\Block;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;
use Training\CarEntity\Api\Data\CarEntityInterface;
use Training\CarEntity\Model\CarEntityModelFactory;


class CarItem extends Template
{
    /**
     * @var CarEntityModelFactory
     */
    protected $carEntityModelFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    public function __construct(
        Template\Context $context,
        CarEntityModelFactory $carEntityModelFactory,
        StoreManagerInterface $storeManager,
        array $data = [])
    {
        parent::__construct($context, $data);
        $this->carEntityModelFactory = $carEntityModelFactory;
        $this->storeManager = $storeManager;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getImage($carEntity): string
    {
        return $this->storeManager->getStore()
                ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA)
            . CarEntityInterface::BASE_IMAGE_PATH . '/' . $carEntity->getImage();

    }

    /**
     * @return CarItem
     */
    public function _prepareLayout(): CarItem
    {
        $this->pageConfig->getTitle()->set($this->getEntityName());

        return parent::_prepareLayout();
    }

    /**
     * @return mixed
     */
    public function getEntityName()
    {
        return $this->getCurrentEntity()->getName();
    }

    /**
     * @return mixed
     */
    public function getCurrentEntity()
    {
        $carId = $this->getRequest()->getParam('car_entity_id');

        return $this->carEntityModelFactory->create()->load($carId);
    }
}
